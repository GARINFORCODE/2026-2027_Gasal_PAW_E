<?php
require 'koneksi.php';

if (isset($_GET['hapus'])) {

    $id = $_GET['hapus'];

    $cek = $DBH->query("
        SELECT *
        FROM transaksi_detail
        WHERE barang_id = '$id'
    ");

    if ($cek->rowCount() > 0) {

        header('Location: barang.php?pesan=gagal');
        exit;

    } else {

        $hapus = $DBH->prepare("
            DELETE FROM barang
            WHERE id = '$id'
        ");

        $hapus->execute();

        header('Location: barang.php?pesan=berhasil');
        exit;
    }
}


$barang = $DBH->query("
    SELECT barang.*, supplier.nama AS nama_supplier
    FROM barang
    JOIN supplier ON barang.supplier_id = supplier.id
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
</head>
<body>

<h2>Data Barang</h2>

<?php

if (isset($_GET['pesan'])) {

    if ($_GET['pesan'] == 'gagal') {
        echo "<p style='color:red'>
            Barang tidak bisa dihapus karena masih digunakan dalam transaksi!
        </p>";
    }

    if ($_GET['pesan'] == 'berhasil') {
        echo "<p style='color:green'>
            Barang berhasil dihapus!
        </p>";
    }

}

?>

<table border="1" cellpadding="8">

    <tr>
        <th>ID</th>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Supplier</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($barang as $b) { ?>

        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['kode_barang'] ?></td>
            <td><?= $b['nama_barang'] ?></td>
            <td>Rp<?= number_format($b['harga']) ?></td>
            <td><?= $b['stok'] ?></td>
            <td><?= $b['nama_supplier'] ?></td>

            <td>
                <a href="barang.php?hapus=<?= $b['id'] ?>"
                   onclick="return confirm('Yakin ingin menghapus barang ini?')">
                    Hapus
                </a>
            </td>
        </tr>

    <?php } ?>

</table>

</body>
</html>
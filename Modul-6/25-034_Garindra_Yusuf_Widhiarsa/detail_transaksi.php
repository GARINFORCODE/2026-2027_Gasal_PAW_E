<?php
require 'koneksi.php';

$id_transaksi = $_GET['id'];

$transaksi = $DBH->query("
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    WHERE transaksi.id = '$id_transaksi'
")->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['tambah'])) {

    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $cek = $DBH->query("
        SELECT *
        FROM transaksi_detail
        WHERE transaksi_id = '$id_transaksi'
        AND barang_id = '$barang_id'
    ");

    if ($cek->rowCount() > 0) {

        echo "<script>
            alert('Barang sudah dimasukkan ke transaksi ini!');
            window.location.href='detail_transaksi.php?id=$id_transaksi';
        </script>";

        exit;
    }

    $barang = $DBH->query("
        SELECT * FROM barang
        WHERE id = '$barang_id'
    ")->fetch(PDO::FETCH_ASSOC);

    $harga = $barang['harga'];

    $tambah = $DBH->prepare("
        INSERT INTO transaksi_detail(transaksi_id, barang_id, harga, qty)
        VALUES('$id_transaksi', '$barang_id', '$harga', '$qty')
    ");

    $tambah->execute();


    $total = $DBH->query("
        SELECT SUM(harga * qty) AS total
        FROM transaksi_detail
        WHERE transaksi_id = '$id_transaksi'
    ")->fetch(PDO::FETCH_ASSOC);

    $jumlah_total = $total['total'];

    $update = $DBH->prepare("
        UPDATE transaksi
        SET total = '$jumlah_total'
        WHERE id = '$id_transaksi'
    ");

    $update->execute();

    header("Location: detail_transaksi.php?id=$id_transaksi");
    exit;
}


$barang = $DBH->query("
    SELECT *
    FROM barang
    WHERE id NOT IN (
        SELECT barang_id
        FROM transaksi_detail
        WHERE transaksi_id = '$id_transaksi'
    )
")->fetchAll(PDO::FETCH_ASSOC);


$detail = $DBH->query("
    SELECT transaksi_detail.*, barang.nama_barang
    FROM transaksi_detail
    JOIN barang ON transaksi_detail.barang_id = barang.id
    WHERE transaksi_detail.transaksi_id = '$id_transaksi'
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
</head>
<body>

<h2>Detail Transaksi #<?= $transaksi['id'] ?></h2>

<p>
    Pelanggan: <?= $transaksi['nama_pelanggan'] ?><br>
    Tanggal: <?= $transaksi['waktu_transaksi'] ?><br>
    Keterangan: <?= $transaksi['keterangan'] ?>
</p>

<hr>

<h3>Tambah Barang</h3>

<form method="POST">

    Barang:

    <select name="barang_id" required>

        <option value="">-- Pilih Barang --</option>

        <?php foreach ($barang as $b) { ?>

            <option value="<?= $b['id'] ?>">
                <?= $b['nama_barang'] ?>
                - Rp<?= number_format($b['harga']) ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    Qty:
    <input type="number" name="qty" min="1" required>

    <br><br>

    <button type="submit" name="tambah">
        Tambah Detail
    </button>

</form>

<hr>

<h3>Daftar Barang Transaksi</h3>

<table border="1" cellpadding="8">

    <tr>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($detail as $d) { ?>

        <tr>
            <td><?= $d['barang_id'] ?></td>
            <td><?= $d['nama_barang'] ?></td>
            <td>Rp<?= number_format($d['harga']) ?></td>
            <td><?= $d['qty'] ?></td>
            <td>
                Rp<?= number_format($d['harga'] * $d['qty']) ?>
            </td>
        </tr>

    <?php } ?>

</table>

<h3>
    Total Transaksi:
    Rp<?= number_format($transaksi['total']) ?>
</h3>

<a href="transaksi.php">Kembali ke Transaksi</a>

</body>
</html>
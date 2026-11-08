<?php
require 'koneksi.php';

if (isset($_POST['tambah'])) {

    $waktu = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];

    $tambah = $DBH->prepare("
        INSERT INTO transaksi(waktu_transaksi, keterangan, total, pelanggan_id)
        VALUES('$waktu', '$keterangan', 0, '$pelanggan_id')
    ");

    $tambah->execute();

    header('Location: transaksi.php');
    exit;
}

$transaksi = $DBH->query("
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY transaksi.id DESC
")->fetchAll(PDO::FETCH_ASSOC);

$pelanggan = $DBH->query("
    SELECT * FROM pelanggan
")->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Transaksi</title>
</head>
<body>

<h2>Tambah Transaksi</h2>

<form method="POST">

    Tanggal:
    <input type="date" name="waktu_transaksi" required>
    <br><br>

    Keterangan:
    <input type="text" name="keterangan">
    <br><br>

    Pelanggan:
    <select name="pelanggan_id" required>
        <option value="">-- Pilih Pelanggan --</option>

        <?php foreach ($pelanggan as $p) { ?>
            <option value="<?= $p['id'] ?>">
                <?= $p['nama'] ?>
            </option>
        <?php } ?>

    </select>

    <br><br>

    <button type="submit" name="tambah">
        Tambah Transaksi
    </button>

</form>

<hr>

<h2>Data Transaksi</h2>

<table border="1" cellpadding="8">

    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Detail</th>
    </tr>

    <?php foreach ($transaksi as $t) { ?>

        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= $t['waktu_transaksi'] ?></td>
            <td><?= $t['nama_pelanggan'] ?></td>
            <td><?= $t['keterangan'] ?></td>
            <td>Rp<?= number_format($t['total']) ?></td>

            <td>
                <a href="detail_transaksi.php?id=<?= $t['id'] ?>">
                    Lihat Detail
                </a>
            </td>
        </tr>

    <?php } ?>

</table>

</body>
</html>
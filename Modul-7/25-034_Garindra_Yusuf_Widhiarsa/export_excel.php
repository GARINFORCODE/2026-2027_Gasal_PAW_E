<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_penjualan.xls");

$koneksi = mysqli_connect("localhost", "root", "", "penjualan");
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$mulai = $_GET['tanggal_mulai'] ?? '';
$selesai = $_GET['tanggal_selesai'] ?? '';

$rekap = [];
$total_pendapatan = 0; $total_pelanggan = 0;

if (!empty($mulai) && !empty($selesai)) {
    $tgl_mulai = mysqli_real_escape_string($koneksi, $mulai);
    $tgl_selesai = mysqli_real_escape_string($koneksi, $selesai);

    $q = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian
          FROM transaksi WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'
          GROUP BY DATE(waktu_transaksi) ORDER BY tgl ASC";
    $res = mysqli_query($koneksi, $q);
    while ($r = mysqli_fetch_assoc($res)) {
        $rekap[] = $r;
        $total_pendapatan += $r['total_harian'];
    }

    $qp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml FROM transaksi
           WHERE waktu_transaksi BETWEEN '$tgl_mulai' AND '$tgl_selesai'";
    $rp = mysqli_fetch_assoc(mysqli_query($koneksi, $qp));
    $total_pelanggan = $rp['jml'] ?? 0;
}
?>
<h3>Rekap Laporan Penjualan <?= $mulai ?> sampai <?= $selesai ?></h3>
<table border="1">
    <tr><th>No</th><th>Total Pendapatan</th><th>Tanggal Transaksi</th></tr>
    <?php $no = 1; foreach ($rekap as $row): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td>Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?></td>
        <td><?= $row['tgl']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<table border="1">
    <tr><th>Jumlah Pelanggan</th><th>Jumlah Pendapatan</th></tr>
    <tr>
        <td><?= $total_pelanggan; ?> Orang</td>
        <td>Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
    </tr>
</table>

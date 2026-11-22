<?php include 'cek_login.php'; include 'koneksi.php'; include 'navbar.php'; ?>
<h2>Laporan Penjualan</h2>
<table>
<tr><th>No</th><th>Tanggal</th><th>Pelanggan</th><th>Barang</th><th>Qty</th><th>Total</th><th>Kasir</th></tr>
<?php
$r = $conn->query("SELECT t.*, p.nama_pelanggan, b.nama_barang, u.nama FROM transaksi t
  JOIN pelanggan p ON p.id_pelanggan=t.id_pelanggan JOIN barang b ON b.id_barang=t.id_barang
  JOIN user u ON u.id_user=t.id_user ORDER BY t.tanggal DESC");
$no = 1; $sum = 0;
while ($row = $r->fetch_assoc()) { $sum += $row['total'];
  echo "<tr><td>".$no++."</td><td>{$row['tanggal']}</td><td>".htmlspecialchars($row['nama_pelanggan'])."</td><td>".htmlspecialchars($row['nama_barang'])."</td><td>{$row['qty']}</td><td>Rp ".number_format($row['total'],0,',','.')."</td><td>".htmlspecialchars($row['nama'])."</td></tr>"; }
?>
<tr><td colspan="5"><b>Total</b></td><td colspan="2"><b>Rp <?= number_format($sum,0,',','.') ?></b></td></tr>
</table>
</div></body></html>

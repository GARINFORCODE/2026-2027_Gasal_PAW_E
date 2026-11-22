<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Sistem Penjualan</title>
<style>
body{font-family:sans-serif;margin:0}
nav{background:#1f4e8c;color:#fff;display:flex;align-items:center;padding:0 20px}
nav a,nav span{color:#fff;text-decoration:none;padding:16px 14px;display:block}
nav a:hover{background:#163a69}
.kanan{margin-left:auto;display:flex}
.dd{position:relative}.dd div{display:none;position:absolute;background:#1f4e8c;min-width:160px;z-index:9}
.dd:hover div{display:block}
.isi{padding:20px}table{border-collapse:collapse;width:100%}td,th{border:1px solid #ccc;padding:6px}
input,select{padding:6px;margin:3px}
</style></head><body>
<nav>
  <strong style="padding:16px 14px">Sistem Penjualan</strong>
  <a href="index.php">Home</a>
  <?php if ($_SESSION['level'] == 1): ?>
  <div class="dd"><a href="#">Data Master ▾</a>
    <div>
      <a href="barang.php">Data Barang</a>
      <a href="supplier.php">Data Supplier</a>
      <a href="pelanggan.php">Data Pelanggan</a>
      <a href="user.php">Data User</a>
    </div>
  </div>
  <?php endif; ?>
  <a href="transaksi.php">Transaksi</a>
  <a href="laporan.php">Laporan</a>
  <div class="kanan">
    <span><?= htmlspecialchars($_SESSION['nama']) ?></span>
    <a href="logout.php">Logout</a>
  </div>
</nav>
<div class="isi">

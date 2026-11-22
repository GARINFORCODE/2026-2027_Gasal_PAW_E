<?php
include 'cek_login.php'; include 'koneksi.php';
$pesan = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idp = (int)$_POST['id_pelanggan']; $idb = (int)$_POST['id_barang']; $qty = (int)$_POST['qty'];
    $s = $conn->prepare("SELECT harga, stok FROM barang WHERE id_barang=?");
    $s->bind_param("i", $idb); $s->execute();
    $b = $s->get_result()->fetch_assoc();
    if (!$b || $qty < 1) $pesan = "Data tidak valid.";
    elseif ($qty > $b['stok']) $pesan = "Stok tidak cukup (sisa {$b['stok']}).";
    else {
        $total = $b['harga'] * $qty; $u = $_SESSION['id_user'];
        $s = $conn->prepare("INSERT INTO transaksi (tanggal,id_pelanggan,id_barang,qty,total,id_user) VALUES (NOW(),?,?,?,?,?)");
        $s->bind_param("iiiii", $idp, $idb, $qty, $total, $u); $s->execute();
        $s = $conn->prepare("UPDATE barang SET stok = stok - ? WHERE id_barang=?");
        $s->bind_param("ii", $qty, $idb); $s->execute();
        $pesan = "Transaksi berhasil. Total: Rp " . number_format($total, 0, ',', '.');
    }
}
include 'navbar.php';
?>
<h2>Transaksi</h2>
<?php if ($pesan) echo "<p><b>$pesan</b></p>"; ?>
<form method="POST">
  Pelanggan: <select name="id_pelanggan">
    <?php $r = $conn->query("SELECT * FROM pelanggan"); while ($p = $r->fetch_assoc())
      echo "<option value='{$p['id_pelanggan']}'>" . htmlspecialchars($p['nama_pelanggan']) . "</option>"; ?>
  </select>
  Barang: <select name="id_barang">
    <?php $r = $conn->query("SELECT * FROM barang"); while ($b = $r->fetch_assoc())
      echo "<option value='{$b['id_barang']}'>" . htmlspecialchars($b['nama_barang']) . " (Rp {$b['harga']}, stok {$b['stok']})</option>"; ?>
  </select>
  Qty: <input type="number" name="qty" min="1" value="1" required>
  <input type="submit" value="Simpan">
</form>
</div></body></html>

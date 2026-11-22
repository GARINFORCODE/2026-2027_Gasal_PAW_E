<?php include 'cek_login.php'; include 'navbar.php'; ?>
<h2>Home</h2>
<p>Selamat datang, <b><?= htmlspecialchars($_SESSION['nama']) ?></b>
(<?= $_SESSION['level'] == 1 ? 'Owner' : 'Kasir' ?>).</p>
</div></body></html>

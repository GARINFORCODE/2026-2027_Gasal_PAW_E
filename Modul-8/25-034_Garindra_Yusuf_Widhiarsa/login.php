<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php"); exit;
}
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Login</title>
<style>body{font-family:sans-serif;background:#eef2f7}form{width:300px;margin:100px auto;background:#fff;padding:24px;border-radius:8px}input{width:100%;padding:8px;margin:6px 0 12px;box-sizing:border-box}.err{color:#c00}</style></head>
<body>
<form action="proses-login.php" method="POST">
  <h3>Sistem Penjualan</h3>
  <?php if (isset($_GET['error'])) echo "<p class='err'>Username atau password salah!</p>"; ?>
  Username <input type="text" name="username" required>
  Password <input type="password" name="password" required>
  <input type="submit" value="Login">
</form>
</body></html>

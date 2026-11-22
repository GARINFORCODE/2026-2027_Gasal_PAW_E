<?php
require 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

$update = $DBH->prepare("UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = '$id'");
$update->execute();

header("Location: supplier.php");
exit;
?>
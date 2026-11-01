<?php
require 'koneksi.php';

$nama = $_POST['nama'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

$tambah = $DBH->prepare("INSERT INTO supplier(nama, telp, alamat) VALUES('$nama', '$telp', '$alamat')");

$tambah->execute();
header('Location: supplier.php');

?>

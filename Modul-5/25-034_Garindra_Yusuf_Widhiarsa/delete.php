<?php
require 'koneksi.php';

$id = $_GET['id'];

$delete = $DBH->prepare("DELETE FROM supplier WHERE id = $id");
$delete->execute();

header("Location: supplier.php");
exit;
?>  
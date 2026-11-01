<?php
require 'validate.inc';

echo "<h1>Hasil Validasi Surname</h1>";

if (validasiNama($_POST, 'surname')) {
    echo "Data OK!";
} else {
    echo "Data invalid!";
}

echo "<hr><h2>Detail pesan error</h2>";

$daftar_error = array();
validasiNamaDenganError($daftar_error, $_POST, 'surname');

if ($daftar_error) {
    echo "Errors:<br>";
    foreach ($daftar_error as $nama_field => $pesan_error) {
        echo htmlspecialchars($nama_field) . " " . htmlspecialchars($pesan_error) . "<br>";
    }
} else {
    echo "Data OK!";
}
?>
<?php
$data_form = $_POST;
echo "<h1>Hasil Isian Form</h1>";

foreach ($data_form as $nama_field => $nilai_field) {
    if (is_array($nilai_field)) {
        $nilai_field = implode(", ", $nilai_field);
    }

    echo "<p><strong>" . htmlspecialchars($nama_field) . ":</strong> "
        . htmlspecialchars((string) $nilai_field) . "</p>";
}

if (!isset($_POST['vegetarian'])) {
    echo "<p><strong>vegetarian:</strong> Tidak dicentang</p>";
}
?>

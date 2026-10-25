<?php
// Mengambil seluruh data yang dikirim dari form menggunakan method POST.
$data_form = $_POST;

// Menampilkan setiap nama field dan nilainya dengan foreach.
echo "<h1>Hasil Isian Form</h1>";

foreach ($data_form as $nama_field => $nilai_field) {
    // Menghindari HTML dari input pengguna dieksekusi sebagai markup.
    if (is_array($nilai_field)) {
        $nilai_field = implode(", ", $nilai_field);
    }

    echo "<p><strong>" . htmlspecialchars($nama_field) . ":</strong> "
        . htmlspecialchars((string) $nilai_field) . "</p>";
}

// Checkbox yang tidak dicentang tidak dikirim oleh browser.
if (!isset($_POST['vegetarian'])) {
    echo "<p><strong>vegetarian:</strong> Tidak dicentang</p>";
}
?>

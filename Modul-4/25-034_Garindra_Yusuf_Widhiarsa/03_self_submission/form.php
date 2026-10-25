<?php
// Daftar error selalu dimulai dalam keadaan kosong setiap kali halaman dibuka.
$daftar_error = array();

// Jika surname sudah dikirim, berarti tombol Submit telah ditekan.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['surname'])) {
    require 'validate.inc';
    validasiSemuaIsian($daftar_error, $_POST);

    if (empty($daftar_error)) {
        echo '<h1>Form submitted successfully with no errors</h1>';
        echo '<h2>Data yang diterima</h2>';

        $daftar_label = array(
            'surname' => 'Surname',
            'email' => 'Email address',
            'street_address' => 'Street Address',
            'state' => 'State',
            'country' => 'Country',
            'gender' => 'Gender',
            'vegetarian' => 'Vegetarian'
        );

        foreach ($daftar_label as $nama_field => $label_field) {
            if ($nama_field === 'vegetarian') {
                $nilai_field = isset($_POST[$nama_field]) ? 'Yes' : 'No';
            } else {
                $nilai_field = $_POST[$nama_field] ?? '';
            }

            echo '<p><strong>' . htmlspecialchars($label_field) . ':</strong> '
                . htmlspecialchars((string) $nilai_field) . '</p>';
        }
    } else {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($daftar_error as $nama_field => $pesan_error) {
            echo '<p>' . htmlspecialchars($nama_field) . ': '
                . htmlspecialchars($pesan_error) . '</p>';
        }

        // Form ditampilkan lagi dengan nilai sebelumnya tetap terisi.
        include 'form.inc';
    }
} else {
    // Saat pertama kali dibuka, tampilkan form kosong.
    include 'form.inc';
}
?>

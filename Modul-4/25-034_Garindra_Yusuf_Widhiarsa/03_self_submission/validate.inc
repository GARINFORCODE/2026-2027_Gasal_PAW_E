<?php
// Memeriksa surname, email, alamat, state, dan gender.
function validasiSemuaIsian(&$daftar_error, $daftar_isian)
{
    // Surname wajib diisi dan hanya boleh berisi huruf, apostrof, atau tanda hubung.
    $pola_nama = "/^[a-zA-Z'-]+$/";

    if (!isset($daftar_isian['surname']) || trim($daftar_isian['surname']) === '') {
        $daftar_error['surname'] = 'required';
    } elseif (!preg_match($pola_nama, $daftar_isian['surname'])) {
        $daftar_error['surname'] = 'invalid';
    }

    // Email wajib diisi dan harus memiliki format email.
    if (!isset($daftar_isian['email']) || trim($daftar_isian['email']) === '') {
        $daftar_error['email'] = 'required';
    } elseif (!filter_var($daftar_isian['email'], FILTER_VALIDATE_EMAIL)) {
        $daftar_error['email'] = 'invalid';
    }

    // Alamat wajib diisi.
    if (!isset($daftar_isian['street_address']) || trim($daftar_isian['street_address']) === '') {
        $daftar_error['street_address'] = 'required';
    }

    // State wajib dipilih.
    if (!isset($daftar_isian['state']) || $daftar_isian['state'] === '') {
        $daftar_error['state'] = 'required';
    }

    // Gender wajib dipilih.
    if (!isset($daftar_isian['gender']) || $daftar_isian['gender'] === '') {
        $daftar_error['gender'] = 'required';
    }
}
?>

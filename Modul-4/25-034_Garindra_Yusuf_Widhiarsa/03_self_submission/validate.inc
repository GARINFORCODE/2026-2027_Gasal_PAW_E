<?php
function validasiSemuaIsian(&$daftar_error, $daftar_isian)
{
    $pola_nama = "/^[a-zA-Z'-]+$/";

    if (!isset($daftar_isian['surname']) || trim($daftar_isian['surname']) === '') {
        $daftar_error['surname'] = 'required';
    } elseif (!preg_match($pola_nama, $daftar_isian['surname'])) {
        $daftar_error['surname'] = 'invalid';
    }

    if (!isset($daftar_isian['email']) || trim($daftar_isian['email']) === '') {
        $daftar_error['email'] = 'required';
    } elseif (!filter_var($daftar_isian['email'], FILTER_VALIDATE_EMAIL)) {
        $daftar_error['email'] = 'invalid';
    }

    if (!isset($daftar_isian['street_address']) || trim($daftar_isian['street_address']) === '') {
        $daftar_error['street_address'] = 'required';
    }

    if (!isset($daftar_isian['state']) || $daftar_isian['state'] === '') {
        $daftar_error['state'] = 'required';
    }

    if (!isset($daftar_isian['gender']) || $daftar_isian['gender'] === '') {
        $daftar_error['gender'] = 'required';
    }
}
?>

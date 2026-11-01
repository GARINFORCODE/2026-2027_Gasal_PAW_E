<?php
function validasiNama($daftar_isian, $nama_field)
{
    if (!isset($daftar_isian[$nama_field])) {
        return false;
    }

    $pola_nama = "/^[a-zA-Z'-]+$/";

    if (!preg_match($pola_nama, $daftar_isian[$nama_field])) {
        return false;
    }

    return true;
}

function validasiNamaDenganError(&$daftar_error, $daftar_isian, $nama_field)
{
    $pola_nama = "/^[a-zA-Z'-]+$/";

    if (!isset($daftar_isian[$nama_field]) || trim($daftar_isian[$nama_field]) === '') {
        $daftar_error[$nama_field] = 'required';
    } elseif (!preg_match($pola_nama, $daftar_isian[$nama_field])) {
        $daftar_error[$nama_field] = 'invalid';
    }
}
?>

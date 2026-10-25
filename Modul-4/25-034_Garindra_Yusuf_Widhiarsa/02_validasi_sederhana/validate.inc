<?php
// Versi validasi dengan hasil true/false, sesuai langkah awal modul.
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

/*
Versi berikutnya pada modul menyimpan pesan error dalam array.
Fungsi ini dipakai di bawah agar kode tahap 2 bisa langsung menampilkan
error "required" jika kosong dan "invalid" jika format tidak sesuai.
*/
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

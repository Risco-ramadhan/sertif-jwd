<?php

function getData()
{
    // File json yang akan dibaca (full path file)
    $file = "data/data.json";
    // Mendapatkan file json
    $anggota = file_get_contents($file);
    // Mendecode anggota.json
    $dataMahasiswa = json_decode($anggota, true);
    return $dataMahasiswa;
}
function addData($arrdata)
{
    $file = "data/data.json";
    // Mendapatkan file json
    $anggota = file_get_contents($file);

    // Mendecode anggota.json
    $data = json_decode($anggota, true);
    $data[] = $arrdata;
    // Data array baru
    // Mengencode data menjadi json
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);

    // Menyimpan data ke dalam anggota.json
    $anggota = file_put_contents($file, $jsonfile);
}

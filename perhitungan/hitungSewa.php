<?php

function hitung_sewa($biaya_platform, $jarak, $sewa_per_km)
{

    $nilai_sewa = $biaya_platform + ($jarak * $sewa_per_km);

    return $nilai_sewa;
    // nilai_sewa = biaya platform + (jarak X biaya per kilometer)
}

<?php (defined('BASEPATH')) or exit('No direct script access allowed');

function test($x, $exit=0, $hide=false)
{
    echo ($hide) ? '<div style="display:none;">' : '';
    echo "<pre>";
    if (is_array($x) || is_object($x)) {
        echo print_r($x);
    } elseif (is_string($x)) {
        echo $x;
    } else {
        echo var_dump($x);
    }
    echo "</pre><hr />";
    echo ($hide) ? '</div>' : '';
    if ($exit==1) {
        die();
    }
}

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    return $array;
}

// cari array duplikat
function findDuplicates($count) {
    return $count > 1;
}

function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
 
}
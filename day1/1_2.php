<?php


$counter = 0;
$previous = null;
$increase = 0;

$sum = [];
$array = [];
$handle = fopen("input_1_1.txt", 'rb');
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $array[] = $line;
    }
    fclose($handle);
}

foreach ($array as $key => $val) {
    $sum[] = $val + @(int)$array[$key + 1] + @(int)$array[$key + 2];
}

foreach ($sum as $val) {
    if (isset($previous) && $previous < (int)$val) {
        $increase++;
    }

    $previous = $val;
}
echo 'Increased ' . $increase . ' times';
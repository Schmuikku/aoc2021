<?php

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';

$gamma = $binary = $epsilon = [];
$counter = $length = 0;
$submarine = new Submarine();

$list = $air = $co2 = $submarine->read(__DIR__ . '/../resources/input_3.txt');

$result = $submarine->binary($list);

$binary = $result['binary'];
$counter = $result['counter'];
$length = $result['length'];

foreach ($binary as $step => $bit) {
    $gamma[$step] = (int)$bit > $counter / 2 ? 1 : 0;
    $epsilon[$step] = (int)$bit < $counter / 2 ? 1 : 0;
}
echo 'Power consumption ' . bindec(implode($gamma)) * bindec(implode($epsilon)) . PHP_EOL;

for ($i = 0; $i < $length; $i++) {
    if (count($air) === 1) {
        break;
    }
    $result = $submarine->binary($air);
    $binary = $result['binary'];
    $counter = $result['counter'];
    $oxygen = (int)($binary[$i] >= $counter / 2);
    foreach ($air as $step => $row) {
        if ($oxygen !== (int)$row[$i]) {
            unset($air[$step]);
        }
    }
    sort($air);
}
print_r($air);

for ($i = 0; $i < $length; $i++) {
    if (count($co2) === 1) {
        break;
    }
    $result = $submarine->binary($co2);
    $binary = $result['binary'];
    $counter = $result['counter'];
    $oxygen = (int)($binary[$i] < $counter / 2);
    foreach ($co2 as $step => $row) {
        if ($oxygen !== (int)$row[$i]) {
            unset($co2[$step]);
        }
    }
    sort($co2);
}
print_r($co2);
echo 'Life support rating ' . bindec(implode($air)) * bindec(implode($co2));
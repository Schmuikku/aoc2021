<?php

ini_set('memory_limit', '-1');

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';

$submarine = new Submarine();
$fishes = $growth = [];
$input = $submarine->read(__DIR__ . '/../resources/input_6.txt');
foreach (explode(',', $input[0]) as $fish) {
    @$fishes[$fish]++;
}
$days = 256;
for ($i = 1; $i <= $days; $i++) {
    for ($x = 8; $x >= -1; $x--) {
        if ($x >= 0) {
            if ($x > 0) {
                @$growth[$x - 1] = ($fishes[$x] ?? 0);
            } else {
                @$growth[8] = $fishes[$x];
                @$growth[6] = ($growth[6] ?? 0) + $fishes[$x];
            }
        }
    }
    $fishes = $growth;
}
echo 'Total of ' . array_sum($fishes) . ' fish';

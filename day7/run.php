<?php

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$submarine = new Submarine();

$input = $submarine->read(__DIR__ . '/../resources/input_7.txt');
$move = [];

for ($x = 1; $x <= 1000; $x++) {
    foreach (explode(',', $input[0]) as $step) {
        @$move[$x] += abs($step - $x);
    }
}

echo 'How much fuel must they spend to align to that position ' . (min($move)) . PHP_EOL;
$move = [];
for ($x = 1; $x <= 1000; $x++) {
    foreach (explode(',', $input[0]) as $step) {
        $steps = abs($step - $x);
        @$move[$x] += array_sum(range(0, $steps));
    }
}

echo 'How much fuel must they spend to align to that position ' . (min($move));
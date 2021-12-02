<?php

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$submarine = new Submarine();

$list = $submarine->read(__DIR__ . '/../resources/input_1.txt');
# 1.
$submarine->depth($list);
echo 'Increased ' . $submarine->getIncreased() . ' times' . PHP_EOL;
# 2.
$submarine->resetIncreased();
$submarine->depth($submarine->aggregate($list));

echo 'Increased ' . $submarine->getIncreased() . ' times' . PHP_EOL;
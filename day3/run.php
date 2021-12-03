<?php

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';

$gamma = $epsilon = [];

$submarine = new Submarine();

$motor = $air = $co2 = $submarine->read(__DIR__ . '/../resources/input_3.txt');

$result = $submarine->motorRadiation($motor);

echo 'Power consumption ' . bindec(implode($result['gamma'])) * bindec(implode($result['epsilon'])) . PHP_EOL;
# Power consumption 775304

$air = $submarine->consumeResources($air, 'air');
$co2 = $submarine->consumeResources($co2, 'co2');

echo 'Life support rating ' . bindec(implode($air)) * bindec(implode($co2));
# Life support rating 1370737
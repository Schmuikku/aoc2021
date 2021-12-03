<?php

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';

$gamma = $epsilon = [];

$submarine = new Submarine();

$motor = $air = $co2 = $submarine->read(__DIR__ . '/../resources/input_3.txt');
$result = $submarine->lifeSupport($motor);

foreach ($result['binary'] as $step => $bit) {
    $gamma[$step] = (int)$bit > $result['counter'] / 2 ? 1 : 0;
    $epsilon[$step] = (int)$bit < $result['counter'] / 2 ? 1 : 0;
}
echo 'Power consumption ' . bindec(implode($gamma)) * bindec(implode($epsilon)) . PHP_EOL;
# Power consumption 775304

$air = $submarine->consumeResources($air, $result['length'], 'air');
$co2 = $submarine->consumeResources($co2, $result['length'], 'co2');

echo 'Life support rating ' . bindec(implode($air)) * bindec(implode($co2));
# Life support rating 1370737
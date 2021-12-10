<?php

ini_set('memory_limit', '-1');

use src\Digits;
use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';

$submarine = new Submarine();

$input = $submarine->read(__DIR__ . '/../resources/input_8.txt');
$counter = 0;
$numbers = [2, 4, 3, 7];
$inOrder = [
    '',
    'ab',
    'acdfg',
    'acdfg',
    'abef',
    'abdfg',
    'bcdefg',
    'abd',
    'abcdefg',
    'abcdef'
];
foreach ($input as $row) {
    [, $output] = explode(' | ', $row);
    foreach (explode(' ', trim($output)) as $digits) {
        if (in_array(strlen(trim($digits)), $numbers, true)) {
            $counter++;
        }
    }
}
echo 'In the output values, how many times do digits 1, 4, 7, or 8 appear? ' . $counter . PHP_EOL;

$sum = 0;
foreach ($input as $line) {
    $sum += Digits::solveLine(trim($line));
}
echo $sum;

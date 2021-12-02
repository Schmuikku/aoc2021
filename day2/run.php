<?php

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$submarine = new Submarine();

$coordinates = $submarine->read(__DIR__ . '/../resources/input_2.txt');
# 1.
$submarine # move and then print current location
    ->move($coordinates)->printCoordinates();
$submarine->resetCoordinates();
# 2.
$submarine # move with aim included and print location
    ->moveExtended($coordinates)->printCoordinates();

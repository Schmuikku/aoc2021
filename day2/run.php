<?php

use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$submarine = new Submarine();

$coordinates = $submarine->read(__DIR__ . '/../resources/input_2.txt');
# 1.
$submarine->move($coordinates);
# 2.
$submarine->moveWithAim($coordinates);

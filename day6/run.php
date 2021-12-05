<?php

use src\Bingo;
use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';


$submarine = new Submarine();
$input = $submarine->read(__DIR__ . '/../resources/input_6.txt');

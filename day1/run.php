<?php


use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$submarine = new Submarine();

$list = $submarine->read('input.txt');

# 1.
$submarine->depth($list);

# 2.
$sum = $submarine->aggregate($list);
$submarine->depth($sum ?? []);

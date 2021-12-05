<?php

use src\Submarine;
use src\Vent;

require_once __DIR__ . '/../vendor/autoload.php';

$submarine = new Submarine();
$points = $submarine->read(__DIR__ . '/../resources/input_5.txt');
$map2dimension = $map3dimension = [];
$counter = 0;

foreach ($points as $point) {
    [$start, $stop] = explode(' -> ', $point);

    [$x1, $y1] = explode(',', $start);
    [$x2, $y2] = explode(',', $stop);

    if ((int)$x1 === (int)$x2 || (int)$y1 === (int)$y2) {
        $x_line = range($x1, $x2);
        $y_line = range($y1, $y2);
        foreach (range($y1, $y2) as $y) {
            foreach (range($x1, $x2) as $x) {
                @$map2dimension[$y][$x] += 1;
                @$map3dimension[$y][$x] += 1;
            }
        }
    }

    $x = range($x1, $x2);
    $y = range($y1, $y2);
    if (count(range($x1, $x2)) === count(range($y1, $y2))) {
        $times = count($x);
        for ($i = 0; $i < $times; $i++) {
            @$map3dimension[$y[$i]][$x[$i]] += 1;
        }
    }
}

$counter = Vent::points($map2dimension);
echo 'Number of points where at least two lines overlap ' . $counter . PHP_EOL;

$counter = Vent::points($map3dimension);
echo 'Number of points where at least two lines overlap ' . $counter;
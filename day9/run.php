<?php

use src\Cave;
use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$submarine = new Submarine();
const MAX = 10;
$lowPoint = $lowPoints = [];
$input = $submarine->read(__DIR__ . '/../resources/input_9.txt');
foreach ($input as $line => $row) {
    $points = str_split(trim($row));
    foreach ($points as $key => $p) {
        if ($p < (@$points[$key - 1] ?? MAX)
            && $p < (@$points[$key + 1] ?? MAX)
            && $p < (@$input[$line - 1][$key] ?? MAX)
            && $p < (@$input[$line + 1][$key] ?? MAX)) {
            $lowPoint[] = $p + 1;
            $size[] = Cave::basin($input, $line, $key);
        }
    }
}

print_r($lowPoints);
echo 'What is the sum of the risk levels of all low points on your heightmap? ' . array_sum($lowPoint);
rsort($size);

echo 'What do you get if you multiply together the sizes of the three largest basins? ' . $size[0] * $size[1] * $size[2];
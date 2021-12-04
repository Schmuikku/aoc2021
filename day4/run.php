<?php

use src\Bingo;
use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$counter = $card = 0;
$bingo = $score = [];

$submarine = new Submarine();
$cards = $submarine->read(__DIR__ . '/../resources/input_4.txt');
$numbers = $submarine->read(__DIR__ . '/../resources/input_4_bingo.txt');

foreach ($cards as $number) {
    if (empty(trim($number))) {
        continue;
    }
    $row = explode(' ', preg_replace('# {2}#', ' ', trim($number)));
    $bingo[$card][] = array_fill_keys($row, 0);
    $counter++;
    if ($counter === 5) {
        $card++;
        $counter = 0;
    }
}

$numbers = array_map('intval', explode(',', $numbers[0]));

foreach ($numbers as $hit) {
    foreach ($bingo as $c => $card) {
        $unmarked = 0;
        foreach ($card as $rows => $row) {
            foreach ($row as $key => $val) {
                $last = $key;
                if ($hit === (int)$key) {
                    $bingo[$c][$rows][$key] = 1;
                }
                $column = Bingo::column($bingo[$c]);
                if ($column || array_sum($bingo[$c][$rows]) === 5) {
                    foreach ($bingo[$c] as $winning) {
                        foreach ($winning as $sum => $value) {
                            if (!$value) {
                                $unmarked += $sum;
                            }
                        }
                    }
                    if (@(int)$score[$c] === 0) {
                        echo "Sum of all unmarked ($c)" . $unmarked . ' last ' . $last . ' final score ' . $unmarked * $last . PHP_EOL;
                        $score[$c] = 1;
                    }
                }
            }
        }
    }
}
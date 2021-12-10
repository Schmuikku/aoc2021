<?php

use src\Code;
use src\Submarine;

require_once __DIR__ . '/../vendor/autoload.php';
$submarine = new Submarine();

$brackets = [
    '{' => '}',
    '(' => ')',
    '[' => ']',
    '<' => '>'
];
$pairs = [
    '()',
    '[]',
    '{}',
    '<>',
];
$fail = [
    ')' => 3,
    ']' => 57,
    '}' => 1197,
    '>' => 25137,
];
$input = $submarine->read(__DIR__ . '/../resources/input_10.txt');
$code = $incompleteTotal = [];
$points = $counter = 0;

foreach ($input as $row) {
    $incomplete = true;
    foreach (str_split(trim($row)) as $char) {
        if (array_key_exists($char, $brackets)) {
            $code[] = $char;
        }
        if (in_array($char, array_values($brackets), true)) {
            $pop = array_pop($code);
            if ($brackets[$pop] !== $char) {
                $points += $fail[$char];
                $incomplete = false;
            }
        }
    }
    if ($incomplete) {
        $complete[] = $row;
    }
}
$missing = [
    ')' => 1,
    ']' => 2,
    '}' => 3,
    '>' => 4,
];


echo 'What is the total syntax error score for those errors? ' . $points . PHP_EOL;

foreach ($complete ?? [] as $string) {
    $split = str_split(trim($string));
    $continue = true;
    while ($continue) {
        $continue = false;
        foreach ($split as $key => $char) {
            if (in_array($char . @$split[$key + 1], $pairs, true) && strlen(trim($char . @$split[$key + 1])) === 2) {
                unset($split[$key]);
                if (!empty($split[$key + 1])) {
                    unset($split[$key + 1]);
                }
                $continue = true;
                break;
            }
        }
        if ($continue) {
            $split = array_values($split);
        }
    }
    $totalScore = 0;
    $split = array_reverse($split);
    foreach ($split as $key => $reverse) {
        $totalScore = (5 * $totalScore + ($missing[$brackets[$reverse]]));
    }
    $incompleteTotal[] = $totalScore;
}

sort($incompleteTotal);
$middle = Code::findEqualPoint($incompleteTotal, count($incompleteTotal));
print_r($incompleteTotal[$middle]);
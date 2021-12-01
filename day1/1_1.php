<?php

$previous = null;
$increase = 0;

$handle = fopen("input_1_1.txt", 'rb');
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        if (isset($previous) && $previous < (int)$line) {
            $increase++;
        }

        $previous = $line;

        print_r($line);
    }

    fclose($handle);
}

echo 'Increased ' . $increase . ' times';
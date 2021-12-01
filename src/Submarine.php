<?php

namespace src;

class Submarine
{
    final public function read(string $file): array
    {
        $list = [];

        $handle = fopen($file, 'rb');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $list[] = $line;
            }
            fclose($handle);
        }

        return $list;
    }

    final public function depth(array $list): void
    {
        $increase = 0;
        $previous = null;

        foreach ($list as $line) {
            if (isset($previous) && $previous < (int)$line) {
                $increase++;
            }
            $previous = (int)$line;
        }

        echo 'Increased ' . $increase . ' times' . PHP_EOL;
    }

    final public function aggregate(array $list): array
    {
        foreach ($list as $key => $val) {
            $sum[] = $val
                + @(int)$list[$key + 1]
                + @(int)$list[$key + 2];
        }

        return $sum ?? [];
    }
}
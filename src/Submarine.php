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

    final public function move(array $coordinates): void
    {
        $horizontal = 0;
        $depth = 0;
        foreach ($coordinates as $val) {
            [$move, $step] = explode(' ', $val);
            switch ($move) {
                case 'forward':
                    $horizontal += (int)$step;
                    break;
                case 'up':
                    $depth -= (int)$step;
                    break;
                case 'down':
                    $depth += (int)$step;
                    break;
                default:
            }
        }

        echo 'Horizontal ' . $horizontal . ' Depth ' . $depth . PHP_EOL;
        echo 'Multiplying ' . ($horizontal * $depth) . PHP_EOL;
    }

    final public function moveWithAim(array $coordinates): void
    {
        $aim = 0;
        $depth = 0;
        $horizontal = 0;

        foreach ($coordinates as $val) {
            [$move, $step] = explode(' ', $val);
            $step = (int)$step;
            switch ($move) {
                case 'forward':
                    $horizontal += $step;
                    $depth += $step * $aim;
                    break;
                case 'up':
                    $aim -= $step;
                    break;
                case 'down':
                    $aim += $step;
                    break;
                default:
            }
        }

        echo 'Horizontal ' . $horizontal . ' Depth ' . $depth . PHP_EOL;
        echo 'Multiplying ' . ($horizontal * $depth) . PHP_EOL;
    }
}
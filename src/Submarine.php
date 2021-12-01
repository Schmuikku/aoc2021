<?php

namespace src;

class Submarine
{
    private array $_list;

    final public function read(string $file): array
    {
        $handle = fopen($file, 'rb');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $this->_list[] = $line;
            }
            fclose($handle);
        }
        return $this->_list;
    }

    /**
     * @param array $file
     * @return void
     */
    final public function depth(array $file): void
    {
        $increase = 0;
        $previous = null;

        foreach ($file as $line) {
            if (isset($previous) && $previous < (int)$line) {
                $increase++;
            }
            $previous = (int)$line;
        }
        echo 'Increased ' . $increase . ' times' . PHP_EOL;
    }

    /**
     * @param array $list
     * @return array
     */
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
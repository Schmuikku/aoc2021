<?php

namespace src;

class Submarine extends Steering implements Location
{
    private int $_increase = 0;

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
        $previous = null;

        foreach ($list as $line) {
            if (isset($previous) && $previous < (int)$line) {
                $this->_increase++;
            }
            $previous = (int)$line;
        }
    }

    final public function getIncreased(): int
    {
        return $this->_increase;
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

    final public function move(array $coordinates): self
    {
        foreach ($coordinates as $val) {
            [$move, $step] = explode(' ', $val);

            match (strtoupper($move)) {
                'UP' => $this->up($step),
                'DOWN' => $this->down($step),
                'FORWARD' => $this->forward($step),
            };
        }

        return $this;
    }

    final public function moveExtended(array $coordinates): self
    {
        foreach ($coordinates as $val) {
            [$move, $step] = explode(' ', $val);

            match (strtoupper($move)) {
                'UP' => $this->aim(-$step),
                'DOWN' => $this->aim($step),
                'FORWARD' => $this->aimForward($step),
            };
        }

        return $this;
    }

    final public function resetIncreased(): void
    {
        $this->_increase = 0;
    }

    final public function printCoordinates(): void
    {
        echo 'Horizontal ' . $this->getHorizontal() . ' Depth ' . $this->getDepth() . PHP_EOL;
        echo 'Multiplying ' . ($this->getHorizontal() * $this->getDepth()) . PHP_EOL;
    }
}
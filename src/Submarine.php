<?php

namespace src;

use JetBrains\PhpStorm\ArrayShape;

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

    final public function consumeResources(array $data, string $resource): array
    {
        $length = strlen($data[0]);
        for ($i = 0; $i < $length; $i++) {
            if (count($data) === 1) {
                break;
            }
            $result = $this->lifeSupport($data);
            $most = self::type($resource, (int)$result['binary'][$i], $result['counter']);
            foreach ($data as $step => $row) {
                if ($most !== (bool)$row[$i]) {
                    unset($data[$step]);
                }
            }
            sort($data);
        }

        return $data;
    }

    #[ArrayShape(['binary' => "array", 'counter' => "int", 'length' => "int"])]
    final public function lifeSupport(array $list): array
    {
        $counter = 0;
        $length = strlen($list[0]);
        foreach ($list as $row) {
            $data = str_split(trim($row));
            foreach ($data as $step => $bit) {
                if (empty($binary[$step])) {
                    $binary[$step] = 0;
                }
                @$binary[$step] += (int)$bit;
            }
            $counter++;
        }

        return ['binary' => $binary ?? [], 'counter' => $counter, 'length' => $length];
    }

    private static function type(string $resource, int $binary, int $counter): bool
    {
        if ($resource === 'air') {
            $oxygen = $binary >= $counter / 2;
        } else {
            $oxygen = $binary < $counter / 2;
        }

        return $oxygen;
    }

    #[ArrayShape(['gamma' => "array", 'epsilon' => "array"])]
    final public function motorRadiation(array $motor): array
    {
        $result = $this->lifeSupport($motor);

        foreach ($result['binary'] as $step => $bit) {
            $gamma[$step] = (int)$bit > $result['counter'] / 2 ? 1 : 0;
            $epsilon[$step] = (int)$bit < $result['counter'] / 2 ? 1 : 0;
        }

        return ['gamma' => $gamma ?? [], 'epsilon' => $epsilon ?? []];
    }
}
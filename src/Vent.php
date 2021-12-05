<?php

namespace src;

class Vent
{
    public static function points(array $map): int
    {
        $counter = 0;
        foreach ($map as $rows) {
            foreach ($rows as $hits) {
                if ((int)$hits >= 2) {
                    $counter++;
                }
            }
        }

        return $counter;
    }
}
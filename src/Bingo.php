<?php

namespace src;

class Bingo
{
    public static function column(array $bingo): bool
    {
        $column = [];
        foreach ($bingo as $row) {
            $counter = 0;
            foreach ($row as $val) {
                if ($val === 1) {
                    @$column[$counter]++;
                }
                $counter++;
            }
        }
        foreach ($column as $value) {
            if ((int)$value === 5) {
                return true;
            }
        }
        return false;
    }
}
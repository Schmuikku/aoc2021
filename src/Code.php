<?php

namespace src;

class Code
{
    public static function findEqualPoint(array $arr, int $n): int
    {
        // To store first indexes of distinct
        // elements of arr[]
        $distArr = array();

        // Traverse input array and store
        // indexes of first occurrences of
        // distinct elements in distArr[]
        $i = 0;
        $di = 0;

        while ($i < $n) {
            // This element must be first
            // occurrence of a number (this
            // is made sure by below loop),
            // so add it to distinct array.
            $distArr[$di++] = $i++;

            // Avoid all copies of arr[i]
            // and move to next distinct
            // element.
            while ($i < $n && $arr[$i] == $arr[$i - 1]) {
                $i++;
            }
        }

        // di now has total number of
        // distinct elements. If di is odd,
        // then equal point exists and is
        // at di/2, otherwise return -1.
        return ($di & 1) ? $distArr[$di >> 1] : -1;
    }
}
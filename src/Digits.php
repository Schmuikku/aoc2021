<?php

namespace src;

class Digits
{
    public static function order(string $string): string
    {
        $arr = str_split($string);
        sort($arr);
        return implode('', $arr);
    }
    public static function solveLine(string $line): int
    {

        $lineSegments = explode(' | ', $line);
        $numbers = explode(' ', $lineSegments[0]);

        $numbersBySegmentCount = [];
        $resolvedNumbers = [];

        foreach ($numbers as $number) {
            $segmentCount = strlen($number);
            $numbersBySegmentCount[$segmentCount][] = str_split($number);
        }

        print_r($numbersBySegmentCount);
        // 1, 4, 7 and 8 have distinct amount of segments, so they can be directly extracted.
        $resolvedNumbers[1] = $numbersBySegmentCount[2][0];
        $resolvedNumbers[4] = $numbersBySegmentCount[4][0];
        $resolvedNumbers[7] = $numbersBySegmentCount[3][0];
        $resolvedNumbers[8] = $numbersBySegmentCount[7][0];

        // 9 is the only 6 segment number that includes all segments of number 4
        foreach ($numbersBySegmentCount[6] as $key => $sixSegmentsNumber) {
            if (count(array_intersect($resolvedNumbers[4], $sixSegmentsNumber)) === 4) {
                $resolvedNumbers[9] = $numbersBySegmentCount[6][$key];
                unset($numbersBySegmentCount[6][$key]);
                break;
            }
        }

        // Now 0 is the only 6 segment number that includes number 7
        foreach ($numbersBySegmentCount[6] as $key => $sixSegmentsNumber) {
            if (count(array_intersect($resolvedNumbers[7], $sixSegmentsNumber)) === 3) {
                $resolvedNumbers[0] = $numbersBySegmentCount[6][$key];
                unset($numbersBySegmentCount[6][$key]);
                break;
            }
        }

        // Last 6 segment number left will be 6 itself
        $resolvedNumbers[6] = current($numbersBySegmentCount[6]);

        // 3 is the only 5 segment number that includes all segments of number 7
        foreach ($numbersBySegmentCount[5] as $key => $fiveSegmentNumber) {
            if (count(array_intersect($resolvedNumbers[7], $fiveSegmentNumber)) === 3) {
                $resolvedNumbers[3] = $numbersBySegmentCount[5][$key];
                unset($numbersBySegmentCount[5][$key]);
                break;
            }
        }

        // 5 is the only 5 segment number included fully in number 6 segments
        foreach ($numbersBySegmentCount[5] as $key => $fiveSegmentNumber) {
            if (count(array_intersect($resolvedNumbers[6], $fiveSegmentNumber)) === 5) {
                $resolvedNumbers[5] = $numbersBySegmentCount[5][$key];
                unset($numbersBySegmentCount[5][$key]);
                break;
            }
        }

        // And the only left 5 segment number is 2
        $resolvedNumbers[2] = current($numbersBySegmentCount[5]);

        foreach ($resolvedNumbers as $key => $number) {
            sort($number);
            $resolvedNumbers[$key] = $number;
        }

        $numbers = explode(' ', $lineSegments[1]);

        $code = '';

        foreach ($numbers as $number) {
            $number = str_split($number);
            sort($number);
            foreach ($resolvedNumbers as $num => $resolvedNumber) {
                if ($resolvedNumber === $number) {
                    $code .= $num;
                }
            }
        }

        return (int) $code;
    }
}
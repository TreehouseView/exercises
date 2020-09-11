<?php

namespace Exercise\Mushrooms;

function solution($A, $k, $m) {
    $maximal = 0;
    $total = count($A);
    $lastKey = $total-1;
    $permutations = [];

    // Create prefix sum
    $prefixSum = prefixSum($A);

    log("Starting at position $k, value {$A[$k]}");
    log("Need to make $m moves");

    $leftMostStart = $k - $m;
    $leftMostEnd = $k;
    if ($leftMostStart < 0) {
        $newEnd = abs($leftMostStart);
        $leftMostStart = 0;
        if ($newEnd > $leftMostEnd) {
            $leftMostEnd = normalizeEndKey($lastKey, $newEnd);
        }
    }

    $rightMostStart = $k;
    $rightMostEnd = $k + $m;
    if ($rightMostEnd > $lastKey) {
        $diff = $rightMostEnd - $lastKey;
        $newStart = $lastKey - $diff;
        if ($newStart < $rightMostStart) {
            $rightMostStart = $newStart;
        }
        $rightMostEnd = $lastKey;
    }

    $permutations[] = [$leftMostStart, $leftMostEnd];
    $permutations[] = [$rightMostStart, $rightMostEnd];
    //log("Left most range ($leftMostStart,$leftMostEnd)");
    //log("Right most range ($rightMostStart, $rightMostEnd)");

    // Generate permutations
    for ($x=$leftMostStart+1;$x<$k;$x++) {
        $start = $x;
        $remainingMoves = $m - ($k - $start);
        $end = $start + $remainingMoves;
        if ($end > $lastKey) {
            $diff = $end - $lastKey;
            $newStart = $lastKey - $diff;
            if ($newStart < $start) {
                $start = $newStart;
            }
            $end = $lastKey;
        }
        //log("$start,$end");
        $permutations[] = [$start, $end];
    }
    
    for ($x=$rightMostEnd-1;$x>$k;$x--) {
        $end = $x;
        $remainingMoves = $m - ($end - $k);
        $start = $end - $remainingMoves;
        if ($start < 0) {
            $newEnd = abs($start);
            $start = 0;
            if ($newEnd > $end) {
                $end = normalizeEndKey($lastKey, $newEnd);
            }
        }
        //log("$start,$end");
        $permutations[] = [$start, $end];
    }
    for ($x=0,$totalp = count($permutations);$x<$totalp;$x++) {
        list($start, $end) = $permutations[$x];
        // Use prefix sum to calculate sum of
        // range in constant time
        $sum = $prefixSum[$end] - $prefixSum[$start-1];
        if ($sum > $maximal) {
            $maximal = $sum;
        }
    }


    return $maximal;
}

function prefixSum($A) {
    $prefix = [
        -1 => 0
    ];
    for ($x=0,$total=count($A);$x<$total;$x++) {
        $prefix[$x] = $A[$x] + $prefix[$x-1];
    }
    return $prefix;
}

function normalizeEndKey($lastKey, $endKey) {
    return $endKey > $lastKey?$lastkey:$endKey;
}

function log($message) {
    //echo "$message\n";
}


var_dump(solution([2, 3, 7, 5, 1, 3, 9], 4, 6) . ' = 25');
var_dump(solution([2, 3, 7, 5, 1, 3, 9], 4, 3) . ' = 16');
var_dump(solution([6, 3, 25, 5, 1, 3, 9 ,23, 24, 9], 4, 4) . ' = 60');

<?php

namespace Exercise\MaxSlice;

// O(n*n)
function solution($A) {
    $maximal = 0;
    $prefixSum = prefixSum($A);
    $total = count($A);
    $lastKey = $total-1;

    for ($x=0;$x<$lastKey;$x++) {
        for ($y=$x+1; $y<$total; $y++) {
            $sum = $prefixSum[$y] - $prefixSum[$x-1];
            if ($maximal < $sum) {
                $maximal = $sum;
            }
        }
    }

    return $maximal;
}

// Optimal solution O(n)
function solution2($A) {
    $maximal = 0;
    $total = count($A);
    $lastKey = $total-1;

    $maxEnding = 0;
    for ($x=0;$x<$total;$x++) {
        $maxEnding = max(0, $maxEnding + $A[$x]);
        $maximal = max($maximal, $maxEnding);
    }

    return $maximal;
}

function max($a, $b) {
    return ($a > $b) ?$a :$b;
}

function prefixSum($A) {
    $prefix = [
        -1 => 0
    ];
    for ($x=0,$total=count($A); $x<$total; $x++) {
        $prefix[$x] = $A[$x] + $prefix[$x-1];
    }
    return $prefix;
}

var_dump(solution([5,-7,3,5,-2,4,-1]) . ' = 10');
var_dump(solution([3,2,-5,78,32,-100,200,23]) . ' = 233');
var_dump(solution2([5,-7,3,5,-2,4,-1]) . ' = 10');
var_dump(solution2([3,2,-5,78,32,-100,200,23]) . ' = 233');

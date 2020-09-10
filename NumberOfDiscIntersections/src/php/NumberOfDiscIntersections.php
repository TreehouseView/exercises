<?php

// you can write to stdout for debugging purposes, e.g.
// print "this is a debug message\n";

function solution($A) {
    $pairs = [];
    $count = 0;
    for ($J = 0,$total = count($A);$J<=$total-2;$J++) {
        for ($K = $J+1;$K<=$total-1;$K++) {
            if ($K-$J <= $A[$K] + $A[$J]) {
                $pairs[] = [$J, $K];
                $count++;
                if ($count > 10000000) {
                    $count = -1;
                    break;
                }
            }
        }
    }
    
   display($pairs);

    return $count;
}

function display($array) {
    foreach ($array as $value) {
        echo "{$value[0]}, {$value[1]}\n";
    }
}

var_dump(solution([1,5,2,1,4,0]) . " = 11");

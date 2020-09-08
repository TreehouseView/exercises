<?php

// you can write to stdout for debugging purposes, e.g.
// print "this is a debug message\n";

function solution($A) {
    $missing = 0;
    $index = array_flip($A);
    $check = 1;
    while (isset($index[$check])) {
        $check++;
    }
    $missing = $check;
    return $missing;
}

var_dump(solution([2,3,1,5]) . ' = 4');

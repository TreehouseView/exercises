<?php

function solution($A) {
    $isPermutation = 1;
    $missing = 1;
    
    // Create index
    $index = array_flip($A);
    
    // Find missing number
    while (isset($index[$missing])) {
        $missing++;
    }
    if ($missing != count($A) + 1) {
        $isPermutation = 0;
    }
    return $isPermutation;
}

var_dump(solution([4,1,3,2,5]) . ' = 1');
var_dump(solution([1,2,3,5]) . ' = 0');

<?php

// you can write to stdout for debugging purposes, e.g.
// print "this is a debug message\n";

function solution($A, $K) {
    $result = $A;
    $total = count($A);

    if ($total == 0) {
        return $result;
    }

    // Determine how many shifts to perform
    // If $K is = to lenght of list, no change necessary
    // If $K is > length of list, determine modulus
    $modulus = $K % $total;
    if ($modulus != 0) {

        $newStartKey = $total - $modulus;
        $stepKey = $newStartKey;
        $iteration = 0;
        $result = [];
        while ($iteration < $total) {
            $result[] = $A[$stepKey];

            // Reset $step to 0
            // if end is reached
            if ($stepKey == $total - 1) {
                $stepKey = 0;
            }
            else {
                $stepKey++;
            }
            $iteration++;
        }
    }
    return $result;
}
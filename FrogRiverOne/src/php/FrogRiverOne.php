<?php

function solution($X, $A) {
    $jumps = -1;
    $index = [];
    $runningTotal = 0;
    for ($x = 0,$total = count($A);$x<$total;$x++) {
        if (!isset($index[$A[$x]])) {
            $index[$A[$x]] = 1;
            $runningTotal += 1;
        }
        if ($runningTotal == $X) {
            $jumps = $x;
            break;
        }
    }

    return $jumps;
}

var_dump(solution(4,[1,1,2,2,3,3,4,5,6]) . ' = 6');

<?php
// you can write to stdout for debugging purposes, e.g.
// print "this is a debug message\n";

function solution($A) {
    $result = 0;
    $total = count($A);
    if ($total % 2 == 0) {
        return $result;
    }
    $index = [];
    for ($x=0;$x<$total;$x++) {
        if (!isset($index[$A[$x]])) {
            $index[$A[$x]] = 1;
        }
        else {
            $index[$A[$x]]++;
        }
    }

    foreach ($index as $key => $value) {
        if ($value % 2 == 1) {
           $result = $key;
            break;
        }
    }
    return $result;
}

var_dump(solution([1,1,2,2,3,3,4]) . ' = 4');
var_dump(solution([1,3,2,60,60,60,38,59,29,52
    ,47,10,52,27,1,3,2,38,59,29,47,10,10,29]) . ' = 27');

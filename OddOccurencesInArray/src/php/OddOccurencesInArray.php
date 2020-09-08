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

<?php

function solution($A) {
    $indexLeader = -1;
    $index = [];
    $keyIndex = [];
    $total = count($A);
    $leader = null;
    for ($y=0; $y<$total; $y++) {
        if (!isset($index[$A[$y]])) {
            $index[$A[$y]] = 0;
        }
        $index[$A[$y]]++;
        if ($index[$A[$y]]/$total > 0.5) {
            $leader = $A[$y];
            break;
        }
    }
    if (!is_null($leader)) {
        for ($x=0; $x<$total; $x++) {
            if ($A[$x] == $leader) {
                $indexLeader = $x;
                break;
            }
        }
    }
    return $indexLeader;
}

var_dump(solution([3,4,3,2,3,-1,3,3]) . ' = 0');

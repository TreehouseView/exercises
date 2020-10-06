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
var_dump(solution([5,5,5,5,5,2,5]) . ' = 0');
var_dump(solution([3,1,33,7,33,20,42,33,33,17
    ,33,33,90,33,27,33,33]) . ' = 2');
var_dump(solution([90,91,92,93,94,95,96,97]) . ' = -1');

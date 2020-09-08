<?php

function solution($X, $Y, $D) {
    $jumps = (int) ceil(($Y-$X) / $D);
    return $jumps;
}

var_dump(solution(1,5,1) . ' = 4');
var_dump(solution(5,5,1) . ' = 0');
var_dump(solution(5,500,499) . ' = 1');
var_dump(solution(1,1000000000,1) . ' = 999999999');

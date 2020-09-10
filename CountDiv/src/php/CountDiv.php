<?php

function solution($A, $B, $K) {
    $high = (int)floor($B/$K);
    $low = (int)ceil($A/$K);
    $divisibleCount = ($high - $low) + 1;
    return $divisibleCount;
}

var_dump(solution(11,345,17) . " = 20");
var_dump(solution(1,1,11) . " = 0");
var_dump(solution(0,0,11) . " =   1");
var_dump(solution(5,10,5) . " = 2");
var_dump(solution(10,10,5) . " = 1");
var_dump(solution(10,11,5) . " = 1");
var_dump(solution(10,10,7) . " = 0");
var_dump(solution(10,10,20) . " = 0");

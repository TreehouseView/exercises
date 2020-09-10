<?php

function solution($N) {
    $result = 0;
    // Convert base-10 to binary
    // Create base 2 headers
    $base2Header = 1;
    $base2Headers = [];
    while ($base2Header <= $N) {
        $base2Headers[] = $base2Header;
        $base2Header = $base2Header * 2;
    }
    
    $binEquivalent = [];
    $accumulator = 0;
    for ($x = count($base2Headers) - 1;$x >= 0;$x--) {
        if ($accumulator + $base2Headers[$x] <= $N) {
            $accumulator = $accumulator + $base2Headers[$x];
            $binEquivalent[] = '1';
        }
        else {
            $binEquivalent[] = '0';
        }
    }
    
    $highScore = 0;
    $accumulator = [
        'zeroCounter' => 0
        ,'highScore' => 0
    ];
    array_walk($binEquivalent, function($value, $key) use(&$accumulator)  {
        if ($value == 1) {
            if ($accumulator['highScore'] < $accumulator['zeroCounter']) {
                $accumulator['highScore'] = $accumulator['zeroCounter'];
            }
            $accumulator['zeroCounter'] = 0;
        }
        else {
            $accumulator['zeroCounter']++;
        } 
    });
    $highScore = $accumulator['highScore'];
    return $highScore;
}


var_dump(solution(50) . ' = 2');
var_dump(solution(1) . ' = 0');
var_dump(solution(10) . ' = 0');
var_dump(solution(11) . ' = 1');
var_dump(solution(436) . ' = 1');
var_dump(solution(1000001) . ' = 5');

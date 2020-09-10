<?php


// Solution in O(N!)
function solution1($A) {
    $pairs = [];
    $count = 0;
    for ($J = 0,$total = count($A);$J<$total-1;$J++) {
        for ($K = $J+1;$K<$total;$K++) {
            if ($K-$J <= $A[$K] + $A[$J]) {
                $pairs[] = [$J, $K];
                $count++;
                if ($count > 10000000) {
                    $count = -1;
                    break;
                }
            }
        }
    }
    
   display($pairs);

    return $count;
}

function display($array) {
    foreach ($array as $value) {
        echo "{$value[0]}, {$value[1]}\n";
    }
}

// More efficient solution
// using O(N)
function solution2($A) {
    $pairs = 0;
    
    // Create index of start and end
    $startIndex = [];
    $endIndex = [];
    
    $total = count($A);
    $lastKey = $total-1; 
    
    for ($x=0; $x<$total; $x++) {
        $start = $x - $A[$x];
        if ($start < 0) {
            $start = 0;
        }
        
        $end = $x + $A[$x];
        if ($end > $lastKey) {
            $end = $lastKey;
        }
        if (!isset($startIndex[$start])) {
            $startIndex[$start] = 1;
        }
        else {
            $startIndex[$start]++;
        }
        
        if (!isset($endIndex[$end])) {
            $endIndex[$end] = 1;
        }
        else {
            $endIndex[$end]++;
        }
        
    }
    
    $activeDiscs = 0;
    // Go through each point
    for ($x=0; $x<$total; $x++) {
        
        // If disc(s) started on 
        // current point
        if (isset($startIndex[$x])
          && $startIndex[$x] > 0) {
            $pairs += $activeDiscs * $startIndex[$x];
            $pairs += ($startIndex[$x] * ($startIndex[$x]-1))/2;
            if ($pairs > 10000000) {
                $pairs = -1;
                break;
            }
            $activeDiscs += $startIndex[$x];
        }
        
        // Deduct from active discs
        // if there are discs that
        // end on current position
        if (isset($endIndex[$x])) {
            $activeDiscs -= $endIndex[$x];
        }
        
    }

    return $pairs;
}

var_dump(solution2([1,5,2,1,4,0]) . " = 11");

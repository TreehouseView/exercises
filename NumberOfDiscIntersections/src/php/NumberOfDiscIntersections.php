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

        // When creating the start index,
        // we need to avoid having negative numbers.
        // This will help when we loop through
        // the positions later so we can start
        // with zero (0) instead of a negative no.
        $start = $x - $A[$x];
        if ($start < 0) {
            $start = 0;
        }
        
        // When creating the end index,
        // we need to avoid having values
        // that exceed the last key.
        // As with the start index, this will
        // make it easier to determine when
        // discs end.
        //
        // Although I suppose it is possible to
        // allow negative starts and ends that
        // exceed the last key as long as we
        // refactor the later loop accordingly
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
    
    // This is where the magic happens.
    //
    // Using the start and end indexes,
    // we walk through each position from
    // start to finish and calculate the
    // intersections based on how many "active"
    // discs there are and how many discs have 
    // started in the current position.
    //
    // Reference: 
    //    https://stackoverflow.com/questions/4801242/algorithm-to-calculate-number-of-intersecting-discs
    $activeDiscs = 0;
    for ($x=0; $x<$total; $x++) {
        
        // If disc(s) started on 
        // current point
        if (isset($startIndex[$x])
          && $startIndex[$x] > 0) {

            // Add the new pairs created from the active
            // discs and the discs that started.
            $pairs += $activeDiscs * $startIndex[$x];

            // And then add all the new pairs created
            // from all the discs that started in
            // the current position.
            $pairs += ($startIndex[$x] * ($startIndex[$x]-1))/2;


            // Just an arbitrary rule defined by the 
            // challenge
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

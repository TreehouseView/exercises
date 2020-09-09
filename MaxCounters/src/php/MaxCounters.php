<?php



// you can write to stdout for debugging purposes, e.g.
// print "this is a debug message\n";
function solution($N, $A) {
    $counters = [];
    for ($x=0;$x<$N;$x++) {
        $counters[$x] = 0;
    }
    $totalOperations = count($A);
    $maxCounter = 0;
    
    /*
     * resetCache: int 
     */
    $resetCache = 0;
    $resetCacheCount = 0;
    
    /*
     * {
     *    counterKey: int => 
     *        resetCacheCount: int => 
     *            bool
     * }
     */
    $resetIndex = [];
    for ($x=0;$x<$totalOperations;$x++) {
        $counterNumber = $A[$x];
        // Increase counter
        if ($counterNumber > 0
          && $counterNumber <= $N) {
            $counterKey = $counterNumber - 1;

            if ($resetCacheCount
              && !isset($resetIndex[$counterKey][$resetCacheCount-1])) {
                $resetIndex[$counterKey][$resetCacheCount-1] = true;
                $counters[$counterKey] = $resetCache;
            }
            $counters[$counterKey] += 1;

            if ($maxCounter < $counters[$counterKey]) {
                $maxCounter = $counters[$counterKey];
            }
        }

        // Set all counters to max
        elseif ($counterNumber > $N) {
            $resetCache = $maxCounter;
            $resetCacheCount++;
        }
    }

    for ($x=0;$x<$N;$x++) {
        if ($resetCacheCount
          && (!isset($resetIndex[$x][$resetCacheCount-1]))) {
            $counters[$x] = $resetCache;
        }
    }

    return $counters;
}


var_dump(implode(',', solution(5,[1,1,1,2,3,5,6,1,6,2,6,3,6,1])) . ' = 7,6,6,6,6');
var_dump(implode(',', solution(5,[])) . ' = 0,0,0,0,0');
var_dump(implode(',', solution(5,[1,1,1,1,1])) . ' = 5,0,0,0,0');
var_dump(implode(',', solution(5,[2,1,2,1,2])) . ' = 2,3,0,0,0');
var_dump(implode(',', solution(5,[2,1,2,1,4,4,4,6,1,2,2])) . ' = 4,5,3,3,3');
var_dump(implode(',', solution(5,[2,1,2,1,4,4,4,6,1,2,2,6])) . ' = 5,5,5,5,5');

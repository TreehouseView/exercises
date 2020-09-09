<?php

/* 
 * Solution in O(2X+N)
 * 
 * The idea is to record the "resets"
 * that occur instead of applying them
 * to all counters every time.
 *
 * Any additional increments that occur
 * on a counter after a reset are calculated
 * accordingly with the reset value applied.
 *
 * After processing all operations, we
 * calculate the final values of the counters
 * and applying the resets to counters
 * that have not been updated.
 * 
 */
function solution($N, $A) {
    $counters = [];
    
    // Prepare counters and their order
    // beforehand
    for ($x=0;$x<$N;$x++) {
        $counters[$x] = 0;
    }
    $totalOperations = count($A);
    $maxCounter = 0;
    
    /*
     * resetCache: int 
     * 
     * Holds the latest reset value
     */
    $resetCache = 0;

    /*
     * Identifies how many resets
     * have been performed.
     *
     * This property can be used to
     * indicate the id of the resetCache
     */
    $resetCacheCount = 0;
    
    /*
     * Used during processing of operations
     * to know if the current reset cache
     * has been applied to the counter
     * {
     *    counterKey: int => 
     *        resetCacheCount: int => 
     *            bool
     * }
     */
    $resetIndex = [];

    /*
     * Process all operations
     */
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

    /*
     * Perform final render of counters
     * before returning
     */
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

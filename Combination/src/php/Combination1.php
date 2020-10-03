<?php

/**
 * Combination exercise
 *
 */


/**
 * Combination
 * 
 * repeat allowed
 *
 * (r+n-1)!/r!(n-r)!
 * 
 */
function repeatAllowed($list, $groupCount) {
    $result = 0;

    return $result;
}

/**
 * Combination
 * 
 * repeat not allowed
 *
 * n!/r!(n-r)!
 *
 */
function repeatNotAllowed($list, $groupCount) {

    $combinations = [];
    $total = count($list);

    if ($groupCount > $total) {
        throw new Exception('INVALID_GROUP_COUNT');
    }

    // Calculate combinations
    $stack1 = [];
    for ($xcount=0;$xcount<$groupCount;$xcount++) {
        $stack1[] = $xcount;
    }
    $stack1LastKey = $groupCount-1;
    while ($stack1[0] <= $total-$groupCount) {

        // Always increment last key
        // until it reaches the end of the list
        while ($stack1[$stack1LastKey] < $total) {
            $combinations[] = $stack1;
            $stack1[$stack1LastKey] += 1;
        }

        // Determine new start
        $x = $stack1LastKey-1;
        if ($x < 0) {
            break;
        }
        while ($stack1[$x] >= $total-($stack1LastKey-$x)) {
            $x--;
        }

        // Update stack with new values
        $newValue = $stack1[$x] + 1;
        for ($y=$x;$y<$groupCount;$y++) {
            $stack1[$y] = $newValue;
            $newValue++;
        }
    }

    foreach ($combinations as $combo) {
        foreach ($combo as $pos) {
            //echo $list[$pos];
        }
        //echo "\n";
    }

    return count($combinations);
}


var_dump(repeatAllowed(['a', 'b', 'c'], 2) . ' = 12');
var_dump(repeatAllowed(['a', 'b', 'c', 'd'], 3) . ' = 120');
var_dump(repeatAllowed(['a', 'b', 'c', 'd'], 4) . ' = 210');
var_dump(repeatAllowed(['a', 'b', 'c', 'd'], 2) . ' = 30');
var_dump(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 2) . ' = ?');
var_dump(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 4) . ' = ?');

var_dump(repeatNotAllowed(['a', 'b', 'c'], 2) . ' = 3');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd'], 3) . ' = 4');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd'], 4) . ' = 1');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd'], 2) . ' = 6');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd'], 1) . ' = 4');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 7) . ' = 1');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 5) . ' = 21');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 3) . ' = 35');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g','h','i','j'], 5) . ' = 252');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g','h','i','j','k','l','m','n','o','p','q'], 9) . ' = 24310');



<?php

/**
 * Problem  1:
 * 
 *   List: a b c d
 * 
 *   grouping: 4
 * 
 */



/**
 * Permutation
 * 
 * repeat allowed
 *
 * n^r
 * 
 */
function repeatAllowed($list, $groupCount) {
    $total = count($list);
    $lastKey = $total-1;
    $permutations = 0;

    // We start from the end
    // and work our way to the beginning
    $collection = $list;

    // We skip one loop here
    // because the initial collection
    // already has the first loop.
    //
    // Sample run:
    //
    // First loop
    //  a
    //  b
    //  c
    //
    // Second loop
    //  aa
    //  ab
    //  ac
    //
    //  ba
    //  bb
    //  bc
    //
    //  ca
    //  cb
    //  cc
    //
    // etc.
    for ($x=0;$x<$groupCount-1;$x++) {
        $temp = [];
        for ($a=0;$a<$total;$a++) {
            for ($y=0,$ct=count($collection);$y<$ct;$y++) {
                $temp[] = $list[$a] . $collection[$y];
            }
        }
        $collection = $temp;
    }

    $permutations = count($collection);

    return $permutations;
}

/**
 * repeat not allowed
 *
 * n!/(n-r)!
 *
 */
function repeatNotAllowed($list, $groupCount) {
    $permutations = 0;
    $total = count($list);

    $perms = recurse('', $list, $groupCount);
    $permutations = count($perms);
    //var_dump($perms);
    
    return $permutations;
}

function recurse($prefix, $list, $groupCount) {
    $temp = [];
    for ($y=0,$t1=count($list);$y<$t1;$y++) {
        $pfx = $prefix . $list[$y];
        $newList = [];
        if ($groupCount-1) {
            for ($x=0;$x<$t1;$x++) {

                // Since we cannot repeat
                // the next number, we
                // skip the number
                // we already chose
                // above
                if ($list[$y] == $list[$x]) {
                    continue;
                }
                $newList[] = $list[$x];
            }
        }
        if ($newList
          && $groupCount-1) {
            $temp = array_merge($temp, recurse($pfx, $newList, $groupCount-1));
        }
        else {
            $temp[] = $prefix;
        }
    }
    return $temp;
}


var_dump(repeatAllowed(['a', 'b', 'c', 'd'], 4) . ' = 256');
var_dump(repeatAllowed(['a', 'b', 'c', 'd'], 2) . ' = 16');
var_dump(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 2) . ' = 25');
var_dump(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 4) . ' = 625');

var_dump(repeatNotAllowed(['a', 'b', 'c', 'd'], 4) . ' = 24');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd'], 2) . ' = 12');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd'], 1) . ' = 4');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 7) . ' = 5040');
var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 5) . ' = 2520');


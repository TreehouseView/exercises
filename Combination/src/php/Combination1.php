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
 * Not an optimal version
 * 
 */
function repeatNotAllowed($list, $groupCount) {

    $permutations = 0;
    $total = count($list);

    //displayArray($list, ',', " - $groupCount");


    $perms = recurse('', $list, $groupCount);
    $permutations = count($perms);
    //displayArray($perms, "\n");
    
    return $permutations;
}

function displayArray($list, $delimiter = ',', $otherDisplay = '') {
    $counter = 0;
    foreach($list as $value){
        if ($counter) {
            echo $delimiter;
        }
        echo $value;
        $counter++;
    }
    echo ", $otherDisplay\n";
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
            $xtmp = [];
            for ($x=0,$xtotal=strlen($pfx);$x<$xtotal;$x++) {
                $xtmp[] = $pfx[$x];
            }
            asort($xtmp);
            $pfx = implode('', $xtmp);
            $temp[$pfx] = $pfx;
        }
    }
    return $temp;
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
//var_dump(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g','h','i','j','k','l','m'], 5) . ' = 21');



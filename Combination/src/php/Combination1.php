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
    $result = 0;

    foreach ($list as $value) {
        echo $value;
    }
    echo ", $groupCount\n";

    // Generate all permutations
    $runningList = $list;
    for ($x=0;$x<$groupCount-1;$x++) {
        $temp = [];
        for ($z=0;$z<count($list);$z++) {
            for ($y=0;$y<count($runningList);$y++) {
                $temp[] = $list[$z] . $runningList[$y];
            }
        }
        $runningList = $temp;
    }

    // Go through each permutation and
    // find unique instances
    $unique = [];
    for ($x=0,$t=count($runningList);$x<$t;$x++) {

        $dupes = [];
        $l=strlen($runningList[$x]);
        for ($y=0;$y<$l;$y++) {
            $dupes[$runningList[$x][$y]] = $runningList[$x][$y];
        }
        if (count($dupes) < $l) {
            continue;
        }
        if (!$unique) {

            // Make is easier to perform
            // lookups where order
            // does not matter
            $xyz = array_keys($dupes);
            asort($xyz);
            $xyz = implode('', $xyz);
            $unique[$xyz] = $xyz;
        }
        else {
            $isUnique = 0;
            $xyz = [];
            for ($o=0;$o<$l;$o++) {
                $xyz[] = $runningList[$x][$o];
            }
            asort($xyz);
            $xyz = implode($xyz);

            if (!isset($unique[$xyz])) {
                $unique[$xyz] = $xyz;
            }
        }
    }

    foreach ($unique as $key => $value) {
        echo $key . "\n";
    }

    $result = count($unique);

    return $result;
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



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
            $unique[] = $dupes;
        }
        else {
            $isUnique = 0;
            for ($z=0;$z<count($unique);$z++) {
                $cc = 0;
                for ($y=0;$y<$l;$y++) {
                    if (!isset($unique[$z][$runningList[$x][$y]])) {
                        break;
                    }
                    $cc++;
                }
                if ($cc < $l) {
                    $isUnique++;
                }
            }
            if ($isUnique == count($unique)) {
                $unique[] = $dupes;
            }
        }
    }

    foreach ($unique as $value) {
        echo implode(',', array_keys($value)) . "\n";
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



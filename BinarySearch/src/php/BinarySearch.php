<?php

/**
 * Simple binary search on an ordered list
 * using iteration instead of recursion.
 *
 * Returns the index location of the $search
 * value in the $list.
 *
 * The goal of the implementation is to reduce the list to
 * one element. Then return the index if remaining
 * element matches $search.
 *
 */
function binarySearch($list, $search) {

    // Handle negative search values immediately
    if ($search < 0) {
        return -1;
    }

    // Since we need to return the index of
    // the original list, we use the indexes
    // for the range so we don't need to
    // perform any conversion.
    $rangeKeys = [0, count($list) - 1];
    do {
        $diff = $rangeKeys[1] - $rangeKeys[0];
        if ($diff == 0
          && $list[$rangeKeys[0]] == $search) {
            return $rangeKeys[0];
        }
        elseif ($diff == 0
          && $list[$rangeKeys[0]] != $search) {
            return -1;
        }

        // To determine the "middle" of the list
        // while maintaining the index key range,
        // we treat the division as an offset.
        $middleKey = floor(($diff)/2) + $rangeKeys[0];
        if ($list[$middleKey] > $search) {
            $rangeKeys = [$rangeKeys[0], $middleKey - 1];
        }
        elseif ($list[$middleKey] == $search) {
            return $middleKey;
        }
        else {
            $rangeKeys = [$middleKey + 1, $rangeKeys[1]];
        }
    } while (count($rangeKeys));
}

/**
 * Simple binary search using recursion
 */
function binarySearch2($list, $search) {

    // Handle negative search values immediately
    if ($search < 0) {
        return -1;
    }

    // Since we need to return the index of
    // the original list, we use the indexes
    // for the range so we don't need to
    // perform any conversion.
    $rangeKeys = [0, count($list) - 1];
    return searchRange($rangeKeys, $list, $search);
}


/**
 * Uses recursion to divide a list in half
 * until a list of one element is reached.
 *
 * Then a comparison is made if the remaining
 * element matches the value being searched.
 */
function searchRange($range, &$list, $search) {
    $rangeKeys = $range;
    $diff = $rangeKeys[1] - $rangeKeys[0];
    if ($diff == 0
      && $list[$rangeKeys[0]] == $search) {
        return $rangeKeys[0];
    }
    elseif ($diff == 0
      && $list[$rangeKeys[0]] != $search) {
        return -1;
    }

    // To determine the "middle" of the list
    // while maintaining the index key range,
    // we treat the division as an offset.
    $middleKey = floor(($diff)/2) + $rangeKeys[0];
    if ($list[$middleKey] > $search) {
        $rangeKeys = [$rangeKeys[0], $middleKey - 1];
    }
    elseif ($list[$middleKey] == $search) {
        return $middleKey;
    }
    else {
        $rangeKeys = [$middleKey + 1, $rangeKeys[1]];
    }

    return searchRange($rangeKeys, $list, $search);
}

$list = [1,3,5,7,9,11,13,15,17,19,21,22,23,25,41,45,99];
var_dump(binarySearch2($list, 4) . ' = -1');
var_dump(binarySearch2($list, 5) . ' = 2');
var_dump(binarySearch2($list, 21) . ' = 10');
var_dump(binarySearch2($list, 100) . ' = -1');
var_dump(binarySearch2($list, -4) . ' = -1');
var_dump(binarySearch2($list, 99) . ' = 16');
var_dump(binarySearch2($list, 23) . ' = 12');

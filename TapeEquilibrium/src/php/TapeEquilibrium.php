<?php

function solution($A) {
    $minimum = null;
    $total = count($A);
    $lastKey = $total - 1;
    $keyRange1 = [];
    $keyRange2 = [];

    $masterTotal = 0;
    for ($x = 0;$x<$total;$x++) {
        $masterTotal += $A[$x];
    }

    $range1Total = 0;
    $range2Total = $masterTotal;
    for ($xKey = 1;$xKey < $total;$xKey++) {

        // First half
        // Exclusive of current key
        $range1Total += $A[$xKey - 1];

        // Second half
        // Inclusive of current key
        $range2Total = $range2Total - $A[$xKey - 1];
        $grandTotal = abs($range1Total - $range2Total);

        if ($grandTotal < $minimum
          || $minimum === null) {
            $minimum = $grandTotal;
        }
    }
    return $minimum;
}

var_dump(solution([3,1,2,4,3]) . ' = 1');

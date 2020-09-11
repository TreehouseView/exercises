<?php

/*
 * Incomplete
 */
function solution($A) {
    $max = 0;
    $total = count($A);
    $totaly = $total - 1;
    $totalx = $total - 2;
    for ($x=0; $x<$totalx; $x++) {
        for ($y=$x+1; $y<$totaly; $y++) {
            for ($z=$y+1; $z<$total; $z++) {
                
                $keys = [$x+1, $x+2, $y-1, $y+1, $y+2, $z-1];
                $keysUnique = array_flip($keys);
                $sum = 0;
                foreach ($keysUnique as $key=>$value) {
                    if ($key <= $totaly) {
                        $sum += $A[$key];
                    }
                }
                //echo "$x,$y,$z = $sum\n";
                if ($sum > $max) {
                    //echo "$x,$y,$z = $sum\n";
                    //var_dump($keysUnique);
                    $max = $sum;
                }
            }
        }
    }
    
    return $max;
}


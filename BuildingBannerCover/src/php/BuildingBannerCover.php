<?php

return function ($H) {
    // write your code in PHP7.0
    $result = 0;

    $increment = 0;
    $length = count($H);

    // Initial height of banner1
    $height = $H[0];

    // Initial height of banner2
    $height2 = max(array_slice($H, 1, $length - 1));

    while ($increment <= $length-1) {
       
        // First banner half
        $width = $increment + 1;

        // Calculate the height for the 
        // first banner by tracking the
        // highest number from each new
        // column added
        if ($height < $H[$increment]) {
            $height = $H[$increment];
        }

        // Evaluate second banner half
        // Only evaluate second banner half
        // if there is a second banner half
        // to evaluate :) that is, the 
        // first half has not consumed the
        // whole list 
        if ($increment + 1 <= $length-1) {
            $width2 = $length - $width;

            // If the height of previous column
            // is equal or greater than the current
            // height2, get the max height of the
            // 2nd half.
            //
            // The check for $increment is to
            // prevent the first loop from
            // recalculating height2
            if ($increment > 0
             && $H[$increment] >= $height2
             && $H[$increment + 1] < $height2) {
                $height2 = max(array_slice($H, $increment + 1, $width2));
            }
        }
        else {
            $width2 = 0;
            $height2 = 0;
        }

        // Evaluate
        $totalArea = ($width * $height) + ($width2 * $height2);
        if ($totalArea < $result
          || $result == 0) {
            $result = $totalArea;
        }

        // Increment
        $increment++;
    }
    return $result;
}

?>

<?php

return function ($H) {
    // write your code in PHP7.0
    $result = 0;

    $increment = 0;
    $length = count($H);
    while ($increment <= $length-1) {
       
        // First half
        $width = $increment + 1;
        $height = max(array_slice($H, 0, $width));

        // Second half
        $width2 = 0;
        $height2 = 0;
        if ($increment+1 <= $length-1) {
            $width2 = $length - $width;
            $height2 = max(array_slice($H, $increment + 1, $width2));
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

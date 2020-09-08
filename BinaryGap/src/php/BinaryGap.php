
function solution($N) {
    $result = 0;
    // Convert base-10 to binary

    // Create base 2 headers
    $base2Header = 1;
    $base2Headers = [];
    while ($base2Header <= $N) {
        $base2Headers[] = $base2Header;
        $base2Header = $base2Header * 2;
    }
    
    $binEquivalent = '';
    $accumulator = 0;
    for ($x = count($base2Headers) - 1;$x >= 0;$x--) {
        if ($accumulator + $base2Headers[$x] <= $N) {
            $accumulator = $accumulator + $base2Headers[$x];
            $binEquivalent .= '1';
        }
        else {
            $binEquivalent .= '0';
        }
    }
    $runningCount = 0;
    $highScore = 0;
    for ($x = 0,$length = strlen($binEquivalent); $x < $length; $x++) {
        if ($binEquivalent[$x] == 1) {
            if ($runningCount > $highScore) {
                $highScore = $runningCount;
            }
            $runningCount = 0;
        }
        else {
            $runningCount++;
        }
    }

    return $highScore;
}


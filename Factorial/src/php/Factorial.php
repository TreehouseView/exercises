<?php

function factorial($n) {
    $result = 1;
    while ($n > 0) {
        $result = $result * $n;
        $n--;
    }
    return $result;
}

var_dump(factorial(16));

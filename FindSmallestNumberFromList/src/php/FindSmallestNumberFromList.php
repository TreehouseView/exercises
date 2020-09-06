<?php

return function ($A) {
    if (!is_array($A)) {
        throw new Exception('Invalid Input');
    }
    // Create Index of numbers
    $A = array_flip($A);
    $result = 1;
    while (isset($A[$result])) {
        $result++;
    }

    return $result;
}

?>

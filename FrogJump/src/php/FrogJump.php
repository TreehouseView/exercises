<?php

function solution($X, $Y, $D) {
    $jumps = (int) ceil(($Y-$X) / $D);
    return $jumps;
}

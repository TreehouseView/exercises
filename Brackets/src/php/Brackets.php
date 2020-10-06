<?php

function solution($S) {
    $stack = [];
    $startIndex = ['('=>')','{'=>"}",'['=>"]"];
    $endIndex = [')'=>'(','}'=>"{",']'=>"["];
    $stackCount = 0;
    $hangingClose = false;

    $length = strlen($S);
    for ($x=0; $x<$length; $x++) {

        // If start symbol found
        // add to stack
        if (isset($startIndex[$S[$x]])) {
            $stack[] = $S[$x];
            $stackCount++;
        }

        // Else if end symbol found
        // remove from stack only if
        // the correct start symbol
        // is found at the top of the
        // stack
        elseif (isset($endIndex[$S[$x]])
          && isset($stack[$stackCount-1])
          && $endIndex[$S[$x]] == $stack[$stackCount-1]) {
            array_pop($stack);
            $stackCount--;
        }
        else {
            $hangingClose = true;
            break;
        }
    }

    // We need to check for hanging
    // open chars and hanging close chars
    return ($stackCount != 0 || $hangingClose) ? 0 :1;
}

var_dump(solution('') . ' = 1');
var_dump(solution('{([])}') . ' = 1');
var_dump(solution('{[])}') . ' = 0');
var_dump(solution('}}}') . ' = 0');
var_dump(solution('[[[[') . ' = 0');
var_dump(solution('[[[') . ' = 0');
var_dump(solution('[[[]]]') . ' = 1');
var_dump(solution('(){}[]') . ' = 1');
var_dump(solution('(){}[') . ' = 0');

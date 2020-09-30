'use strict';

/**
 * Factorial using loop
 */
function factorial(n){
    var result = 1;
    var x = 1;
    while (x <= n) {
        result *= x;
        x++;
    }
    return result;
}

/**
 * Factorial using recursion
 */
function factorial2(n){
    if (n==1) {
        return n;
    }
    var ans = factorial2(n-1);
    return n * ans;
}

console.log(factorial(20));
console.log(factorial2(20));

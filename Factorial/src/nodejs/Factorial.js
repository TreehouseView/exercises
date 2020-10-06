'use strict';

/**
 * Factorial using loop
 */
function factorial(n){
    var result = 1;
    for (let x=1;x<=n;x++) {
        result *= x;
    }
    return result;
}

/**
 * Factorial using recursion
 */
function factorial2(n){
    if (n === 1) {
        return 1;
    }
    return n * factorial2(n-1);
}

console.log(factorial(1) + ' = 1');
console.log(factorial(2) + ' = 2');
console.log(factorial(7) + ' = 5040');
console.log(factorial(20) + ' = 2432902008176640000');
console.log(factorial2(1) + ' = 1');
console.log(factorial2(2) + ' = 2');
console.log(factorial2(7) + ' = 5040');
console.log(factorial2(20) + ' = 2432902008176640000');

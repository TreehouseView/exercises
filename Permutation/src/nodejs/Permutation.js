'use strict';

/**
 * Permutation exercise
 *
 */


/**
 * Permutation
 * 
 * repeat allowed
 *
 * n^r
 * 
 */
function repeatAllowed(list, groupCount) {
    var permutations = [];

    return permutations.length;
}

/**
 * Permutation
 * 
 * repeat not allowed
 *
 * n!/(n-r)!
 *
 */
function repeatNotAllowed(list, groupCount) {
    var permutations = [];

    return permutations.length;
}




console.log(repeatAllowed(['a', 'b', 'c'], 2) + ' = 9');
console.log(repeatAllowed(['a', 'b', 'c','d'], 3) + ' = 64');
console.log(repeatAllowed(['a', 'b', 'c', 'd'], 4) + ' = 256');
console.log(repeatAllowed(['a', 'b', 'c', 'd'], 2) + ' = 16');
console.log(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 2) + ' = 25');
console.log(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 4) + ' = 625');

console.log(repeatNotAllowed(['a', 'b', 'c'], 2) + ' = 6');
console.log(repeatNotAllowed(['a', 'b', 'c','d'], 3) + ' = 24');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd'], 4) + ' = 24');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd'], 2) + ' = 12');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd'], 1) + ' = 4');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 7) + ' = 5040');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 5) + ' = 2520');

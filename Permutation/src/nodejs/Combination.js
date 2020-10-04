'use strict';

/**
 * Combination exercise
 *
 */


/**
 * Combination
 * 
 * repeat allowed
 *
 * (r+n-1)!/r!(n-r)!
 * 
 */
function repeatAllowed(list, groupCount) {
    var combinationCount = 0;

    return combinationCount;
}

/**
 * Combination
 * 
 * repeat not allowed
 *
 * n!/r!(n-r)!
 *
 */
function repeatNotAllowed(list, groupCount) {
    var combinations = [];
    var lastKey = list.length-1;

    if (list.length < groupCount) {
        throw Error('INVALID_GROUP_COUNT');
    }

    var stack = [];
    var x = 99;
    for (let x=0;x<groupCount;x++) {
        stack.push(x);
    }

    var lastStack = groupCount-1;

    while (stack[0]<=list.length-groupCount) {
        while (stack[lastStack] < list.length) {
            combinations.push(stack.slice());
            stack[lastStack] += 1;
        }

        let x=lastStack-1;
        if (x < 0) {
            break;
        }
        while (stack[x] >= lastKey-(lastStack-x)) {
            x--;
        }

        let newValue = stack[x] + 1; 
        let y = 0;
        while (x < groupCount) {
            stack[x] = newValue + y;
            x++;
            y++;
        }
    }

    return combinations.length;
}




console.log(repeatAllowed(['a', 'b', 'c'], 2) + ' = 12');
console.log(repeatAllowed(['a', 'b', 'c', 'd'], 3) + ' = 120');
console.log(repeatAllowed(['a', 'b', 'c', 'd'], 4) + ' = 210');
console.log(repeatAllowed(['a', 'b', 'c', 'd'], 2) + ' = 30');
console.log(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 2) + ' = ?');
console.log(repeatAllowed(['a', 'b', 'c', 'd', 'e'], 4) + ' = ?');

console.log(repeatNotAllowed(['a', 'b', 'c'], 2) + ' = 3');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd'], 3) + ' = 4');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd'], 4) + ' = 1');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd'], 2) + ' = 6');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd'], 1) + ' = 4');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 7) + ' = 1');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 5) + ' = 21');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g'], 3) + ' = 35');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g','h','i','j'], 5) + ' = 252');
console.log(repeatNotAllowed(['a', 'b', 'c', 'd','e','f','g','h','i','j','k','l','m','n','o','p','q'], 9) + ' = 24310');

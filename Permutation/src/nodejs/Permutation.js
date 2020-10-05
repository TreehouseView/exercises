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

    var permutations = list;

    // Loop through each group count
    for (let x=1;x<groupCount;x++) {
        let temp = [];

        // Loop through each list
        for (let y=0;y<list.length;y++) {

            // Loop through each generated permutation
            for (let z=0;z<permutations.length;z++) {
                temp.push(list[y] + permutations[z]);
            }
        }

        // Update list with new permutations
        permutations = temp;
    }

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
    var permutations = list.map((value, key) => {
        return key.toString();
    });

    // Loop through each group count
    for (let x=1;x<groupCount;x++) {
        let temp = [];

        // Loop through each generated permutation
        for (let y=0;y<permutations.length;y++) {

            // determine new list
            let indexer = createIndex(Array.from(permutations[y]));
            let newList = [];
            list.forEach((value, index) => {
                if (!indexer.has(index.toString())) {
                    newList.push(index.toString());
                }
            });

            newList.forEach((value) => {
                temp.push(permutations[y] + ',' + value);
            });
        }

        // Update permutation list
        permutations = temp;
    }

    return permutations.length;
}

function createIndex(list) {
    var mapper = new Map();
    list.forEach((value) => {
        mapper.set(value,value);
    });
    return mapper;
}

function factorial(n) {
    var accum = 1;
    for (let x=1;x<=n;x++) {
        accum *= x;
    }
    return accum;
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

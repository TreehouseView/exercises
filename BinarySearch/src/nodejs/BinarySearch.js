'use strict';

/**
 * Simple binary search on an ordered list
 * using iteration instead of recursion.
 *
 * Returns the index location of the search
 * value in the list and -1 if not found
 *
 */
function binarySearch(list, search) {
    var ans = -1;

    var listEval = list.map((value, key) => key);
    var continueSearch = true;
    while (continueSearch) {

        //console.log(listEval);

        // Evaluate
        if (listEval.length === 1) {
            if (list[listEval[0]] === search) {
                ans = listEval[0];
            }
            continueSearch = false;
        }
        else if (listEval.length > 1) {
            let midpoint = Math.ceil(listEval.length / 2);
            let midKey = midpoint - 1;
            if (list[listEval[midKey]] === search) {
                ans = listEval[midKey];
                continueSearch = false;
            } 
            else if (list[listEval[midKey]] > search) {
                listEval = listEval.slice(0, midpoint);
            }
            else {
                listEval = listEval.slice(midpoint);
            }
        }

    }
    
    return ans;
}

/**
 * Simple binary search using recursion
 */
function binarySearch2(list, search) {
    var ans = -1;

    return ans;
}



var list = [1,3,5,7,9,11,13,15,17,19,21,22,23
    ,25,41,45,99,104,150,169,182,201,231
    ,232,239,249,256,271,283,289,290,299,300
];
console.log(list);
console.log(binarySearch(list, 4) + ' = -1');
console.log(binarySearch(list, 5) + ' = 2');
console.log(binarySearch(list, 21) + ' = 10');
console.log(binarySearch(list, 100) + ' = -1');
console.log(binarySearch(list, -4) + ' = -1');
console.log(binarySearch(list, 99) + ' = 16');
console.log(binarySearch(list, 23) + ' = 12');
console.log(binarySearch(list, 289) + ' = 29');

console.log(binarySearch2(list, 4) + ' = -1');
console.log(binarySearch2(list, 5) + ' = 2');
console.log(binarySearch2(list, 21) + ' = 10');
console.log(binarySearch2(list, 100) + ' = -1');
console.log(binarySearch2(list, -4) + ' = -1');
console.log(binarySearch2(list, 99) + ' = 16');
console.log(binarySearch2(list, 23) + ' = 12');
console.log(binarySearch2(list, 289) + ' = 29');

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
    var ans = null;

    var listEval = list.map((value, key) => key);
    while (ans === null
        && listEval.length > 0
    ) {

        // The goal is to have a list
        // that is only one element in length
        if (listEval.length === 1) {
            if (list[listEval[0]] === search) {
                ans = listEval[0];
            }
            listEval = [];
        }

        // Split the current list in half
        // and update listEval with
        // the half that contains the
        // search item
        else if (listEval.length > 1) {
            let midpoint = Math.ceil(listEval.length / 2);
            let midKey = midpoint - 1;

            // If the midpoint is the item
            // we're searching, return that
            if (list[listEval[midKey]] === search) {
                ans = listEval[midKey];
            } 

            // If the midpoint is greater than the
            // search value, update listEval with
            // the first half
            else if (list[listEval[midKey]] > search) {
                listEval = listEval.slice(0, midpoint);
            }
            //
            // If the midpoint is less than the
            // search value, update listEval with
            // the other half
            else {
                listEval = listEval.slice(midpoint);
            }
        }
    }
    
    return (ans === null) ? -1 : ans;
}

/**
 * Simple binary search using recursion
 */
function binarySearch2(list, search) {
    let listKeys = list.map((value, key) => key);
    var ans = searchRecurse(list, search, listKeys); 

    return ans;
}

function searchRecurse(list, search, listKeys) {
    let ans = -1;

    // If we're down to one element
    if (listKeys.length === 1) { 
        if (list[listKeys[0]] === search) {
            ans = listKeys[0];
        }
    }

    // Break up list in half
    // and re-evaluate half with
    // the search value
    else if (listKeys.length > 1) {
        let midpoint = Math.ceil(listKeys.length/2);
        let midKey = midpoint-1;

        // If midkey matches search, return
        // midkey
        if (list[listKeys[midKey]] === search) {
            ans = listKeys[midKey];
        }

        // If midpoint is greater than search,
        // use first half of list
        else if (list[listKeys[midKey]] > search) {
            ans = searchRecurse(list, search, listKeys.slice(0,midpoint));
        }
        
        // If midpoint is less than search,
        // use other half of list
        else {
            ans = searchRecurse(list, search, listKeys.slice(midpoint));
        }
    }
    return ans;
}



var list = [1,3,5,7,9,11,13,15,17,19,21,22,23
    ,25,41,45,99,104,150,169,182,201,231
    ,232,239,249,256,271,283,289,290,299,300
];
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

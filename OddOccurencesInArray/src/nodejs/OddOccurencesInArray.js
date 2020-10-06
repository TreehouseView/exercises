'use strict';

function solution(A) {
    var ans = 0;

    var candidates = new Map();
    var indexer = A.reduce((accum, value) => {
        if (accum.has(value)) {
            accum.set(value, accum.get(value) + 1);
            candidates.delete(value);
        }
        else {
            accum.set(value, 1);
            candidates.set(value,value);
        }
        return accum;
    }, new Map());

    ans = candidates.keys().next().value;

    return ans;
}


console.log(solution([1,1,2,2,3,3,4]) + ' = 4');
console.log(solution([1,3,2,60,60,60,38,59,29,52
    ,47,10,52,27,1,3,2,38,59,29,47,10,10,29]) + ' = 27');

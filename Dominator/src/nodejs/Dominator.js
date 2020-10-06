'use strict';

function solution(A) {
    let ans = -1;

    let dominator = null;
    let indexex = A.reduce((accum, value) => {
        if (!accum.has(value)) {
            accum.set(value, 1);
        }
        accum.set(value, accum.get(value) + 1);
        if (accum.get(value)/A.length > .50) {
            dominator = value;
        }
        return accum;

    }, new Map());

    if (dominator !== null) {
        for (let x=0;x<A.length;x++) {
            if (dominator === A[x]) {
                ans = x;
                break;
            }
        }
    }

    return ans;
}

console.log(solution([3,4,3,2,3,-1,3,3]) + ' = 0');
console.log(solution([5,5,5,5,5,2,5]) + ' = 0');
console.log(solution([3,1,33,7,33,20,42,33,33,17
    ,33,33,90,33,27,33,33]) + ' = 2');
console.log(solution([90,91,92,93,94,95,96,97]) + ' = -1');


'use strict';

function solution(A, K) {
    let ans = A.slice();
    let lastKey = A.length-1;

    let rotateCount = K % A.length;
    if (rotateCount !== 0) {
        let key = A.length - rotateCount;
        for (let x=0;x<A.length;x++) {

            // Assign
            ans[x] = A[key];

            // Evaluate
            key += 1;
            if (key > lastKey) {
                key = 0;
            }
        }
    }

    return ans;
}

console.log(solution([1,2,3,4], 16).toString() + ' = 1,2,3,4');
console.log(solution([1,2,3,4], 17).toString() + ' = 4,1,2,3');
console.log(solution([1,2,3,4], 18).toString() + ' = 3,4,1,2');
console.log(solution([1,2,3,4], 19).toString() + ' = 2,3,4,1');
console.log(solution([1,2,3,4], 20).toString() + ' = 1,2,3,4');
console.log(solution([1,2,3,4], 0).toString() + ' = 1,2,3,4');
console.log(solution([1,2,3,4], 4).toString() + ' = 1,2,3,4');


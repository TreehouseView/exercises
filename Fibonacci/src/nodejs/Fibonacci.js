'use strict';

function solution(N) {
    let result = [0];

    let value = 1;
    while (value <= N) {
        result.push(value);
        value = result[result.length-1] + result[result.length-2];
    }

    return result;
}

console.log(solution(21));
console.log(solution(100));
console.log(solution(1));
console.log(solution(0));

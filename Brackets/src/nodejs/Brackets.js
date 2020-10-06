'use strict';

function solution(S) {
    var ans = 1;

    var myStack = [];
    var symbolMap = new Map();
    symbolMap.set('{','}');
    symbolMap.set('(',')');
    symbolMap.set('[',']');

    // Count the number of opening
    // symbols found.
    // This is useful later to
    // determine if the string
    // has all closing symbols.
    var openCount = 0;

    if (S.length % 2 === 0) {
        for (let x=0;x<S.length;x++) {
            // Opening symbol
            if (symbolMap.has(S[x])) {
                myStack.push(S[x]);
                openCount++;
            }

            // Closing symbol
            else if (myStack.length
             && symbolMap.get(myStack[myStack.length-1]) === S[x]) {
                myStack.pop();
            }
            else {
                break;
            }
        }
    }

    if (myStack.length > 0
      || (S.length > 0 && openCount === 0)) {
        ans = 0;
    }

    return ans;
}

console.log(solution('') + ' = 1');
console.log(solution('{([])}') + ' = 1');
console.log(solution('{[])}') + ' = 0');
console.log(solution('{[])}}') + ' = 0');
console.log(solution('}}}') + ' = 0');
console.log(solution('}}}]') + ' = 0');
console.log(solution('[[[[') + ' = 0');
console.log(solution('[[[') + ' = 0');
console.log(solution('[[[]]]') + ' = 1');
console.log(solution('(){}[]') + ' = 1');
console.log(solution('(){}[') + ' = 0');

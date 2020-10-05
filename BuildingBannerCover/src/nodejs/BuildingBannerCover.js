'use strict';

function solution(H) {
    var lastKey = H.length-1;
    
    // Used to calculate initial min
    // area. This is mainly to avoid
    // having to check for null
    // on the first iteration
    var top = 0;

    // List of the top height for first half
    var top1 = Array(H.length).fill(0);
    
    // List of the top height for second half
    var top2 = Array(H.length).fill(0);

    var top1Current = 0;
    var top2Current = 0;
    for (let x=0;x<H.length;x++) {

        // Determine the top height for position (x)
        top1Current = Math.max(top1Current, H[x]);
        top1[x] = top1Current;
        
        // Determine the top height for position (lastKey - x)
        top2Current = Math.max(top2Current, H[lastKey-x]);
        top2[lastKey-x] = top2Current;
        top = Math.max(top1Current, top2Current);
    }

    // Default answer
    var ans = top * H.length;

    for (let x=0;x<H.length;x++) {
        // First half
        let h1 = top1[x];
        let w1 = x+1;
        
        let h2 = 0;
        let w2 = H.length-w1;
        if (w2 > 0) {
            // Second half
            h2 = top2[x+1];

            // Optimization:
            // We don't need to evaluate for 
            // one banner because we already did 
            // with the initial value of ans 
            // so perform the evaluation only 
            // when there are two banners
            let totalArea = (h1*w1) + (h2*w2);
            ans = Math.min(ans, totalArea);
        }
    } 

    return ans;
}


console.log(solution([3,1,4]) + ' =  10');
console.log(solution([5,3,2,4]) + ' =  17');
console.log(solution([5,3,5,2,1]) + ' =  19');
console.log(solution([7,7,3,7,7]) + ' =  35');
console.log(solution([1,1,7,6,6,6]) + ' =  30');
console.log(solution([100,100,100,100]) + ' =  400');
console.log(solution([5,10,5,10]) + ' =  35');
console.log(solution([100,104,3,500,309,1000,24,15,293,43,123,934,432,32]) + ' =  11312');

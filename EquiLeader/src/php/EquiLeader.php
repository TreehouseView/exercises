<?php

function solution($A) {
    $equiLeaders = 0;
    
    $total = count($A);
    $lastKey = $total-1;
    for ($x=0; $x<$lastKey; $x++) {
        // Calculate leader of First half
        // If no leader, skip
        $leader1Index = [];
        $leader1 = null;
        $start1 = 0;
        $end1 = $x;
        
        for ($y=$start1; $y<=$end1; $y++) {
            if (!isset($leader1Index[$A[$y]])) {
                $leader1Index[$A[$y]] = 0;
            }
            $leader1Index[$A[$y]]++;
            if ($leader1Index[$A[$y]]/($end1-$start1+1) > 0.5) {
                $leader1 = $A[$y];
            }
        }
        
        if (is_null($leader1)) {
            continue;
        }
        // Calculate leader of Second half
        // If no leader, skip
        $leader2Index = [];
        $leader2 = null;
        $start2 =  $x + 1;
        $end2 = $lastKey;
        
        for ($y=$start2; $y<=$end2; $y++) {
            if (!isset($leader2Index[$A[$y]])) {
                $leader2Index[$A[$y]] = 0;
            }
            $leader2Index[$A[$y]]++;
            if ($leader2Index[$A[$y]]/($end2-$start2+1) > 0.5) {
                $leader2 = $A[$y];
            }
        }
        
        if (is_null($leader2)) {
            continue;
        }
        if ($leader1 == $leader2) {
            //echo "Equileader: $x with $leader1 == $leader2, range $start1,$end1, $start2,$end2\n";
            $equiLeaders++;
        }
    }
    
    
    return $equiLeaders;
}

/*
 * Solution in Java
 *
 * Reference:
 *  https://funnelgarden.com/equileader-codility-solution/
 *
    int lastCandidateOccurenceIndex = 0;
    int runningDominatorCount = 0;
    for(int i=0; i<A.length-1; i++) { 
        if(A[i] == candidate) { 
            lastCandidateOccurenceIndex = i; 
            runningDominatorCount = dominatorMap.get(i).intValue(); 
        } else if(dominatorMap.get(lastCandidateOccurenceIndex) != null) { 
            runningDominatorCount = dominatorMap.get(lastCandidateOccurenceIndex).intValue();
        } 
        if(runningDominatorCount > (i+1)/2) {
            if((dominatorCount - runningDominatorCount) > (A.length - (i+1))/2 ) {
              equiLeaders++;
            }
        }
    }
 */

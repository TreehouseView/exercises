<?php

function main($rods) {
        $startTime = microtime(true);
	echo "Start\n";
	displayRods($rods);
	echo "\n---\n";
	$lastRod = 1;
	$move = 0;
	while(
	 !empty($rods[0])
	 || (!empty($rods[1])
	  && !empty($rods[2]))) {
	   $move++;
	   list($in, $out) = move($rods, $lastRod, $move);
	   $lastRod = $in;
	   array_push($rods[$in],array_pop($rods[$out]));
	   // Sanity checks
	   if (count($rods[$in]) > 1
	     && $rods[$in][count($rods[$in])-1] < $rods[$in][count($rods[$in])-2]) {
		throw new Exception('Invalid move', 1002);
	   }
	   if ($move>4000000000) {
		throw new Exception('Loop limit exceeded', 1000);
	   }
	}
	echo "Finish\n";
	echo "Moves: $move\n";
	echo "Time: " . (microtime(true)-$startTime) . " sec.\n";
	displayRods($rods);
}

function move($rods,$lastRod, $move) {
	 list($rodtemp1,$rodtemp2) = array_values(array_diff(array(0,1,2), array($lastRod)));
	 $temp1Count = count($rods[$rodtemp1]);
	 $temp2Count = count($rods[$rodtemp2]);
	 if (!$temp1Count) {
	   $out = $rodtemp2;
	 } elseif (!$temp2Count) {
	   $out = $rodtemp1;
	 } elseif ($rods[$rodtemp1][$temp1Count-1] > $rods[$rodtemp2][$temp2Count-1]){
	   $out = $rodtemp1;
	 }else {
	   $out = $rodtemp2;
	 }
	 $moveKey = abs(($move%3)-3);
	 $in = $moveKey - $out;
	 return array($in, $out);
}

function displayRods($rods) {
        array_map(create_function('$value', 'echo "[" .  implode(",", $value) ."]\n";'), $rods);
}

$rods = array(
 0 => range(1,9),
 1 => array(),
 2 => array()
);
main($rods);

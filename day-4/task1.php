<?php

$file = 'day-4/input.txt';
if (file_exists($file)) {
	$input = file($file);
}

$sum = 0;
foreach ($input as $line) {
	$line = 'not-a-real-room-404[oarel]';
	var_dump($line);
	$parts = explode('-', $line);
	$endPart = preg_split('/[\[\]]/', end($parts));
	//var_dump($parts);
	//var_dump($endPart);
	for ($i=0; $i<sizeof($parts)-1; $i++) {
		for ($j=0; $j<strlen($parts[$i]); $j++) {
			$letter = $parts[$i][$j];
			$letters[$letter] = (isset($letters[$letter])) ? $letters[$letter]+1 : 1;
		}
	}
	arsort($letters);
	var_dump($letters);
	if (false) {
		$sum += (int)$endPart[0];
	}
	$letters = [];
	exit;
}

echo "sum of the sector IDs of the real rooms: $sum\n";

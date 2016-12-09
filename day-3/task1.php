<?php

$file = 'day-3/input.txt';
if (file_exists($file)) {
	$input = file($file);
}

$triangles = 0;
foreach ($input as $line) {
	preg_match_all('/\d+/', $line, $side_lengths);
	$side_lengths = array_map('intval', $side_lengths[0]);
	sort($side_lengths);
	if ($side_lengths[0] + $side_lengths[1] > $side_lengths[2]) {
		$triangles++;
	}
}

echo "valid triangles: $triangles\n";

<?php

$file = 'day-3/input.txt';
if (file_exists($file)) {
	$input = file($file);
}

$i = 0;
$triangles = 0;
foreach ($input as $line) {
	preg_match_all('/\d+/', $line, $side_lengths);
	$side_lengths = array_map('intval', $side_lengths[0]);
	$tr1[] = $side_lengths[0];
	$tr2[] = $side_lengths[1];
	$tr3[] = $side_lengths[2];
	if ($i == 2) {
		for ($j=1; $j<4; $j++) {
			sort(${'tr'.$j});
			if (${'tr'.$j}[0] + ${'tr'.$j}[1] > ${'tr'.$j}[2]) {
				$triangles++;
			}
		}
		$i = -1;
		$tr1 = [];
		$tr2 = [];
		$tr3 = [];
	}
	$i++;
}

echo "valid triangles: $triangles\n";

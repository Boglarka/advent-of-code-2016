<?php

$file = 'day-8/input.txt';
if (file_exists($file)) {
	$input = file($file);
}

for ($i=0; $i<6; $i++) {
	for ($j=0; $j<50; $j++) {
		$mx[$i][$j] = 0;
	}
}

$count = 0;
foreach ($input as $line) {
	if (strpos($line, 'rect') !== false) {
		preg_match('/([0-9]+)x([0-9]+)/', $line, $matches);
		for ($i=0; $i<$matches[1]; $i++) {
			for ($j=0; $j<$matches[2]; $j++) {
				$mx[$j][$i] = 1;
			}
		}
	} else if (strpos($line, 'rotate row') !== false) {
		preg_match('/y=([0-9]+) by ([0-9]+)/', $line, $matches);
		for ($i=0; $i<sizeof($mx[0]); $i++) {
			if ($i+$matches[2] < sizeof($mx[0])) {
				$newRow[$i+$matches[2]] = $mx[$matches[1]][$i];
			} else {
				$newRow[$i+$matches[2] - sizeof($mx[0])] = $mx[$matches[1]][$i];
			}
		}
		$mx[$matches[1]] = $newRow;
	} else {
		preg_match('/x=([0-9]+) by ([0-9]+)/', $line, $matches);
		for ($i=0; $i<sizeof($mx); $i++) {
			if ($i+$matches[2] < sizeof($mx)) {
				$newCol[$i+$matches[2]] = $mx[$i][$matches[1]];
			} else {
				$newCol[$i+$matches[2] - sizeof($mx)] = $mx[$i][$matches[1]];
			}
		}
		for ($i=0; $i<sizeof($mx); $i++) {
			$mx[$i][$matches[1]] = $newCol[$i];
		}
	}
	$newRow = [];
	$newCol = [];
}

for ($i=0; $i<6; $i++) {
	$code = '';
	for ($j=0; $j<50; $j++) {
		if ($mx[$i][$j] == 1) {
			$code .= '#';
		} else {
			$code .= ' ';
		}
	}
	echo $code."\n";
}

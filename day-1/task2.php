<?php

$direction = 0; //North
$north = 0;
$west = 0;
$north_stops = [0];
$west_stops = [0];
$j = 0;

$puzzle = 'R4, R1, L2, R1, L1, L1, R1, L5, R1, R5, L2, R3, L3, L4, R4, R4, R3, L5, L1, R5, R3, L4, R1, R5, L1, R3, L2, R3, R1, L4, L1, R1, L1, L5, R1, L2, R2, L3, L5, R1, R5, L1, R188, L3, R2, R52, R5, L3, R79, L1, R5, R186, R2, R1, L3, L5, L2, R2, R4, R5, R5, L5, L4, R5, R3, L4, R4, L4, L4, R5, L4, L3, L1, L4, R1, R2, L5, R3, L4, R3, L3, L5, R1, R1, L3, R2, R1, R2, R2, L4, R5, R1, R3, R2, L2, L2, L1, R2, L1, L3, R5, R1, R4, R5, R2, R2, R4, R4, R1, L3, R4, L2, R2, R1, R3, L5, R5, R2, R5, L1, R2, R4, L1, R5, L3, L3, R1, L4, R2, L2, R1, L1, R4, R3, L2, L3, R3, L2, R1, L4, R5, L1, R5, L2, L1, L5, L2, L5, L2, L4, L2, R3';
$puzzle = explode(', ', $puzzle);

foreach ($puzzle as $i) {
	$step = (int)substr($i, 1);
	if ($i[0] == 'L') {
		$direction--;
	} else {
		$direction++;
	}

	switch ($direction % 4) {
		// North
		case 0:
			$north += $step;
			break;
		// East
		case 1:
			$west -= $step;
			break;
		// South
		case 2:
			$north -= $step;
			break;
		// West
		case 3:
			$west += $step;
			break;
		// West
		case -1:
			$west += $step;
			break;
		// South
		case -2:
			$north -= $step;
			break;
		// East
		case -3:
			$west -= $step;
			break;
	} 

	$north_stops[] = $north;
	$west_stops[] = $west;

	if ($j > 2) {
		if (intersection($step, $north_stops, $west_stops)) break;
	}

	$j++;
}

function intersection($step, $north_stops, $west_stops) {
	for ($j = 1; $j<=$step; $j++) {
		if (end($west_stops) == $west_stops[sizeof($west_stops)-2]) {
			$x = end($west_stops);
			$y = $north_stops[sizeof($north_stops)-2] + ($north_stops[sizeof($north_stops)-2] < end($north_stops) ? $j : -1 * $j);
		} else {
			$x = $west_stops[sizeof($west_stops)-2] + ($west_stops[sizeof($west_stops)-2] < end($west_stops) ? $j : -1 * $j);
			$y = end($north_stops);
		}

		for ($i = 0; $i<sizeof($north_stops)-2; $i++) {
			$north_between = [$north_stops[$i], $north_stops[$i+1]];
			$west_between = [$west_stops[$i], $west_stops[$i+1]];
			if ($y >= min($north_between) && $y <= max($north_between) && $x >= min($west_between) && $x <= max($west_between)) {
				echo "x: $x\ny: $y\nblocks away: ".(abs($x)+abs($y))."\n";
				return true;
			}
		}
	}
}

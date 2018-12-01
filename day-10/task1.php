<?php

$file = 'day-10/input.txt';
if (file_exists($file)) {
	$input = file($file);
}
/*
$input = 'value 61 goes to bot 200
bot 200 gives low to bot 40 and high to bot 141
value 69 goes to bot 200
value 37 goes to bot 97';
$input = explode("\n", $input);
*/

$num = 0;
foreach ($input as $line) {
	preg_match_all("/[0-9]+/", $line, $nums);
	if (sizeof($nums[0]) == 2) {
		$bots[$nums[0][1]][] = (int)$nums[0][0];
	}
}
foreach ($bots as $bot => $mch) {
	asort($mch);
	$bots[$bot] = $mch;
}
var_dump($bots);

foreach ($input as $line) {
	preg_match_all("/[0-9]+/", $line, $nums);
	if (sizeof($nums[0]) == 3) {
		//echo 'alma';
		var_dump($line);
		//var_dump($nums[0]);
		//var_dump($bots);
		//var_dump($bots[$nums[0][0]][0]);

		if ($bots[$nums[0][0]][0] == 17 && $bots[$nums[0][0]][1] == 61) {
		//if ($bots[$nums[0][0]][0] == 61 && $bots[$nums[0][0]][1] == 69) {
			$num = $nums[0][0];
			break;
		}

		$bots[$nums[0][1]][] = $bots[$nums[0][0]][0];
		$bots[$nums[0][2]][] = $bots[$nums[0][0]][1];
		$bots[$nums[0][0]] = [];
		exit;
	}
	//var_dump($bots);
	//exit;
}

echo "number of the bot which is responsible for comparing value-61 to value-17 microchips: $num\n";

<?php

$doorID = 'ffykfhsq';

$j = 0;
$password = [];
for ($i=0; $i<8; $i++) {
	$found = false;
	while ($found == false) {
		$hash = md5($doorID.$j);
		if (substr($hash, 0, 5) === '00000' && is_numeric($hash[5]) && $hash[5] < 8 && !in_array($hash[5], array_keys($password))) {
			$password[$hash[5]] = $hash[6];
			$found = true;
		}
		$j++;
	}
}
ksort($password);

echo "password: ".implode($password)."\n";

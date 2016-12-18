<?php

$doorID = 'ffykfhsq';

$j = 0;
$password = '';
for ($i=0; $i<8; $i++) {
	$found = false;
	while ($found == false) {
		$hash = md5($doorID.$j);
		if (substr($hash, 0, 5) === '00000') {
			$password .= $hash[5];
			$found = true;
		}
		$j++;
	}
}

echo "password: $password\n";

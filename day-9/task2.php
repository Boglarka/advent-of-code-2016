<?php

ini_set('memory_limit', -1);

$file = 'day-9/input.txt';
if (file_exists($file)) {
	$input = file($file)[0];
}

$length = 0;
$input = preg_replace('/\s/', '', $input);
//echo 12*10*14*12*12;
//echo 41*9+76;
//exit;
$input = '(14x3)(9x2)(4x2)ALMA';

for ($i=0; $i<strlen($input); $i++) {
	$char = $input[$i];
	var_dump($i);
	var_dump($char);
	if (ctype_alpha($char) && $char != 'x') {
		$length += 1;
	} else {
		$res = getStrLength($input, $i, $length);
		$i = $res[0];
		$lengths[] = $res[1];
		var_dump($res);
	}
}
var_dump($lengths);

function getStrLength($str, $i, $length) {
	var_dump($i);
	preg_match('/([0-9]+)x([0-9]+)/', substr($str, $i+1), $matches);
	var_dump($matches);
	if (!$matches) {
		$substr = $str;
	} else {
		$substr = substr($str, $i+strlen($matches[0])+2, (int)$matches[1]);
	}
	var_dump($substr);
	var_dump(!ctype_alpha($substr));
	if (strlen($substr) < 5) exit;
	if (!ctype_alpha($substr)) {
		/*
		for ($j=0; $j<(int)$matches[2]; $j++) {
			$length += (int)$matches[1];
		}
		$i += strlen($matches[0]) + 2 + (int)$matches[1] - 1;
		*/
		$res = getStrLength($substr, $i, $length);
		$i = $res[0];
		$length = $res[1];
	} else {
		for ($j=0; $j<(int)$matches[2]; $j++) {
			$length += (int)$matches[1];
		}
		$i += strlen($matches[0]) + 2 + (int)$matches[1] - 1;
	}

	return [$i, $length];
}

echo "decompressed length is: $length\n";

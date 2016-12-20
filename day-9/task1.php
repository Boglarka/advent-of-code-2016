<?php

$file = 'day-9/input.txt';
if (file_exists($file)) {
	$input = file($file)[0];
}

$string = '';
$input = preg_replace('/\s/', '', $input);

for ($i=0; $i<strlen($input); $i++) {
	$char = $input[$i];
	if (ctype_alpha($char) && $char != 'x') {
		$string .= $char;
	} else {
		preg_match('/([0-9]+)x([0-9]+)/', substr($input, $i+1), $matches);
		for ($j=0; $j<(int)$matches[2]; $j++) {
			$string .= substr($input, $i+strlen($matches[0])+2, (int)$matches[1]);
		}
		$i += strlen($matches[0]) + 2 + (int)$matches[1] - 1;
	}
}

echo "decompressed length is: ".strlen($string)."\n";

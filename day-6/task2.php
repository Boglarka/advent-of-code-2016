<?php

$file = 'day-6/input.txt';
if (file_exists($file)) {
	$input = file($file);
}

$message = '';
foreach ($input as $line) {
	$colCount = strlen($line);
	for ($i=0; $i<strlen($line); $i++) {
		${'col'.$i}[$line[$i]] = (isset(${'col'.$i}[$line[$i]])) ? ${'col'.$i}[$line[$i]]+1 : 1;
	}
}
for ($i=0; $i<$colCount; $i++) {
	asort(${'col'.$i});
	$message .= array_keys(${'col'.$i})[0];
}

echo "message: $message\n";

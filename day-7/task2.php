<?php

$file = 'day-7/input.txt';
if (file_exists($file)) {
	$input = file($file);
}

$IPCount = 0;
$success = false;
foreach ($input as $line) {
	$splits = explode('[', $line);
	$splits = array_map('splitter', $splits);
	$outBrackets[] = $splits[0][0];
	for ($i=1; $i<=sizeof($splits); $i++) {
		if (isset($splits[$i][1]) && $splits[$i][1] != '') $outBrackets[] = $splits[$i][1];
		if (isset($splits[$i][0]) && $splits[$i][0] != '') $inBrackets[] = $splits[$i][0];
	}
	foreach ($outBrackets as $outStr) {
		$ABAs = hasABA($outStr);
		if (!empty($ABAs)) {
			foreach ($ABAs as $aba) {
				foreach ($inBrackets as $inStr) {
					if (hasBAB($inStr, $aba)) {
						$success = true;
						break;
					} else {
						$success = false;
					}
				}
				if ($success) break;
			}
			if ($success) break;
		}
	}
	if ($success) {
		$success = false;
		$IPCount++;
	}
	$inBrackets = [];
	$outBrackets = [];
}

function splitter($arr) {
	return explode(']', $arr);
}

function hasABA($str) {
	$str = trim($str);
	$foundABAs = [];
	for ($i=0; $i<strlen($str)-2; $i++) {
		if ($str[$i] == $str[$i+2] && $str[$i] != $str[$i+1]) {
			$foundABAs[] = $str[$i].$str[$i+1].$str[$i];
		}
	}
	return $foundABAs;
}

function hasBAB($str, $aba) {
	$str = trim($str);
	for ($i=0; $i<strlen($str)-2; $i++) {
		if ($str[$i] == $aba[1] && $str[$i+1] == $aba[0] && $str[$i+2] == $aba[1]) {
			return true;
		}
	}
	return false;
}

echo "count of IP's which support SSL: $IPCount\n";

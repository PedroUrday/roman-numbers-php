<?php

require 'roman_numbers.php';
$roman_numbers = file('test.txt');
$error = false;
foreach ($roman_numbers as $i => $line) {
	$decimal_number = $i + 1;
	$roman_number = trim($line);
	try {
		$val = decimal_to_roman_number($decimal_number);
		if ($val != $roman_number) {
			print "Error!! $val is not equal to $roman_number";
			$error = true;
		}
		$val = roman_to_decimal_number($roman_number);
		if ($val != $decimal_number) {
			print "Error!! $val is not equal to $decimal_number";
			$error = true;
		}
	} catch (Exception $e) {
		print 'Error!! ' . $e->getMessage();
		$error = true;
	}
}
if (!$error) {
	print 'Success!!';
}

<?php

define('ROMAN_NUMBER_UNITS', json_encode([
	['3000' => 'MMM', '2000' => 'MM', '1000' => 'M'],
	['900' => 'CM', '800' => 'DCCC', '700' => 'DCC', '600' => 'DC', '500' => 'D', '400' => 'CD', '300' => 'CCC', '200' => 'CC', '100' => 'C'],
	['90' => 'XC', '80' => 'LXXX', '70' => 'LXX', '60' => 'LX', '50' => 'L', '40' => 'XL', '30' => 'XXX', '20' => 'XX', '10' => 'X'],
	['9' => 'IX', '8' => 'VIII', '7' => 'VII', '6' => 'VI', '5' => 'V', '4' => 'IV', '3' => 'III', '2' => 'II', '1' => 'I']
]));

function decimal_to_roman_number($decimal_number) {
	if (!is_int($decimal_number) || $decimal_number <= 0 || $decimal_number >= 4000) {
		throw new Exception("Can't convert '$decimal_number' to a roman number.");
	}
	$units = json_decode(ROMAN_NUMBER_UNITS);
	$remainder = $decimal_number;
	$output = '';
	foreach ($units as $unit) {
		foreach ($unit as $decimal_unit => $roman_unit) {
			$decimal_unit_val = intval($decimal_unit);
			if ($remainder >= $decimal_unit_val) {
				$remainder -= $decimal_unit_val;
				$output .= $roman_unit;
				break;
			}
		}
	}
	return $output;
}

function roman_to_decimal_number($roman_number) {
	$units = json_decode(ROMAN_NUMBER_UNITS);
	$cursor = 0;
	$output = 0;
	foreach ($units as $unit) {
		foreach ($unit as $decimal_unit => $roman_unit) {
			if (strtoupper(substr($roman_number, $cursor, strlen($roman_unit))) == $roman_unit) {
				$cursor += strlen($roman_unit);
				$output += intval($decimal_unit);
				break;
			}
		}
	}
	if ($cursor == strlen($roman_number)) {
		return $output;
	}
	throw new Exception("Can't convert '$roman_number' to a decimal number.");
}

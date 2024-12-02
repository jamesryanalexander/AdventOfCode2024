<?php

$day1input = file("Day1AInput.txt");
$idsright = array();
$idsleft = array();
$difftotal = 0;
$addn = 0;

foreach ($day1input as $i => $line) {
	$line_array = explode("   ", $line);
	$idsleft[] = $line_array[0];
	$idsright[] = $line_array[1];

}
asort($idsright);
asort($idsleft);

$diffarray = array_map(function($a, $b) {
	return abs($b - $a);
}, $idsleft, $idsright);

$difftotal = array_sum($diffarray);
echo "The total difference number for Day 1 Part 1 is ".$difftotal.PHP_EOL;

$test1 = array(1,2,3,4);
$test2 = array(1,2,2,4);

// Custom funciton for Part 2 of Day 1 challenge (1B). I'm sure there is a built in function I couldn't remember or find but it is figuring out how many times a value X from array "a" exists in array "b" (including 0). Then it multiplies the value and quantity together and adds to day1B result variable which it returns. Some testing echos remain in comments :)
function Day1BCount($a, $b) {
	$result = 0;

	foreach ($a as $val) {
		$keys = array_keys($b, $val);
		$rightcount = count($keys);
		//echo $rightcount." values that equal ".$val.PHP_EOL;
		$result += $rightcount * $val;
		//echo "Current similarity number is ".$result.PHP_EOL;
	}

	return $result;
}

echo "The total similarity number for Day 1 Part 2 is ".Day1BCount($idsleft, $idsright);

?>
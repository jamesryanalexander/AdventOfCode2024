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
echo $difftotal;


//foreach($idsleft) {
//	$diff1 = abs($idsright[$addn]-$idsleft[$addn]);
//	$difftotal += $diff1;
//	echo $addn."  ".$difftotal.PHP_EOL;
//	$addn++;
//}
//echo "2"
//echo $difftotal;
//print_r($idsright);
//print_r($idsleft);
?>
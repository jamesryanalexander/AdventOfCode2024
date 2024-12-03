<?php

$day3input = file_get_contents("Day3Input.txt");
preg_match_all('/mul\(\d+,\d+\)/', $day3input, $allmatches);
$total = 0;
//match function returns the array within an array, back out of that
$allmatches = $allmatches[0];
//var_dump($allmatches);

foreach ($allmatches as $i => $match) {
	//var_dump($match);
	preg_match_all('/\d+/', $match, $productset);
	//match function returns the array within an array, back out of that
	$productset = $productset[0];
	//var_dump($productset);
	$product = ($productset[0] * $productset[1]);
	$total += $product;
}

echo "Total product is: ".$total.PHP_EOL;


?>
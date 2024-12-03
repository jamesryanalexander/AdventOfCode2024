<?php
//This is so hacky... I might try to clean it up later for funsies but it works!

// import days input (keep in same folder) into array
$day2input = file("Day2Input.txt");
//intiate some tracking variables, safereports is the final resault value for 2A, howmanyreports is a tracking for testing terminal purposes.
$safereports = 0;
$howmanyreports = 0;

// iterate over each line as it's own report
foreach ($day2input as $i => $report) {
	//add line to it's own array to iterate off
	$original_report_array = explode(" ", $report);
	//find last key for this report so that we know when to end and consider "safe"
	$lastkey_original = array_key_last($original_report_array);
	//increment the report tracker for testing and echo
	$howmanyreports++;


//making an array of arrays to test them all for part 2 (to see if they'd work with 1 error) this is silly, there has to be a better way but not today lol
		$numberofreports = 1 + $lastkey_original;
		$valuetodelete = 0;
		$array_of_report_arrays = array();
		$array_of_report_arrays[] = $original_report_array;
		while ($numberofreports > 0) {
			$new_report_array = $original_report_array;
			array_splice($new_report_array, $valuetodelete, 1);
			$array_of_report_arrays[] = $new_report_array;
			$numberofreports--;
			$valuetodelete++;
		}

	// now iterate over the silly array of report arrays
		foreach ($array_of_report_arrays as $ira => $report_array) {
			$lastkey = array_key_last($report_array);
			//keeping track of last report number as we go through the rules, each line should start at 0
			$lastreportnum = 0;
			// need to track if the line is going up or down
			$goingup = null;
			$goingdown = null;

			//iterate over rules for each report line
			foreach ($report_array as $ir => $reportnum) {

				//start off checking if this is the first report (nothing to compare to)
				if ($lastreportnum == 0) {
					//if so set to lastreport num and report out to terminal
					$lastreportnum = $reportnum;
					// otherwise check if it's less 
					continue;
				} elseif (($lastreportnum > $reportnum)) {
					// is goingdown already set as false (because of earlier iteration) if so changed direction, if not continue
					if (($goingdown !== false)) {
						$goingdown = true;
						$goingup = false;
							// check difference
							if ($lastreportnum - $reportnum <= 3) {
								// difference less than 3 so not going down too fast
								// check if this is the last key (and so known safe now)
									if ($ir == $lastkey) {
										$safereports++;
										break 2;
									}
								$lastreportnum = $reportnum;
								continue;
							} else {
								break;
							}
					} else {
						break;
					}	

				} elseif (($lastreportnum < $reportnum)) {
					// is goingup already set as false (because of earlier iteration) if so changed direction, if not continue
					if (($goingup !== false)) {
						$goingdown = false;
						$goingup = true;
						// check difference
							if ($reportnum - $lastreportnum <= 3) {
								// difference less than 3 so not going down too fast
									if ($ir == $lastkey) {
										$safereports++;
										break 2;
									}
								$lastreportnum = $reportnum;
								continue;
							} else {
								break;
							}
					} else {
						break;
					}
					
				} elseif (($lastreportnum !== 0) && ($lastreportnum == $reportnum)) {
					break;
				} else {
					echo "huh how did this get here? Check this ".PHP_EOL;
				}
			}


		}

	
}

echo "last report processed! Total number of safe reports: ".$safereports.PHP_EOL;

?>
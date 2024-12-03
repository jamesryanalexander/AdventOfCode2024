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
	$report_array = explode(" ", $report);
	//find last key for this report so that we know when to end and consider "safe"
	$lastkey = array_key_last($report_array);
	//increment the report tracker for testing and echo
	$howmanyreports++;
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
			if (($goingdown !== false)) {
				$goingdown = true;
				$goingup = false;
					if ($lastreportnum - $reportnum <= 3) {
						// difference less than 3 so not going down too fast
							if ($ir == $lastkey) {
								$safereports++;
								break;
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
			if (($goingup !== false)) {
				$goingdown = false;
				$goingup = true;
					if ($reportnum - $lastreportnum <= 3) {
						// difference less than 3 so not going down too fast
							if ($ir == $lastkey) {
								$safereports++;
								break;
							}
						$lastreportnum = $reportnum;
						continue;
					} else {
						break;
					}
			} else {
				break;
			}
			
		} elseif (($lastreportnum != 0) && ($lastreportnum == $reportnum)) {
			break;
		} else {
		}
	}

	
}

echo "last report processed! Total number of safe reports: ".$safereports.PHP_EOL

?>
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
	echo "starting report number ".$howmanyreports.PHP_EOL;
	//keeping track of last report number as we go through the rules, each line should start at 0
	$lastreportnum = 0;
	// need to track if the line is going up or down
	$goingup = null;
	$goingdown = null;
	//iterate over rules for each report line
	foreach ($report_array as $ir => $reportnum) {
		//start off checking if this is the first report (nothing to compare to)
		echo "Report number ".$howmanyreports." iteration number ".$ir." lastreportnum is ".$lastreportnum." and reportnum is ".$reportnum.PHP_EOL;
		if ($lastreportnum == 0) {
			echo "apparently lasreportnum equals 0".PHP_EOL;
			//if so set to lastreport num and report out to terminal
			$lastreportnum = $reportnum;
			echo "first report number of line is ".$lastreportnum.PHP_EOL;
			// otherwise check if it's less 
			continue;
		} elseif (($lastreportnum > $reportnum)) {
			if (($goingdown !== false)) {
				$goingdown = true;
				$goingup = false;
				echo $reportnum." is less than ".$lastreportnum.PHP_EOL;
					if ($lastreportnum - $reportnum <= 3) {
						// difference less than 3 so not going down too fast
						echo "it is also not going down too fast so continue".PHP_EOL;
							if ($ir == $lastkey) {
								$safereports++;
								echo "end of report and still safe! Safe reports now at ".$safereports.PHP_EOL;
								break;
							}
						$lastreportnum = $reportnum;
						continue;
					} else {
						echo "going down too fast so this report is not safe".PHP_EOL;
						break;
					}
			} else {
				echo "report change directions so this report is not safe ".PHP_EOL;
				break;
			}
			

		} elseif (($lastreportnum < $reportnum)) {
			if (($goingup !== false)) {
				$goingdown = false;
				$goingup = true;
				echo $reportnum." is more than ".$lastreportnum.PHP_EOL;
					if ($reportnum - $lastreportnum <= 3) {
						// difference less than 3 so not going down too fast
						echo "it is also not going up too fast so continue".PHP_EOL;
							if ($ir == $lastkey) {
								$safereports++;
								echo "end of report and still safe! Safe reports now at ".$safereports.PHP_EOL;
								break;
							}
						$lastreportnum = $reportnum;
						continue;
					} else {
						echo "going up too fast so this report is not safe".PHP_EOL;
						break;
					}
			} else {
				echo "report change directions so this report is not safe ".PHP_EOL;
				break;
			}
			
		} elseif (($lastreportnum != 0) && ($lastreportnum == $reportnum)) {
			echo "Report is equal to the last and so therefore not decreasing or increasing and unsafe".PHP_EOL;
			break;
		} else {
			echo "hmm not sure why we got here but assuming not safe and moving on, look into this!".PHP_EOL;
		}
	}

	
}

echo "last report processed! Total number of safe reports: ".$safereports.PHP_EOL."goingdown was ".$goingdown." going up was ".$goingup." lastreportnum was ".$lastreportnum." reportnum was ".$reportnum.PHP_EOL;

?>
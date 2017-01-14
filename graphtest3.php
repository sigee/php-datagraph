<?php

	// FIND PATH IN GRAPH (without the Graph class)
	// We can spare an abstraction layer this way
	
	// It is the same graph as in the graphtest2.php, but represented in an other way
	$graph = array(
		'GABOR' => array('ARMIN'),
		'BELA' => array('ARMIN'),
		'ARMIN' => array('BENCE'),
		'BENCE' => array('ANDRAS', 'BALAZS'),
		'ANDRAS' => array('TODOR'),
		'TODOR' => array('TIHAMER'),
		'TIHAMER' => array('BALAZS'),
		'BALAZS' => array('UBUL', 'KALMAN'),
		'KALMAN' => array('FERENC'),
		'FERENC' => array('GEZA'),
		'UBUL' => array('GYORGY', 'AGOSTON', 'ZOLTAN'),
		'GYORGY' => array('GEZA')
	);

	
	// FIND A PATH (FIRST FOUND, NOT THE SHORTEST ONE)
	function find_path($graph, $start, $end, $path=array()) {
		array_push($path, $start);
		if ($start == $end) {
			return $path;	
		} else {
			if (in_array($start, array_keys($graph)) && is_array($graph[$start])) {
				foreach($graph[$start] as $start) {
					$rpath = find_path($graph, $start, $end, $path);
					if (is_array($rpath)) {
						return $rpath;	
					}
				}
			}
		}
	}


	echo "<pre>"; var_dump(find_path($graph, 'GABOR', 'ZOLTAN')); echo "</pre>";
	echo "<hr />";

	echo "<pre>"; var_dump(find_path($graph, 'ARMIN', 'TIHAMER')); echo "</pre>";
	echo "<hr />";

	echo "<pre>"; var_dump(find_path($graph, 'ANDRAS', 'GEZA')); echo "</pre>";
	echo "<hr />";

	echo "<pre>"; var_dump(find_path($graph, 'FERENC', 'AGOSTON')); echo "</pre>";
	echo "<hr />";

	echo "<pre>"; var_dump(find_path($graph, 'BALAZS', 'BELA')); echo "</pre>";
	echo "<hr />";

	echo "<pre>"; var_dump(find_path($graph, 'BALAZS', 'UBUL')); echo "</pre>";
	echo "<hr />";

	echo "<pre>"; var_dump(find_path($graph, 'BELA', 'GEZA')); echo "</pre>";
	echo "<hr />";

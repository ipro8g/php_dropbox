<?php

$proc = [];

$raw_proc_data = [
	["t"=>2],
	["t"=>3],
	["t"=>4],
	["t"=>9],
	["t"=>7],
	["t"=>9]
];

$count = 0;

foreach($raw_proc_data as $p){

	$p["i"] = $count;
	$p["f"] = false;
	array_push($proc,$p);
	$count++;
}

$dependency_data = [
	["i"=>0,
	"d"=>4],
	["i"=>3,
	"d"=>0],
	["i"=>1,
	"d"=>2],
	["i"=>4,
	"d"=>5]
];

$indexes = [3,1,4];

foreach($indexes as $index){

$total = $proc[$index]["t"] + proc_time($index, $dependency_data, $proc);
echo "for process $index, total: $total time units<br>";

}

function proc_time($p, $dependency_data, $proc){

	$acum = 0;

	$count1 = 0;

	foreach($dependency_data as $d1){

		if($d1["i"] == $p){
		
			$acum += $proc[$d1["d"]]["t"];
			
			foreach($dependency_data as $d2){
			
				$more = false;
			
				if($d2["i"] == $d1["d"]){

						$more = true;
				}
				
				if($more){
				
					$acum += proc_time($d1["d"], $dependency_data, $proc);
				}
			}
		}
	}	

		return $acum;
}

?>
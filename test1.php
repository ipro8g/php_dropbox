<?php

$raw_cows_data = [
	["w"=>360,
	"p"=>40],
	["w"=>250,
	"p"=>35],
	["w"=>400,
	"p"=>43],
	["w"=>180,
	"p"=>28],
	["w"=>50,
	"p"=>12],
	["w"=>90,
	"p"=>13]
];

$cows = [];

$count = 0;

foreach($raw_cows_data as $c){

	$c["i"] = $count;
	array_push($cows,$c);
	$count++;
}

$trucks = [700,1000,2000];
$limit = 700;

$max = 0;
$winner_combination = [];

$sim_number = count($cows)*count($cows);

for($i = 0; $i <= $sim_number; $i++){

		$results = simulate($cows, $limit);

		$efficiency = 0;

		foreach($results as $r){

			$efficiency += $r["p"];
		}

		if($efficiency > $max){
		
			$max = $efficiency;
			$winner_combination = $results;
		}
}

echo "in a total of $sim_number simulations, the best combination for $limit Kg truck is: <br><br>";

foreach($winner_combination as $w){

	echo "cow index: ".($w["i"]+1)."\t,production: ".$w["p"]." lts\t,weight: ".$w["w"]." Kg<br>";	
}

function simulate($cows, $limit){

$results = [];

$acum = 0;
$used = [];
	
$flag_continue = true;
$flag_end = false;

$count = 0;

while(!$flag_end){
		
		$flag_continue = false;
		
		$option = rand(0,count($cows)-1);
	
		foreach($used as $u){
			
			if($option == $u){
				
				$flag_continue = true;
			}
		}
		
		$check_flag = false;
		
		foreach($cows as $c){
			
			$used_flag = false;
			
			foreach($used as $u){
				
				if($u == $c["i"]){
				
					$used_flag = true;
				}
			}
			
			if(($acum + $c["w"] <= $limit) && !$used_flag){
				
				$check_flag = true;
			}
		}
		
		if(!$check_flag){
			
			break;
		}
		
		if($flag_continue || (($acum + $cows[$option]["w"]) > $limit)){
			
			continue;
		}else if(($acum + $cows[$option]["w"]) == $limit){
			
			array_push($results,$cows[$option]);
			
			break;
			
			$flag_end = true;
		}
		
		array_push($used,$option);
		$acum += $cows[$option]["w"];
		array_push($results,$cows[$option]);
}



return $results;
}

?>

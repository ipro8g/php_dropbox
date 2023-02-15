<?php

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST');
  header("Access-Control-Allow-Headers: X-Requested-With");
  
  $file_ob = ["name"=>$_FILES["file"]["name"],
			  "type"=>$_FILES["file"]["type"],
			  "size"=>$_FILES["file"]["size"],
			  "author"=>$_POST["author"],
			  "comments"=>$_POST["comment"],
			  "content"=>base64_encode(file_get_contents($_FILES["file"]["tmp_name"]))
			];
			
  $files = json_decode(file_get_contents("the_json.txt"));
  
  $initial_size = count($files);
  
  array_push($files, $file_ob);
  
  file_put_contents("the_json.txt", json_encode($files), LOCK_EX);
  
  $final_size = count($files);
  
  
  if($final_size > $initial_size){
	 
		echo 1;
  }else{
	  
		echo 0;
  }
?>

<?php

header("Content-Type: application/json");

$req_ob = json_decode(stripslashes(file_get_contents("php://input")));

if($req_ob->method == "load_posts"){
			   
    echo json_encode(file_get_contents("the_json.txt"));
}

?>
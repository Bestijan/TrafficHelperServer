<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "get_my_places";

if (isset($_POST) && isset($_POST['username'])){

	$username = $_POST['username'];
	$waypoint = 'Waypoint';
	
	$sql_my_places = "select * from place_event where Username = '$username' AND Name <> '$waypoint'";
	
	$result_my_places = mysqli_query($con, $sql_my_places);

	if ($result_my_places){
		$json["result"] = "ok";
		
		$i = 0;
		$files = scandir('./../img/img_my_places/');
		unset($files[0]);
		unset($files[1]);
		
		while ($res = mysqli_fetch_assoc($result_my_places)){
			$json["my_places"][$i] = $res;
			$path = './../img/img_my_places/'.$username.'_'.$res["ID"].'.JPEG';
			$jpg = file_get_contents("$path");
			$json["my_places"][$i]["my_place_img"] = base64_encode($jpg);
			$i = $i + 1;
			
			if (($key = array_search($username.'_'.$res["ID"].'.JPEG', $files)) !== false) {
				unset($files[$key]);
			}
		}
		
		foreach($files as $file){
			$path = './../img/img_my_places/'.$file;
			unlink($path);
		}
		
		$json['files'] = $files;
	}
	else {
		$json["result"] = mysqli_error($con);
	}
}
else $json["result"] = "parameters_error";

echo json_encode($json);

?>
<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "get_my_places";
$json["result"] = "ok";

if (isset($_POST) && isset($_POST['username'])){

	$username = $_POST['username'];
	$waypoint = 'Waypoint';
	
	$sql_my_places = "select * from place_event where Username = '$username' AND Name <> '$waypoint'";
	
	$result_my_places = mysqli_query($con, $sql_my_places);

	if ($result_my_places){
		$i = 0;
		
		while ($res = mysqli_fetch_assoc($result_my_places)){
			$json["my_places"][$i] = $res;
			//$path = $relative_path.'img_my_places/'.$username.'_'.$res["ID"].'.jpg';
			//$jpg = file_get_contents("$path");
			
			$ID = $username.'_'.$res["ID"];
			$sql = "select img from place_event_img where ID = '".$ID."'";	
			$jpg = mysqli_query($con, $sql)->fetch_row()[0];	
			
			$json["my_places"][$i]["my_place_img"] = $jpg;
			$i = $i + 1;
		}
		
	
	}
	else {
		$json["result"] = mysqli_error($con);
	}
}
else $json["result"] = "parameters_error";

echo json_encode($json);

?>

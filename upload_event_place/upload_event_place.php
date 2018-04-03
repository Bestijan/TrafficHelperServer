<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["result"] = "ok";

if (isset($_POST) && isset($_POST['username'])
	&& isset($_POST['mi']) && isset($_POST['pe']) 
	&& isset($_POST['name']) && isset($_POST['lat']) 
	&& isset($_POST['lon']))
{
	$username = $_POST['username'];
	$pe = $_POST['pe'];
	$name = $_POST['name'];
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$mi = $_POST['mi'];
	
	if ($name == 'Waypoint')
		$json["id"] = "upload_waypoint";
	else $json["id"] = "upload_event_place";
	
	$sql = "insert into place_event (username, pe, mi, name, lat, lon) values ('".$username."', 
										      '".$pe."',
											  '".$mi."',			
											  '".$name."',																					  
											  '".$lat."', 
											  '".$lon."')";
	
	
	
	if(mysqli_query($con, $sql) && $json["id"] == 'upload_event_place'){
																					  
		$place_id = $con->insert_id;
		$json["ID"] = $con->insert_id;	
		
		if (isset($_POST['pic'])){	
			$ID = $username.'_'.$place_id;
			$sql = "insert into place_event_img (ID, img) values ('".$ID."', '".$_POST['pic']."')";
			if (!mysqli_query($con, $sql))
				$json["result"] = mysqli_error($con);
		}
	}
	mysqli_close($con);
}
else {
	$json["result"] = "parameters_error";
}
echo json_encode($json);

?>

<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();

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
	
	$relative_path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/';
	
	if ($name == 'Waypoint')
		$json["id"] = "upload_waypoint";
	else $json["id"] = "upload_event_place";
	
	$sql = "insert into place_event (username, pe, mi, name, lat, lon) values ('".$username."', 
										      '".$pe."',
											  '".$mi."',			
											  '".$name."',																					  
											  '".$lat."', 
											  '".$lon."')";
	mysqli_query($con, $sql);

	$json["ID"] = $con->insert_id;
	
	$sql = "select max(id) from place_event";
	
	$get_place_event = mysqli_query($con, $sql);
	
	$place_id = mysqli_fetch_row($get_place_event)[0];																					  
											
	if (isset($_POST['pic'])){
		$decoded = base64_decode($_POST['pic']);
		file_put_contents($relative_path.'img_my_places/'.$username.'_'.$place_id.'.jpg', $decoded);
	}
											
	$result = mysqli_query($con, $sql);
	
	if ($result){	
		$json["result"] = "ok";
		$sql = "SELECT AUTO_INCREMENT
						FROM  INFORMATION_SCHEMA.TABLES
						WHERE TABLE_SCHEMA = 'fcm_info'
						AND   TABLE_NAME = 'place_event'";
						
		//$json["ID"] = $conn->insert_id;
		
	}
	else {
		$json["result"] = mysqli_error($con);
	}
	mysqli_close($con);
}
else {
	$json["result"] = "parameters_error";
}
echo json_encode($json);

?>

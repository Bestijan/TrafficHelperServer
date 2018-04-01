<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "save_route";

$relative_path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/';

if (isset($_POST) && isset($_POST['username']) 
	&& isset($_POST['lat_s']) && isset($_POST['lon_s']) 
	&& isset($_POST['lat_d']) && isset($_POST['lon_d'])  
	&& isset($_POST['place_events']) && isset($_POST['pic']))
{
	$username = $_POST['username'];
	$lat_s = $_POST['lat_s'];
	$lon_s = $_POST['lon_s'];
	$lat_d = $_POST['lat_d'];
	$lon_d = $_POST['lon_d'];
	$markers_string = $_POST['place_events'];
	$img = $_POST['pic'];
	
	$sql = "insert into routes(username, lat_s, lon_s, lat_d, lon_d) " 
							  ."values('".$username."', '".$lat_s."', '".$lon_s."', '".$lat_d."', '".$lon_d."')";
	
	$insert_route = mysqli_query($con, $sql);
	
	$sql = "select max(id) from routes";
	
	$get_id_route = mysqli_query($con, $sql);
	
	$route_id = mysqli_fetch_row($get_id_route)[0];
	$points = array();
	$markers = array();
	
	if ($insert_route){	
		$json["result"] = "ok";
		$markers = json_decode($markers_string);
		for($i = 0; $i < sizeof($markers); $i = $i + 1){
			$sql = "insert into markers(id_route, id_place_event) " 
						      ."values(".$route_id.", ".$markers[$i]->{"id"}.")";
			mysqli_query($con, $sql);
		}
		$decoded = base64_decode($img);
		file_put_contents($relative_path.'img_routes/'.$username.'_'.$route_id.'.jpg', $decoded);
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

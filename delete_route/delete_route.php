<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "delete_route";
$json["result"] = "ok";

if (isset($_POST) && isset($_POST['id']) && isset($_POST['username']))
{
	$id = $_POST['id'];
	$username = $_POST['username'];
	
	$sql = "delete from routes where ID = $id";
	
	$result = mysqli_query($con, $sql);
	
	if ($result){	
		$sql = "select ID_place_event from markers where ID_route = $id";
		$result_markers = mysqli_query($con, $sql);
		$i = 0;
		if ($result_markers){
			
			while ($row = mysqli_fetch_row($result_markers)){
				$sql = "delete from place_event where ID = $row[0] AND Name = 'Waypoint'";	
				$result_delete_waypoint = mysqli_query($con, $sql);
			}
			
			$sql = "delete from markers where ID_route = $id";
			$result = mysqli_query($con, $sql);
			
			//$path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/img_routes/'.$username.'_'.$id.'.jpg';
			//unlink($path);
		
			if ($result){
				$ID = $username.'_'.$id;
				$sql = "delete from route_img where ID = '".$ID."'";	
				$result = mysqli_query($con, $sql);
				if (!$result)
					$json["result"] = mysqli_error($con);
			}
			else $json["result"] = mysqli_error($con);
		}
		else $json["result"] = mysqli_error($con);
	}
	else $json["result"] = mysqli_error($con);
	
	mysqli_close($con);
}
else {
	$json["result"] = "parameters_error";
}
echo json_encode($json);

?>

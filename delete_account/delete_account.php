<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "delete_account";
$json["result"] = "ok";

if (isset($_POST) && isset($_POST['username']))
{
	$username = $_POST['username'];
	$sql = "delete from users where username = '".$username."'";	
	$result = mysqli_query($con, $sql);

	if ($result){	
		$path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/img_users/'.$username.'.jpg';
		unlink($path);
		
		$sql = "select * from routes where Username = '$username'";
		$res_get_routes = mysqli_query($con, $sql);
	
		if ($res_get_routes){
			
			$sql = "select * from place_event where Username = '$username'";
			$res_get_place_event = mysqli_query($con, $sql);
			
			if ($res_get_place_event){
				while ($res_routes = mysqli_fetch_assoc($res_get_routes)){
					$path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/img_routes/'.$username.'_'.$res_routes["ID"].'.jpg';
					unlink($path);
			
					while ($res_place_event = mysqli_fetch_assoc($res_get_place_event)){
						if ($res_place_event["Name"] != 'Waypoint')
						{
							$path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/img_my_places/'.$username.'_'.$res_place_event["ID"].'.jpg';
							unlink($path);
						}
					
						$sql = "delete from markers where ID_route = '".$res_routes["ID"]."' AND ID_place_event = '".$res_place_event["ID"]."'";	
						$result = mysqli_query($con, $sql);
					}
				}
			
				$sql = "delete from routes where username = '".$username."'";	
				mysqli_query($con, $sql);
			
				$sql = "delete from place_event where username = '".$username."'";	
				$result = mysqli_query($con, $sql);
			}
			else $json["result"] = mysqli_error($con);
		}
		else $json["result"] = mysqli_error($con);
	}
	else{
		$json["result"] = mysqli_error($con);
	}

	mysqli_close($con);
}
else {
	$json["result"] = "parameters_error";
}
echo json_encode($json);

?>

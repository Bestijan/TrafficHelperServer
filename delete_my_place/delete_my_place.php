<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "delete_my_place";

if (isset($_POST) && isset($_POST['id']) && isset($_POST['username']))
{
	$id = $_POST['id'];
	$username = $_POST['username'];
	$sql = "delete from place_event where ID = $id";
	
	$result = mysqli_query($con, $sql);

	//$path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/img_my_places/'.$username.'_'.$id.'.jpg';
	//unlink($path);
	if ($result)
		$ID = $username.'_'.$id;
		$sql = "delete from place_event_img where ID = '".$ID."'";	
		$result = mysqli_query($con, $sql);

		if ($result){	
			$sql = "delete from markers where ID_place_event = $id";
			$result = mysqli_query($con, $sql);
			if($result)
				$json["result"] = "ok";
		}
		else{
			$json["result"] = mysqli_error($con);
		}
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

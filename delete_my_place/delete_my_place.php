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

	$path = './../img/img_my_places/'.$username.'_'.$id.'.JPEG';
	unlink($path);

	if ($result){	
		$sql = "delete from markers where ID_place_event = $id";
		$result = mysqli_query($con, $sql);
		if($result)
			$json["result"] = "ok";
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
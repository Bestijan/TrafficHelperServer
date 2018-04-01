<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "register";

$relative_path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/';

if (isset($_POST) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['pic']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$img = $_POST['pic'];

	$sql = "select count(*) as c from users where username = '$username'";
	
	$res = mysqli_query($con, $sql)->fetch_row()[0];	
	
	if ($res >= 1){
		$json["result"] = "already_exists";
	}
	else {
		$sql = "insert into users (username, password) values ('".$username."', '".$password."')";
	
		$result = mysqli_query($con, $sql);
	
		$decoded = base64_decode($img);
		file_put_contents($relative_path.'img_users/'.$username.'.jpg', $decoded);
		$json["result"] = "ok";
	}
	mysqli_close($con);
}
else {
	$json["result"] = "parameters_error";
}

echo json_encode($json);
?>

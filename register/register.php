<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "register";

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
		file_put_contents('./../img/img_users/'.$username.'.JPEG', $decoded);
		$json["result"] = "ok";
	}
	mysqli_close($con);
}
else {
	$json["result"] = "parameters_error";
}

echo json_encode($json);
?>
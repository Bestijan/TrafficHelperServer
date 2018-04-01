<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "sign_in";

if (isset($_POST) && isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "select count(*) as c from users where username = '$username' and password = '$password'";
	
	$result = mysqli_query($con, $sql)->fetch_row()[0];	
	
	$path = './../opt/app-root/src/img/img_users/'.$username.'.JPEG';
	
	if ($result == '1'){	
		$jpg  = file_get_contents("$path");
		$json["pic"] = base64_encode($jpg);
		$json["result"] = "ok";
	}
	else{
		$json["result"] = "does_not_exists";
	}
	mysqli_close($con);
}
else {
	$json["result"] = "parameters_error";
}

echo json_encode($json);

?>

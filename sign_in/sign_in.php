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
	
	$path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/img_users/'.$username.'.jpg';
	
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

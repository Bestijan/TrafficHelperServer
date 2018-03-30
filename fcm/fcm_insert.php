<?php

require_once dirname(__FILE__).'/../init.php';

if (isset($_POST) && isset($_POST['fcm_token']) && isset($_POST['fcm_token_id']))
{
	$fcm_token = $_POST['fcm_token'];
	$fcm_token_id = $_POST['fcm_token_id'];
	
	$sql = "insert into fcm_info (fcm_token_id, fcm_token) values ('".$fcm_token_id."', '".$fcm_token."')"
		   ."on duplicate key update fcm_token = values(fcm_token)";
			
	if (mysqli_query($con, $sql))
		echo "    Super     ";
	else echo mysqli_error($con);
	mysqli_close($con);
	//echo $fcm_token;
}
else echo "Error";
?>
<?php

require_once dirname(__FILE__).'/../init.php';

if (isset($_POST) && isset($_POST['username']))
{
	$res_new_username = true;
	$res_password = true;
	$username = $_POST['username'];
	
	$json = array();
	$json["id"] = "update_account";
	$json["result"] = "ok";
	
	if (isset($_POST['new_username'])){
		
		$json["id"] = "update_account";
		$json["result"] = "ok";
		
		$sql = "SELECT password FROM users WHERE username = '".$username."'";
		$result_password = mysqli_query($con, $sql);
		$json["username"] = $_POST['new_username'];
		
		if ($result_password)
		while ($res = mysqli_fetch_assoc($result_password)){
			
			$password = $res['password'];	
			$new_username = $_POST['new_username'];
			
			$sql = "DELETE from users WHERE username = '".$username."'";
			
			mysqli_query($con, $sql);
			
			$sql = "INSERT INTO users values('".$new_username."', '".$password."')";
		
			$res_new_username = mysqli_query($con, $sql);
			if ($res_new_username)
			{				
				$ID = $new_username;
				$ID_old = $username;
				$sql = "update user_img set ID = '".$ID."' where ID = '".$ID_old."'";
				if (!mysqli_query($con, $sql))
					$json["result"] = mysqli_error($con);
				
				$sql = "select * from place_event where Username = '$username'";
				$res_get_places = mysqli_query($con, $sql);
				
				if($res_get_places)
				while ($res_places = mysqli_fetch_assoc($res_get_places)){
					$ID = $new_username.'_'.$res_places["ID"];
					$ID_old = $username.'_'.$res_places["ID"];
					$sql = "update place_event_img set ID = '".$ID."' where ID = '".$ID_old."'";
					if (!mysqli_query($con, $sql))
						$json["result"] = mysqli_error($con);
				}
				else $json["result"] = mysqli_error($con);
				
				$sql = "select * from routes where Username = '$username'";
				$res_get_routes = mysqli_query($con, $sql);
				
				if ($res_get_routes)
				while ($res_routes = mysqli_fetch_assoc($res_get_routes)){
					$ID = $new_username.'_'.$res_routes["ID"];
					$ID_old = $username.'_'.$res_routes["ID"];
					$sql = "update route_img set ID = '".$ID."' where ID = '".$ID_old."'";
					if (!mysqli_query($con, $sql))
						$json["result"] = mysqli_error($con);
				}
				else $json["result"] = mysqli_error($con);
				
				$sql = "UPDATE place_event SET Username = '".$new_username."' WHERE username = '".$username."'";
				
				$res_place_event = mysqli_query($con, $sql);
				
				if ($res_place_event)
				{
					$sql = "UPDATE routes SET Username = '".$new_username."' WHERE username = '".$username."'";
					$res_routes = mysqli_query($con, $sql);
					if (!$res_routes){	
						$json["result"] = mysqli_error($con);
					}
				}
				else $json["result"] = mysqli_error($con);
			}
			else $json["result"] = mysqli_error($con);
		}
		else $json["result"] = mysqli_error($con);
	}
	
	if (isset($_POST['password']) && $res_new_username){
		
		$json["id"] = "update_account";
		$json["result"] = "ok";
		
		$password = $_POST['password'];
		$sql = "UPDATE users SET password = '".$password."' WHERE username = '".$username."'";
		$res_password = mysqli_query($con, $sql);
		if (!$res_password) {
			$json["result"] = mysqli_error($con);
		}
	}
	
	if (isset($_POST['pic']) && $res_password){
		
		$json["id"] = "update_account";
		$json["result"] = "ok";
		
		$img = $_POST['pic'];
		$decoded = base64_decode($img);
		
		$username_ = $_POST['username'];
	
		if (isset($_POST['new_username'])){
			$sql = "update user_img set ID = '".$_POST['new_username']."', img = ID = '".$_POST['pic']."' where ID = '".$_POST['username']."'";
			if (!mysqli_query($con, $sql))
				$json["result"] = mysqli_error($con);
		}
		else {
			$sql = "update user_img set img = '".$_POST['pic']."' where ID = '".$_POST['username']."'";
			if (!mysqli_query($con, $sql))
				$json["result"] = mysqli_error($con);
		}
	}
	
}
else $json["result"] = "parameters_error";

mysqli_close($con);
echo json_encode($json);

?>

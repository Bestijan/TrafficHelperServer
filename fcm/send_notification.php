<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "send_notification";

if (isset($_POST) && isset($_POST['id']) && isset($_POST['topic']) && isset($_POST['token']))
{
	$id = $_POST['id'];
	$token = $_POST['token'];
	$topic = $_POST['topic'];
	
	$sql = "SELECT * FROM place_event WHERE ID = ".$id;
	
	$result = mysqli_query($con, $sql);
	if ($result){
		
		$row = mysqli_fetch_assoc($result);
		
		$path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
		$server_key = 'AAAAwjr4XG0:APA91bFrdFw6tnqtPYwlEAnKa_fcBgwjwNKz7oUv2ZMAu8UjL4OI1UrK_Dd9eG5oeXoTQpiNnZ3KLMdgc9gexLMIQJlfK9PbfXhbCogcP_smj-vVnL3dBylJ9lO9mo4r6AAIqrwjID33';
		
		$headers = array(
						'Content-Type:application/json',
						'Authorization:key='.$server_key.''
					);

		$fields = array('to'=>'/topics/'.$topic,
						'data'=>array('token' => $token,
									  'id' => $id,
									  'username'=>$row['Username'],
									  'PE'=>$row['PE'],
									  'MI'=>$row['MI'],
									  'Name'=>$row['Name'],
									  'Date_time'=>$row['Date_time'],
									  'Lat' => $row['Lat'],
									  'Lon' => $row['Lon']));
									 				

		$payload = json_encode($fields); 

		$curl_session = curl_init();
		curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm); 
		curl_setopt($curl_session, CURLOPT_POST, true);
		curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

		if (curl_exec($curl_session)) {		
			curl_close($curl_session);
			mysqli_close($con);		
			$json["result"] = "ok";
			echo json_encode($json);
		}
		else {
			echo $json["result"] = "parameters_error";	
		}
	}
	else {
		echo $json["result"] = mysqli_error($con);
	}
}				
else {
	echo $json["result"] = "parameters_error";
}
?>
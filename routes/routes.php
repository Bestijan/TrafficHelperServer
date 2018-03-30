<?php

require_once dirname(__FILE__).'/../init.php';

$lat = $_POST['lat'];
$lon = $_POST['lon'];
$topic = $_POST['topic'];
$path_to_fcm = 'https://maps.googleapis.com/maps/api/directions/';
$server_key = 'AIzaSyD9va-Kxbj83p73_CQ0fRo8bRx8WvungVE';
$sql = 'select fcm_token from fcm_info';
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($result);
$key = $row[0];

$headers = array(
				'Content-Type:application/json',
				'Authorization:key='.$server_key.''
				);

$fields = array('to'=>'/topics/'.$topic,
				'data'=>array('lat'=>$lat,'lon'=>$lon));				


$payload = json_encode($fields); 

$curl_session = curl_init();
curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm); 
curl_setopt($curl_session, CURLOPT_POST, true);
curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

$result = curl_exec($curl_session);
				
curl_close($curl_session);
mysqli_close($con);	

echo "  PROSLO  ";
					
?>
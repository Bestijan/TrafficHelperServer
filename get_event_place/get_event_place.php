<?php

require_once dirname(__FILE__).'/../init.php';

$json = array();
$json["id"] = "get_event_place";

if (isset($_POST) && isset($_POST['names']) && $_POST['names'] == ""){
	$json['result'] = "ok";
}
else if (isset($_POST) && isset($_POST['lat']) && isset($_POST['lon']) && isset($_POST['distance']) && isset($_POST['names']))
{
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$distance = $_POST['distance'];
	$names = $_POST['names'];
	
	$sql = "SELECT ID, Username, PE, MI, Name, Date_time, Lat, Lon, "
			."ACOS(SIN(RADIANS(lat))*SIN(RADIANS(".$lat."))+COS(RADIANS(lat))"
			."*COS(RADIANS(".$lat."))*COS(RADIANS(lon)-RADIANS(".$lon.")))*6380 AS 'distance' "
			."FROM place_event "
			.$names
			."ORDER BY 'distance';";
	

	$points = array();
	$result = mysqli_query($con, $sql);
	
	if ($result){	
		$json["result"] = "ok";
		$i = 0;
		$j = 0;
		while ($row = mysqli_fetch_row($result)){
			if ($row[8] < $distance * 2){
				if ($row[3] == "MARK"){
					$json["MARK"][$i]["ID"] = $row[0];
					$json["MARK"][$i]["Username"] = $row[1];
					$json["MARK"][$i]["PE"] = $row[2];
					$json["MARK"][$i]["MI"] = $row[3];
					$json["MARK"][$i]["Name"] = $row[4];
					$json["MARK"][$i]["Date_time"] = $row[5];
					$json["MARK"][$i]["Lat"] = $row[6];
					$json["MARK"][$i]["Lon"] = $row[7];
					$i = $i + 1;
				}
				else if ($row[3] == "INCLUDE"){
					$json["INCLUDE"][$j]["ID"] = $row[0];
					$json["INCLUDE"][$j]["Username"] = $row[1];
					$json["INCLUDE"][$j]["PE"] = $row[2];
					$json["INCLUDE"][$j]["MI"] = $row[3];
					$json["INCLUDE"][$j]["Name"] = $row[4];
					$json["INCLUDE"][$j]["Date_time"] = $row[5];
					$json["INCLUDE"][$j]["Lat"] = $row[6];
					$json["INCLUDE"][$j]["Lon"] = $row[7];
					$j = $j + 1;
				}
			}
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
$json['names'] = $_POST['names'];
echo json_encode($json);
?>
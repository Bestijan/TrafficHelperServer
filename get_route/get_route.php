<?php

require_once dirname(__FILE__).'/../init.php';

if (isset($_POST) && isset($_POST['username']) && isset($_POST['place_events']) && isset($_POST['distance']))
{
	$username = $_POST['username'];
	$place_events = $_POST['place_events'];
	$distance = $_POST['distance'];
	
	$routes = array();
	$json["id"] = "get_route";
	
	$sql_routes = "select * from routes where username = '".$username."'";
	$result_routes = mysqli_query($con, $sql_routes);

	//$relative_path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/img/';
	
	if ($result_routes){
		$json["result"] = "ok";
		
		$i = 0;
		
		while ($row_route = mysqli_fetch_assoc($result_routes)){
			
			$json["routes"][$i] = $row_route;
			
			$route_id = $row_route['ID'];
			
			
			/// Selektuj sve tacke iz rute \\\
			$sql_points = "select * from points where id_route = ".$row_route["ID"]."";
			$result_points = mysqli_query($con, $sql_points);
			
			$j = 0;
			///// Tacke iz rute ubaci u json \\\\\
			/*
			while ($row_point = mysqli_fetch_assoc($result_points)){
				$json["routes"][$i]["points"][$j] = $row_point;
				$j = $j + 1;
			}
			*/
			/// Selektuj sve markere koji su deo rute \\\
    $sql_place_events = "SELECT place_event.* 
						 FROM place_event, routes, markers 
						 WHERE routes.ID = markers.ID_route 
						 AND place_event.ID = markers.ID_place_event AND routes.ID =".$row_route["ID"]."";

			$result_place_event = mysqli_query($con, $sql_place_events);
			
			$waypoints = "";
			
			$k = 0;
			while ($row_place_event = mysqli_fetch_assoc($result_place_event)){
				$json["routes"][$i]["waypoints"][$k] = $row_place_event;
				$waypoints .= " AND id <> ".$json["routes"][$i]["waypoints"][$k]["ID"]."";
				$k = $k + 1;
			}

			$markers = array();
				
			if ($place_events != "") {
				$sql_other_markers = "SELECT * FROM(SELECT ID, Username, PE, MI, Name, Date_time, Lat, Lon,  " 
					."ACOS(SIN(RADIANS(lat))*SIN(RADIANS(".$json["routes"][$i]['Lat_s']."))+COS(RADIANS(lat))*"
									."COS(RADIANS(".$json["routes"][$i]['Lat_s']."))*COS(RADIANS(lon)-"
									."RADIANS(".$json["routes"][$i]['Lon_s'].")))*6380 " 
									."AS distance FROM place_event "
									.$place_events
									." ORDER BY distance)" 
									."AS t " 
									."WHERE distance < ". 2 * $distance.""
									.$waypoints;			
			
				$result = mysqli_query($con, $sql_other_markers);
			
				$z = 0;
				if ($result){
					while ($row = mysqli_fetch_assoc($result)){
							$json["routes"][$i]["markers"][$z] = $row;
							$z = $z + 1;
					}
				}
				else {
					$json["routes"] = mysqli_error($con);
				}
			}
			//$path = $relative_path.'img_routes/'.$username.'_'.$route_id.'.jpg';
			//$jpg  = file_get_contents("$path");
			$ID = $username.'_'.$route_id;
		
			$sql = "select img from route_img where ID = '".$ID."'";	
			$jpg = mysqli_query($con, $sql)->fetch_row()[0];
			
			$json["routes"][$i]["route_img"] = $jpg;
			
			$i = $i + 1;
		}
		}
		 
	else {
		$json["result"] = mysqli_error($con);
	}
	
	mysqli_close($con);
	echo json_encode($json);
}
					
?>

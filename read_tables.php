<?php
	$host = getenv('MYSQL_SERVICE_HOST');
	$db_user = getenv('username');
	$db_password = getenv('password');
	$db_name = getenv('name');
	$con = mysqli_connect($host, $db_user, $db_password, $db_name);

	if ($con) {
		
		$sql = "select * from place_event";
		$result = mysqli_query($con, $sql);
	
		if ($result){	
		
			echo "place_event ";
			echo '<html>
					<br/>
				  </html>';
			
			echo 'ID' . " " . 'Username' . " " . 'PE' . " " . 'MI' . " " . 'Name' . " " . 'Date_time' . " " . 'Lat' . " " .'Lon';
		
			echo '<html>
					<br/>
				  </html>';
			
			while ($row = mysqli_fetch_row($result)){
				echo $row[0] . " " . $row[1] . " " . $row[2] . " " . $row[3] . " " . $row[4] . " " . $row[5] . " " . $row[6] . " " .$row[7];
			echo '<html>
					<br/>
				  </html>';
			}
			
			echo '<html>
					<br/>
				  </html>';
		}
		else { echo "Error reading table: " . $conn->error;
					echo '<html>
					<br/>
				  </html>';
		}
		
		$sql = "select * from routes";
		$result = mysqli_query($con, $sql);
	
		if ($result){	
		
			echo "routes";
			echo '<html>
					<br/>
				  </html>';
				  
			echo 'ID' . " " . 'Username' . " " . 'Lat_s' . " " . 'Lon_s' . " " . 'Lat_d' . " " . 'Lon_d';
			
			echo '<html>
					<br/>
				  </html>';		
			
			while ($row = mysqli_fetch_row($result)){
				echo $row[0] . " " . $row[1] . " " . $row[2] . " " . $row[3] . " " . $row[4] . " " . $row[5];
			echo '<html>
					<br/>
				  </html>';
			}
			
			echo '<html>
					<br/>
				  </html>';
		}
		else { echo "Error reading table: " . $conn->error;
					echo '<html>
					<br/>
				  </html>';
		}
		
		$sql = "select * from markers";
		$result = mysqli_query($con, $sql);
	
		if ($result){	
		
			echo "markers";
			echo '<html>
					<br/>
				  </html>';
			
			echo 'ID_route' . " " . 'ID_place_event';
		
			echo '<html>
					<br/>
				  </html>';

			while ($row = mysqli_fetch_row($result)){
				echo $row[0] . " " . $row[1];
			echo '<html>
					<br/>
				  </html>';
			}
			
			echo '<html>
					<br/>
				  </html>';
		}
		else { echo "Error reading table: " . $conn->error;
					echo '<html>
					<br/>
				  </html>';
		}

		$sql = "select * from users";
		$result = mysqli_query($con, $sql);
		
		if ($result){	
		
			echo "users";
			echo '<html>
					<br/>
				  </html>';
			
			echo 'User' . " " . 'Password';
			
			echo '<html>
					<br/>
				  </html>';
			
			while ($row = mysqli_fetch_row($result)){
				echo $row[0] . " " . $row[1];
			echo '<html>
					<br/>
				  </html>';
			}
			
			echo '<html>
					<br/>
				  </html>';
		}
		else { echo "Error reading table: " . $conn->error;
					echo '<html>
					<br/>
				  </html>';
		}
		
		$sql = "select * from user_img";
		$result = mysqli_query($con, $sql);
		//echo "RESULT" . "    " . $result;
		echo '<html>
			<br/>
		  </html>';
		if ($result != null){	
		
			echo "user_img ";
			echo '<html>
					<br/>
				  </html>';
			
			echo 'Username' . " " . 'user_img';
			
			echo '<html>
					<br/>
				  </html>';
			
			while ($row = mysqli_fetch_row($result)){
				echo $row[0] . " " . $row[1][0].$row[1][1].$row[1][2].$row[1][3].$row[1][4].$row[1][5].$row[1][6];
			
			echo '<html>
					<br/>
				  </html>';
			}
			
			echo '<html>
					<br/>
				  </html>';
		}
		else { 
			echo "Error reading table: " . $conn->error;
					echo '<html>
					<br/>
				  </html>';
		}		
		
		$sql = "select * from routes_img";
		$result = mysqli_query($con, $sql);
		
		if ($result){	
		
			echo "routes_img";
			echo '<html>
					<br/>
				  </html>';
			
			echo 'Username' . " " . 'routes_img';
			
			echo '<html>
					<br/>
				  </html>';
			
			while ($row = mysqli_fetch_row($result)){
				echo $row[0] . " " . $row[1][0].$row[1][1].$row[1][2].$row[1][3].$row[1][4].$row[1][5].$row[1][6];
			echo '<html>
					<br/>
				  </html>';
			}
			
			echo '<html>
					<br/>
				  </html>';
		}
		else { echo "Error reading table: " . $conn->error;
					echo '<html>
					<br/>
				  </html>';
		}		
		
		$sql = "select * from place_event_img";
		$result = mysqli_query($con, $sql);
		
		if ($result){	
		
			echo "place_event_img";
			echo '<html>
					<br/>
				  </html>';
			
			echo 'Username' . " " . 'place_event_img';
			
			echo '<html>
					<br/>
				  </html>';
			
			while ($row = mysqli_fetch_row($result)){
				echo $row[0] . " " . $row[1][0].$row[1][1].$row[1][2].$row[1][3].$row[1][4].$row[1][5].$row[1][6];
			echo '<html>
					<br/>
				  </html>';
			}
			
			echo '<html>
					<br/>
				  </html>';
		}
		else { echo "Error reading table: " . $conn->error;
					echo '<html>
					<br/>
				  </html>';
		}			
		
		
	} else {
		echo "Error connecting: " . $conn->error;
	}
	mysqli_close($con);
?>

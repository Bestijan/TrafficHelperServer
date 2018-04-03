<?php
	$host = getenv('MYSQL_SERVICE_HOST');
	$db_user = getenv('username');
	$db_password = getenv('password');
	$db_name = getenv('name');
	$con = mysqli_connect($host, $db_user, $db_password, $db_name);

	if ($result) {
		
		$sql = "select * from place_event";
		$result = mysqli_query($con, $sql);
	
		if ($result){	
		
			echo "place_event" . "\r\n";
			
			while ($row = mysqli_fetch_row($result)){
				echo row[0] . " " . row[1] . " " . row[2] . " " . row[3] . " " . row[4] . " " . row[5] . " " . row[6] . " " .row[7] . "\r\n";
			}
			
			echo "\r\n";
		}
		else echo "Error reading table: " . $conn->error . "\r\n" . "\r\n" . "\r\n";
		
		
		
	} else {
		echo "Error creating table: " . $conn->error;
	}
	mysqli_close($con);
?>
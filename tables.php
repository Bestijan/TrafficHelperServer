
<?php
	$host = getenv('MYSQL_SERVICE_HOST');
	$db_user = getenv('username');
	$db_password = getenv('password');
	$db_name = getenv('name');
	$con = mysqli_connect($host, $db_user, $db_password, $db_name);

	if ($con) {
		
		$sql = "SELECT TABLE_NAME 
			FROM INFORMATION_SCHEMA.TABLES
			WHERE TABLE_TYPE = 'BASE TABLE' 
			AND TABLE_SCHEMA='sampledb'";

		$result = mysqli_query($con, $sql);
		//echo $result;
		
		if ($result){
			while ($row = mysqli_fetch_row($result)){
				foreach ($row as $row_){
					echo $row_ . " ";
					echo '<html>
						<br/>
					  </html>';
				}
			}
		}
 	}
	else echo "Error connecting: " . $conn->error;
	
	mysqli_close($con);
?>

<?php
	$host = getenv('MYSQL_SERVICE_HOST');
	$db_user = getenv('username');
	$db_password = getenv('password');
	$db_name = getenv('name');
	$con = mysqli_connect($host, $db_user, $db_password, $db_name);

	if ($con) {
		
		$sql = "delete from users";
		$result = mysqli_query($con, $sql);

		if ($result){			
			echo "Delete users succesfully";
			echo '<html>
					<br/>
				  </html>';
		} else {
			echo "Error deleting place_event: " . $conn->error;
			echo '<html>
					<br/>
				  </html>';
		}
		
		$sql = "delete from place_event";
		$result = mysqli_query($con, $sql);

		if ($result){			
			echo "Delete place_event succesfully";
			echo '<html>
					<br/>
				  </html>';
		} else {
			echo "Error deleting place_event: " . $conn->error;
			echo '<html>
					<br/>
				  </html>';
		}

		$sql = "delete from routes";
		$result = mysqli_query($con, $sql);

		if ($result){			
			echo "Delete routes succesfully";
			echo '<html>
					<br/>
				  </html>';
		} else {
			echo "Error deleting place_event: " . $conn->error;
			echo '<html>
					<br/>
				  </html>';
		}
		
		$sql = "delete from markers";
		$result = mysqli_query($con, $sql);

		if ($result){			
			echo "Delete markers succesfully";
			echo '<html>
					<br/>
				  </html>';
		} else {
			echo "Error deleting place_event: " . $conn->error;
			echo '<html>
					<br/>
				  </html>';
		}
		
		$sql = "delete from users_img";
		$result = mysqli_query($con, $sql);

		if ($result){			
			echo "Delete user_img succesfully";
			echo '<html>
					<br/>
				  </html>';
		} else {
			echo "Error deleting users_img: " . $conn->error;
			echo '<html>
					<br/>
				  </html>';
		}
		
		$sql = "delete from routes_img";
		$result = mysqli_query($con, $sql);

		if ($result){			
			echo "Delete routes_img succesfully";
			echo '<html>
					<br/>
				  </html>';
		} else {
			echo "Error deleting routes_img: " . $conn->error;
			echo '<html>
					<br/>
				  </html>';
		}

		$sql = "delete from place_event_img";
		$result = mysqli_query($con, $sql);

		if ($result){			
			echo "Delete place_event_img succesfully";
			echo '<html>
					<br/>
				  </html>';
		} else {
			echo "Error deleting place_event_img: " . $conn->error;
			echo '<html>
					<br/>
				  </html>';
		}		
	}
	else mysqli_close($con);
?>
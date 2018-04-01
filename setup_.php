<?php
$host = getenv('MYSQL_SERVICE_HOST');
$db_user = getenv('username');
$db_password = getenv('password');
$db_name = getenv('name');

$con = mysqli_connect($host, $db_user, $db_password, $db_name);
if ($con){
	/*
	$sql = "CREATE TABLE place_event (
            ID int(11) PRIMARY KEY AUTO_INCREMENT, 
            Username VARCHAR(50) NOT NULL,
	    PE VARCHAR(5),
	    MI VARCHAR(7),
	    Name VARCHAR(100),
	    Date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
	    Lat double,
	    Lon double
            )";
	*/
	/*
	$sql = "CREATE TABLE routes (
            ID int(11) PRIMARY KEY AUTO_INCREMENT, 
            Username VARCHAR(50) NOT NULL,
	    Lat_s double,
	    Lon_s double,
	    Lat_d double,
	    Lon_d double
            )";
	*/
	
	$sql = "CREATE TABLE markers (
            ID_route int(11), 
            ID_place_event int(11),
	    PRIMARY KEY (ID_route, ID_place_event)
            )";
	
	
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "Table markers created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($con);
        }
}
else echo "PRC";


mysqli_close($con);
?>

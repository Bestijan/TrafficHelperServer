<?php
$host = getenv('MYSQL_SERVICE_HOST');
$db_user = getenv('username');
$db_password = getenv('password');
$db_name = getenv('name');

$con = mysqli_connect($host, $db_user, $db_password, $db_name);
if ($con){
	$sql = "CREATE TABLE place_event (
            ID int(11) PRIMARY KEY AUTO_INCREMENT, 
            Username VARCHAR(50) NOT NULL,
	    PE VARCHAR(5),
	    MI VARCHAR(7),
	    Name VARCHAR(100),
	    Date_time timestamp NOW(),
	    Lat double,
	    Lon double
            )";

        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($con);
        }
}
else echo "PRC";


mysqli_close($con);
?>

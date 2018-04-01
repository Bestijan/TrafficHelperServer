<?php
$host = getenv('MYSQL_SERVICE_HOST');
$db_user = getenv('username');
$db_password = getenv('password');
$db_name = getenv('name');

$con = mysqli_connect($host, $db_user, $db_password, $db_name);
if ($con){
	$sql = "CREATE TABLE users (
            username VARCHAR(50) PRIMARY KEY, 
            password VARCHAR(30) NOT NULL
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

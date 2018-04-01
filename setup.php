<?php


$host = getenv('MYSQL_SERVICE_HOST');
$db_user = getenv('username');
$db_password = getenv('password');
$db_name = getenv('name');
$con = mysqli_connect($host, $db_user, $db_password, $db_name);

//$sql = "insert into users (username, password) values ('Laza', 'lazalaza')";

$sql = "DELETE FROM place_event"; 

$result = mysqli_query($con, $sql);

if ($result) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . mysqli_error($con);
}

mysqli_close($con);

?>

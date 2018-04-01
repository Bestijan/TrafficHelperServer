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
	
	/*
	$sql = "CREATE TABLE markers (
            ID_route int(11), 
            ID_place_event int(11),
	    PRIMARY KEY (ID_route, ID_place_event)
            )";
	*/
	
	//$sql = "SET LOCAL event_scheduler = ON";

	//$sql = "GRANT ALL PRIVILEGES ON mydb.$db_name TO '$db_user'@'$host' IDENTIFIED BY '$db_password'";
	
	/*
	$sql = "DROP EVENT `delete_event`"; 
	$result = mysqli_query($con, $sql);
	
	if ($result) {
            echo "DROPED succesfully";
        } else {
            echo "Error : " . mysqli_error($con);
        }
	
	$sql = "CREATE EVENT `delete_event` 
		ON SCHEDULE EVERY 1 MINUTE 
		STARTS '2018-03-30 00:00:00' 
		ENDS '2028-11-22 00:00:00' 

		ON COMPLETION NOT PRESERVE ENABLE DO 
		DELETE from place_event WHERE PE = 'EVENT'";
	
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "Event set successfully";
        } else {
            echo "Error : " . mysqli_error($con);
        }
	*/
	/*
	$img = "/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsK
		CwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQU
		FBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAPSAlgDASIA
		AhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQA
		AAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3
		ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWm
		p6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEA
		AwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSEx
		BhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElK
		U1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3
		uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9G6KK
		K1PKCiiigAooooAKTsaWk7GgBAfpS5+lJj3FGPcUX8hW8hc/SjP0pMe4ox7ii/kFvIXP0oz9KTHu
		KMe4ov5BbyFz9KM/Skx7ijHuKL+QW8hc/SjP0pMe4ox7ii/kFvIXP0oz9KTHuKMe4ov5BbyFz9KM
		/Skx";
	
	$decoded = base64_decode($img);
	
	$path = 'http://traffic-helper-traffic-helper-server.7e14.starter-us-west-2.openshiftapps.com/opt/app-root/data/';
	
	file_put_contents($path.'1.jpg', $decoded);
	*/
	
	$sql = "SELECT COUNT(*) FROM users"; 
	$result = mysqli_query($con, $sql)->fetch_row()[0];	
        if ($result) {
            echo $result;
        } else {
            echo "Error : " . mysqli_error($con);
        }
	
	
	$sql = "DELETE FROM users"; 
	$result = mysqli_query($con, $sql);
        if ($result) {
            echo "\nDELETE successfully\n";
        } else {
            echo "Error : " . mysqli_error($con);
        }
	
	$sql = "SELECT COUNT(*) FROM users"; 
	$result = mysqli_query($con, $sql)->fetch_row()[0];
        if ($result) {
            echo $result;
        } else {
            echo $result " : " . mysqli_error($con);
        }
	
	$sql = "DROP TABLE user_img"; 
	$result = mysqli_query($con, $sql);
        if ($result) {
            echo "\nDROP successfully";
        } else {
            echo "Error : " . mysqli_error($con);
        }
	
	$sql = "CREATE TABLE user_img (
            ID VARCHAR(50) PRIMARY KEY, 
            img MEDIUMBLOB
            )";

	$result = mysqli_query($con, $sql);
        if ($result) {
            echo "\nCREATE successfully";
        } else {
            echo "Error : " . mysqli_error($con);
        }
	
	
	/*
	$sql = "DELETE FROM users";
	$result = mysqli_query($con, $sql);
        if ($result) {
            echo "Event set successfully";
        } else {
            echo "Error : " . mysqli_error($con);
        }
	*/
	
}
else echo "Connection failed";


mysqli_close($con);
?>

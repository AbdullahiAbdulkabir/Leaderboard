<?php
$hostname = 'us-cdbr-east-02.cleardb.com';
$username = 'b54ae81fb3204a';
$password = '13c1b720';
$db_name = 'heroku_aeb9761bff98a50';

$conn = mysqli_connect($hostname,$username,$password,$db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

?>

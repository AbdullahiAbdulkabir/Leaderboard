<?php
$hostname = 'd';
$username = 'a';
$password = 'b';
$db_name = 'a';

$conn = mysqli_connect($hostname,$username,$password,$db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

?>

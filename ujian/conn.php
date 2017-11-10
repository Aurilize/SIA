<?php 
	$username="root";
	$password="";
	$dbname="coba";
	$host="localhost";

	$con = mysql_connect("$host", "$username", "$password");
	mysql_select_db($dbname, $con) or die("Error");

?>
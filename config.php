<?php
	$host="localhost";
	$user="root";
	$password="";	
	$koneksi=mysql_connect($host,$user,$password) or 
	die("Gagal koneksi");
	mysql_select_db("smk");
?>
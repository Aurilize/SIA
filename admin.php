<?php
// memulai session
session_start();
error_reporting(0);
if (isset($_SESSION['level']))
{
	// jika level admin
	if ($_SESSION['level'] == "admin")
   {   
   	header('location:admin/t-guru');
   }
   // jika kondisi level user maka akan diarahkan ke halaman lain
   else if ($_SESSION['level'] == "guru")
   {
       header('location:guru/peng');
   }
   else 
   {
       header('location:siswa/t-siswa.php');
   }
}
if (!isset($_SESSION['level']))
{
	header('location:index.php?error');
}

 ?>
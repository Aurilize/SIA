<?php 
include 'koneksi.php';
$username = $_POST["username"];
$passlama = $_POST['passlama'];
$passbaru = $_POST['passbaru'];
$konfirmasipassbaru = $_POST['konfirmasipassbaru'];
$cekuser = "select * from user where username = '$username' and password = '$passlama'";
$querycekuser = mysql_query($cekuser);
$count = mysql_num_rows($querycekuser);
if ($count >= 1){
	$updatepassword = "update user set password = '$passbaru' where username = '$username'";
	$updatequery = mysql_query($updatepassword);
	if($updatequery){
		header('location:pass.php?done');
	}
}
else {
    header('location:pass.php?err');
}
?>
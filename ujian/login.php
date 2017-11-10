
<?php 
session_start();
include('conn.php');

$user = $_POST['user'];
$password = $_POST['password'];

$query = mysql_query("SELECT * FROM test WHERE user='$user' and password='$password'");
$sql = mysql_num_rows($query);
if ($sql == TRUE)
{
	$_SESSION['user']=$user;
	header('Location:home.php');
}else{
	echo "GAGAL LOG IN";
}

?>
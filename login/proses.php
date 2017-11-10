<?php
include "koneksi.php";

function antimaling($string) {
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = htmlspecialchars($string);
    return $string;
}

//fungsi proses login:::
#jika ditekan tombol login
session_start();
$username = antimaling($_POST['username']);
$password = md5(antimaling($_POST['password']));
if(isset($_POST['login'])){
$stmt=$coba->prepare("select * from user where username=:username and password=:password");
$stmt->bindParam(':username', $username);//ngecek username
$stmt->bindParam(':password', $password);//ngecek password
$stmt->execute();//ngeksesuksi 
$verify = $stmt->rowCount();//ini ibaratnya mysql_numrows gan ngitung rows
if($verify== 1){//jika berhasil akan bernilai 1 baru masuk jika 0 gagal
$verify=$stmt->fetch();
$_SESSION['username'] = $verify['username'];
$_SESSION['password'] = $verify['password']; 
$_SESSION['level'] = $verify['level'];

 if($verify['level']=="admin"){
header("location:admin/index.php");
}else if($verify['level']=="guru"){
header("location:guru/index.php");
}else if($verify['level']=="siswa"){
header("location:siswa/index.php");
}else{
echo
header("location:login.php?status=1");
		exit();
} }else{
header("location:login.php?status=2");
		exit();
}




}else if($op=="out"){
unset($_SESSION['username']);
unset($_SESSION['level']);
header("location:login.php");
}
?>


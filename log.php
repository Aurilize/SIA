<?php
session_start();
mysql_connect("localhost","root","") or die("Nggak bisa koneksi");

mysql_select_db ("smkfix"); //sesuaikan dengan nama database anda
$username = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];
if($op=="in"){
    $cek = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$password'");
    if(mysql_num_rows($cek)==1){ //jika berhasil akan bernilai 1
        $c = mysql_fetch_array($cek);
        $_SESSION['username'] = $c['username'];
        $_SESSION['level'] = $c['level'];
        if($c['level']=="admin" && "Admin"){
            header("location:admin/t-guru");
        }else if($c['level']=="guru" && "Guru"){
            header("location:guru/t");
        }else if($c['level']=="siswa" && "Siswa"){
            header('location:siswa/t-siswa.php');
        }else{ 
            header('location:index.php?error=4');
        } 
    }
    else if ($op=="out"){
        unset($_SESSION['username']);
        unset($_SESSION['level']);
        header("location:index.php");
    }
}

?>

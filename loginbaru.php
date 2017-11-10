<?php
session_start();
mysql_connect("localhost","root","") or die("Nggak bisa koneksi");

mysql_select_db ("smk"); //sesuaikan dengan nama database anda
$username = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];
if($op=="in"){
    $cek = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$password'");
    if(mysql_num_rows($cek)==1){ //jika berhasil akan bernilai 1
        $c = mysql_fetch_array($cek);
        $_SESSION['username'] = $c['username'];
        $_SESSION['level'] = $c['level'];
        if ($_SESSION['level'] == "Admin"){
            header('location:admin/home');
        }else if ($_SESSION['level'] == "Guru"){
                    header('location:guru/home');
        }else{
            header('location:siswa/home');
        }
    }else{
        header('location:index?error=4');
    }
}else if ($op=="out"){
        unset($_SESSION['username']);
        unset($_SESSION['level']);
        header("location:index");
    }

?>

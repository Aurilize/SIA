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
        if ($_SESSION['level'] == "admin"){
            header('location:admin/t-guru');
        }else if ($_SESSION['level'] == "guru"){
            $query = mysql_query("SELECT * FROM guru where nip = '$username'");
            if(mysql_num_rows($query)==1){
                $row = mysql_fetch_array($query);
                $id_guru=$row['id_guru'];
                if($query){
                    $_SESSION['id_guru']=$id_guru;
                    $_SESSION['nip']=$nip;
                    $_SESSION['nama_guru']=$nama_guru;
                    $_SESSION['waktu']=date("Y-m-d H:i:s");
                    header('location:guru/nilai');
                }else{
                    header('location:index');
                }
            }
    }else {
            header('location:siswa/t-siswa.php');
        }
    }else{
        header('location:index.php?error=4');
    }
}else if ($op=="out"){
        unset($_SESSION['username']);
        unset($_SESSION['level']);
        header("location:index.php");
    }

?>

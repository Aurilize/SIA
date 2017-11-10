<?php
//lanjutkan session yang sudah dibuat sebelumnya
session_start();
 
unset($_SESSION['username']);
unset($_SESSION['level']);
 
//redirect ke halaman login
header('location:index');
?>
<!--VerlyRedirect Session-->
<?php

@session_start();
if ($_SESSION['level']=='admin') {
if ((!$_SESSION['username']) AND (!$_SESSION['password']))
{
session_destroy(); 
header("location:login.php");
}elseif (($_SESSION['username']) AND ($_SESSION['password'])) {
	header("location:admin/index.php");
}}

if ($_SESSION['level']=='guru') {
if ((!$_SESSION['username']) AND (!$_SESSION['password']))
{
session_destroy(); 
header("location:login.php");
}elseif (($_SESSION['username']) AND ($_SESSION['password'])) {
	header("location:guru/index.php");
}}

if ($_SESSION['level']=='siswa') {
if ((!$_SESSION['username']) AND (!$_SESSION['password']))
{
session_destroy(); 
header("location:login.php");
}elseif (($_SESSION['username']) AND ($_SESSION['password'])) {
	header("location:siswa/index.php");
}}

?>
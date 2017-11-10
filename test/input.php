<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST">
	ID makul: <input type="text" name="id_makul"><br>
	Nama Makul: <input type="text" name="nama_makul"><br>
	SKS: <input type="text" name="sks"><br>
	Dosen: <input type="text" name="dosen"><br>
	Semester: <input type="text" name="semester"><br>
	<input type="submit" name="input" value="Tambah Data">
</form>

<?php 
require 'class.php';
if (isset($_POST['input'])){
	$id_makul = $_POST['id_makul'];
	$nama_makul = $_POST['nama_makul'];
	$sks = $_POST['sks'];
	$dosen = $_POST['dosen'];
	$semester = $_POST['semester'];

	$Coba = new Coba();
	$tambah = $Coba->input($id_makul, $nama_makul, $sks, $dosen, $semester);
	if($tambah=='DONE'){
		header('Location:list.php');
	}
}
?>

</body>
</html>
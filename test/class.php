<?php

class Coba
{
	
	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost; dbname=coba','root','');
	}

	public function input($id_makul, $nama_makul, $sks, $dosen, $semester){
		$sql = "INSERT INTO makul (id_makul, nama_makul, sks, dosen, semester) VALUES ('$id_makul','$nama_makul','$sks','$dosen','$semester')";
		$query = $this->db->query($sql);
		if(!$query){
			echo "GAGAL";
		}else {
			echo "DONE";
		}
	}
}
?>
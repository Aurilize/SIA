<?php

/**
* Class Coba
*/
class Coba
{
	
	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost; dbname=coba', 'root', '');
	}

	public function input($user, $password)
	{
		$sql = "INSERT INTO test (user, password) VALUES ('$user','$password')";
		$query = $this->db->query($sql);

		if (!$query)
		{
			return "GAGAL INPUT";
		}else {
			return "BERHASIL";
		}
	}

	public function selectUpdate($user)
	{
		$sql = "SELECT * FROM test WHERE user='$user'";
		$query = $this->db->query($sql);
		return $query;
	}

	public function updateUser($user, $password)
	{
		$sql = "UPDATE test SET password='$password' WHERE user='$user'";
		$query = $this->db->query($sql);

		if (!$query)
		{
			return "GAGAL UPDATE";
		}else{
			return "BERHASIL";
		}
	}

	public function read()
	{
		$sql = "SELECT * FROM test";
		$query = $this->db->query($sql);
		return $query;
	}

	public  function hapus($user)
	{
		$sql = "DELETE FROM test WHERE user='$user'";
		$query = $this->db->query($sql);
	}
}

?>
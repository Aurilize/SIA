<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		require 'class.try.php';
		if (isset($_GET['user']))
		{
			$Coba = new Coba();
			$select = $Coba->selectUpdate($_GET['user']);
			$edit = $select->fetch(PDO::FETCH_LAZY);
			echo '<form method="POST">
				Username: <input type="text" name="user" value="'.$edit->user.'" readonly>
				Password: <input type="text" name="password" value="'.$edit->password.'">
				<input type="submit" name="update" value="Ubah Data">
			</form>';
		}

		if (isset($_POST['update']))
		{
			$user = $_POST['user'];
			$password = $_POST['password'];

			$Coba = new Coba();
			$ubah = $Coba->updateUser($user, $password);
			if($ubah == "BERHASIL")
			{
				header('Location:list.php');
			}
		}
	?>
</body>
</html>
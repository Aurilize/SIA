<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		Username: <input type="text" name="user"><br>
		Password: <input type="text" name="password"><br>
		<input type="submit" name="input" value="Tambah">
	</form>

	<?php
		require 'class.try.php';
		if (isset($_POST['input']))
		{
			$user = $_POST['user'];
			$password = $_POST['password'];

			$Coba = new Coba();
			$add = $Coba->input($user, $password);
			if($add == "BERHASIL")
			{
				header ('Location:list.php');
			}
		}
	?>
</body>
</html>
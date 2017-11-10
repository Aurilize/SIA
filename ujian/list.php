<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<a href="input.php">Tambah Data</a><br><br>

	<table border="1">
		<thead>Username</thead>
		<thead>Password</thead>
	</table>

	<?php 
		require 'class.try.php';

		$Coba = new Coba();
		$lihat = $Coba->read();
		while ($data = $lihat->fetch(PDO::FETCH_LAZY)) 
		{
	?>
	<tr>
		<td><?php print($data->user) ?></td>
		<td><?php print($data->password) ?></td>
		<td><a href="update.php?no=<?php print($data->user) ?>">Edit</a></td>
		<td><a href="list.php?delete=<?php print($data->user) ?>">Hapus</a></td>
		<br>
	</tr>

	<?php
		};
	?>
</body>
</html>

<?php 
	if (isset($_GET['delete'])) 
	{
		$hapus = $Coba->hapus($_GET['delete']);
	}
?>
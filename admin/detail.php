<?php 
mysql_connect("localhost", "root", "");
mysql_select_db("smk");
if (isset($_GET['nis']))
{
	$id_kelassiswa=$_GET['nis'];
	$sql = mysql_query("SELECT * FROM pengetahuan, mengajar WHERE pengetahuan.id_kelassiswa='$id_kelassiswa' AND mengajar.id_semester='1' AND pengetahuan.id_mengajar=mengajar.id_mengajar");
	$sql2 = mysql_query("SELECT * FROM pengetahuan, mengajar WHERE pengetahuan.id_kelassiswa='$id_kelassiswa' AND mengajar.id_semester='2' AND pengetahuan.id_mengajar=mengajar.id_mengajar");
	while ($data=mysql_fetch_array($sql)) 
	{
		?>
		<tr>
			<td><?php echo $data['uh']; ?></td><br>
		</tr>
		<?php
	}
	?>
	<br>
	<br>
	<br>
	<?php
		while ($data1=mysql_fetch_array($sql2)) 
	{
		?>
		<tr>
			<td><?php echo $data1['uh']; ?></td><br>
		</tr>
		<?php
	}
	?>
<?php	
}
?>
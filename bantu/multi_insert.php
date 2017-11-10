<?php
include "guru/koneksi.php";

for($i=0;$i<$_POST['jumlah'];$i++){
 $nis = $_POST['nis'.$i];
 $nama= $_POST['nama'.$i];
 $query = "insert into SISWA(NIS,NAMA)values('$nis','$nama')";
 $mysqli->query($query);
}
$mysqli->close();
?>
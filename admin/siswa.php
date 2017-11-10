<?php
mysql_connect("localhost","root","");
mysql_select_db("smk");
$kec = mysql_query("SELECT nis, nama_siswa FROM siswa");
echo "<option></option>";
while($k = mysql_fetch_array($kec)){
    echo "<option value=\"".$k['nis']."\">".$k['nama_siswa']." - ".$k['nis']."</option>\n";
}
?>
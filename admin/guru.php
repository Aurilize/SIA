<?php
mysql_connect("localhost","root","");
mysql_select_db("smk");
$kec = mysql_query("SELECT * FROM guru");
echo "<option></option>";
while($k = mysql_fetch_array($kec)){
    echo "<option value=\"".$k['nip']."\">".$k['nama']." - ".$k['nip']."</option>\n";
}
?>
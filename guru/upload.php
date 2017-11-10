<?php
$host='localhost'; //server
$username='root'; //id
$password=''; //password
$database='smkfix'; //Database anda
mysql_connect($host,$username,$password);
mysql_select_db($database);
if (isset($_POST['submit'])) {
//Script Upload File..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
    //Import uploaded file to Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="INSERT INTO kepribadian 
        (id_kepribadian, id_kelassiswa, kelakuan, kerapihan, kerajinan, sakit, ijin, alpa, kd_ekstra, kd_ekstra2, kd_ekstra3)
        VALUES
        ('', '$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]', '$data[9]') 
        ON DUPLICATE KEY UPDATE kelakuan= '$data[1]', kerapihan= '$data[2]', kerajinan= '$data[3]',
        sakit= '$data[4]', ijin= '$data[5]', alpa= '$data[6]',
        kd_ekstra= '$data[7]', kd_ekstra2= '$data[8]', kd_ekstra3= '$data[9]'"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mysql_query($import) or die(mysql_error()); //Melakukan Import
    }
    fclose($handle); //Menutup CSV file
    echo "
<strong>Import data selesai.</strong>";
}else { //Jika belum menekan tombol submit, form dibawah akan muncul.. ?>
<!-- Form Untuk Upload File CSV-->
   Silahkan masukan file csv yang ingin diupload
  
   <form enctype='multipart/form-data' action='' method='post'>
    Cari CSV File anda:
 
 <input type='file' name='filename' size='100'>
   <input type='submit' name='submit' value='Upload'></form>
<?php } mysql_close(); //Menutup koneksi SQL
?>

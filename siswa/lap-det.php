<?php
session_start();
$a=$_SESSION["username"];
if(isset($_SESSION["username"])){

?> 
<?php
require 'class/siswa.class.php';
$semester = $_GET['id_semester'];
$kelassiswa = $_GET['id_kelassiswa'];
?>
<table border="1">
<?php
$query = "SELECT mapel.nama_mapel, 
                 guru.nama, 
                 mengajar.kb_peng,
                 mengajar.kb_tr,
                 bobot_peng.uh as pu, 
                 bobot_peng.th as pt, 
                 bobot_peng.uts as pts, 
                 bobot_peng.uas as pas, 
                 bobot_tr.proses, 
                 bobot_tr.proyek, 
                 bobot_tr.produk, 
                 pengetahuan.uh, 
                 pengetahuan.th, 
                 pengetahuan.uts, 
                 pengetahuan.uas, 
                 ketrampilan.proy, 
                 ketrampilan.pros, 
                 ketrampilan.prod,
                 ((bobot_peng.uh*pengetahuan.uh)+(bobot_peng.th*pengetahuan.th)+(bobot_peng.uts*pengetahuan.uts)+(bobot_peng.uas*pengetahuan.uas))/100 AS nap,
                 ((bobot_tr.proses*ketrampilan.pros)+(bobot_tr.produk*ketrampilan.prod)+(bobot_tr.proyek*ketrampilan.proy))/100 AS nat
        FROM mapel, guru, bobot_peng, bobot_tr, pengetahuan, ketrampilan, mengajar 
        WHERE mengajar.id_mapel=mapel.id_mapel AND 
        pengetahuan.id_kelassiswa='$kelassiswa' AND
        ketrampilan.id_kelassiswa='$kelassiswa' AND
        bobot_peng.id_bobot_peng=mengajar.id_bobot_peng AND
        bobot_tr.id_bobot_tr=mengajar.id_bobot_tr AND
        guru.id_guru=mengajar.id_guru AND
        pengetahuan.id_mengajar=mengajar.id_mengajar AND
        ketrampilan.id_mengajar=mengajar.id_mengajar AND
        mengajar.id_semester='$semester'  ";
  $crud->DataViewD($query);
  ?>
  </table>
  <?php
}
else {
    header("location:../index.php");}
?>
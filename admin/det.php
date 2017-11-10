<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/siswa1.class.php';
$nis = $_GET['nis'];
?>
<?php include_once 'page/header.php'; ?>
<body class="nav-md">

    <div class="container body">


        <div class="main_container">


<?php include_once 'page/sidebar.php'; ?>
</div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                        <div class="x_panel">
                                <div class="page-title">
    <div class="title">
        <h3 align="center"><b>Hasil Penilaian</b></h3>
        <h2></h2>
    </div>
    </div>
        <br>
        <?php
          $query = "SELECT siswa.nis, siswa.nama_siswa FROM siswa WHERE siswa.id_siswa=(SELECT id_siswa FROM kelas_siswa WHERE id_kelassiswa=$nis)";
          $crud->DetailViewRaport($query); ?>
          <br>
<div class="container">



    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center">No</th>
                <th rowspan="2" style="text-align: center">Mata Pelajaran</th>
                <th rowspan="2" style="text-align: center">Pengajar</th>
                <th colspan="6" style="text-align: center">Pengetahuan</th>
                <th colspan="5" style="text-align: center">Keterampilan</th>
                <!--<td rowspan="2"><b>No</b></td>
                <td rowspan="2"><b>Mata Pelajaran</b></td>
                <td colspan="4"><b>Pengetahuan</b></td>
                <td colspan="4"><b>Keterampilan</b></td>-->
            </tr>
            <tr>
                <th>KB</th>
                <th>TH</th>
                <th>UH</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>NA</th>
                <th>KB</th>
                <th>Proses</th>
                <th>Produk</th>
                <th>Proyek</th>
                <th>NA</th>
                <!--<td><b>KB</b></td>
                <td><b>Angka</b></td>
                <td><b>Predikat</b></td>
                <td><b>Deskripsi</b></td>
                <td><b>KB</b></td>
                <td><b>Angka</b></td>
                <td><b>Predikat</b></td>
                <td><b>Deskripsi</b></td>-->
            </tr>
        </thead>
        </thead>
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
        pengetahuan.id_kelassiswa='$nis' AND
        ketrampilan.id_kelassiswa='$nis' AND
        bobot_peng.id_bobot_peng=mengajar.id_bobot_peng AND
        bobot_tr.id_bobot_tr=mengajar.id_bobot_tr AND
        guru.id_guru=mengajar.id_guru AND
        pengetahuan.id_mengajar=mengajar.id_mengajar AND
        ketrampilan.id_mengajar=mengajar.id_mengajar AND
        mengajar.id_semester='1'";
  $crud->DataViewD($query);
  ?>
        
    </table>
 
</div>
<br>
<br>
<table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>Sakit</th>
                <th>Ijin</th>
                <th>Tanpa Keterangan</th>
            </tr>
        </thead>
        <?php
        include 'koneksi.php';
        $view=mysql_query("SELECT siswa.nama_siswa, 
            ketidakhadiran.sakit, 
            ketidakhadiran.ijin, 
            ketidakhadiran.alpa 
            FROM siswa, ketidakhadiran, kelas_siswa, semester, wali_kelas
            WHERE kelas_siswa.id_siswa=siswa.id_siswa  
            AND ketidakhadiran.id_kelassiswa=kelas_siswa.id_kelassiswa  and 
            wali_kelas.id_semester=semester.id_semester and 
            ketidakhadiran.id_wk=wali_kelas.id_wk and 
            ketidakhadiran.id_kelassiswa='$nis'
            group by siswa.nama_siswa");

        if ($view==FALSE){
            die(mysql_error());
        }

        $i=1;
        while($row=mysql_fetch_array($view)){
        ?>  
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['sakit'];?> Hari</td>
            <td><?php echo $row['ijin'];?> Hari</td>
            <td><?php echo $row['alpa'];?> Hari</td>
        </tr>
        <?php
            $i++;
        }
            $jumSis = $i-1;
        ?>
        
    </table>
<br>
<br>

    <table id="example1" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center">No</th>
                <th rowspan="2" style="text-align: center">Mata Pelajaran</th>
                <th rowspan="2" style="text-align: center">Pengajar</th>
                <th colspan="6" style="text-align: center">Pengetahuan</th>
                <th colspan="5" style="text-align: center">Keterampilan</th>
                <!--<td rowspan="2"><b>No</b></td>
                <td rowspan="2"><b>Mata Pelajaran</b></td>
                <td colspan="4"><b>Pengetahuan</b></td>
                <td colspan="4"><b>Keterampilan</b></td>-->
            </tr>
            <tr>
                <th>KB</th>
                <th>TH</th>
                <th>UH</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>NA</th>
                <th>KB</th>
                <th>Proses</th>
                <th>Produk</th>
                <th>Proyek</th>
                <th>NA</th>
                <!--<td><b>KB</b></td>
                <td><b>Angka</b></td>
                <td><b>Predikat</b></td>
                <td><b>Deskripsi</b></td>
                <td><b>KB</b></td>
                <td><b>Angka</b></td>
                <td><b>Predikat</b></td>
                <td><b>Deskripsi</b></td>-->
            </tr>
        </thead>
        </thead>
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
        pengetahuan.id_kelassiswa='$nis' AND
        ketrampilan.id_kelassiswa='$nis' AND
        bobot_peng.id_bobot_peng=mengajar.id_bobot_peng AND
        bobot_tr.id_bobot_tr=mengajar.id_bobot_tr AND
        guru.id_guru=mengajar.id_guru AND
        pengetahuan.id_mengajar=mengajar.id_mengajar AND
        ketrampilan.id_mengajar=mengajar.id_mengajar AND
        mengajar.id_semester='2'";
  $crud->DataViewD($query);
  ?>
        
    </table>
 
</div>
</div>
        <!-- Datatables -->
        <script src="../js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
                $('#example1').DataTable();
                    
                });
        </script>
        
        <?php include_once 'page/footer.php'; ?>
        </div>
        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index.php");}
?>
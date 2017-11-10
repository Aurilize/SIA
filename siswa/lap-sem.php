<?php
  session_start();
  $a=$_SESSION["username"];
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/siswa.class.php';
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

                    
                    
                        <div class="clearfix"></div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
if(isset($_GET['done'])){
    ?>
    <div class="container">
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><center>Data berhasil ditambahkan atau diperbaharui</center></strong>
    </div>
    </div>
    <?php
}else if(isset($_GET['err'])){
    ?>
    <div class="container">
    <div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><center>Data gagal ditambahkan atau diperbaharui</center></strong>
    </div>
    </div>
    <?php
}
?>
                        <div class="x_panel">
                                <div class="x_title">

                                <div class="clearfix"></div>
                                <div class="page-title">
                        
                            <h3 align="center">
                    Laporan Nilai Per Semester
                    
                </h3>
                        
                        
                    </div>
                    <div class="divider-dashed"> </div>


<div class="clearfix"></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
     <th>Kelas</th>
     <th>Semester</th>
     <th style="display: none">Kelas</th>
     <th style="display: none">Kelas</th>
     <th>Tahun Ajaran</th>
                <th>Detail</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT DISTINCT
kelas_siswa.id_kelassiswa, 
kelas.nama_kelas, 
semester.semester,
semester.id_semester,
       tahun_ajar.tahun_ajaran 
FROM kelas, 
     tahun_ajar, 
     kelas_siswa, 
     siswa, mengajar, semester, pengetahuan
WHERE siswa.nis='$a' AND
        kelas_siswa.id_siswa=(SELECT id_siswa FROM siswa WHERE nis='$a') and
      mengajar.id_tahun=tahun_ajar.id_tahun AND
      kelas_siswa.id_kelas=kelas.id_kelas AND 
      mengajar.id_semester=semester.id_semester AND
      mengajar.id_mengajar=pengetahuan.id_mengajar AND 
      pengetahuan.id_kelassiswa=kelas_siswa.id_kelassiswa";       
  $crud->dataview($query);
  ?>
        
    </table>
 
</div>
</div>
        <!-- Datatables -->
        <script src="../js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
                    
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
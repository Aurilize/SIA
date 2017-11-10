<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.mengajar.php';
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

<div class="container">
<?php
if(isset($_GET['delete_mengajar'])){
$crud->deleteMengajar($_GET['delete_mengajar']); 
}
?>
<a href="a-mengajar" class="btn btn-round btn-primary" style="float: right">Tambah Data</a>
</div>

<div class="divider-dashed"> </div>
<div class="clearfix"><div class="title">
        <h3 align="center"><b>Daftar Mengajar</b></h3>
    </div></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th style="display: none">AA</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
                <th>Ubah Data</th>
                <th>Hapus Data</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT mengajar.id_mengajar, 
                   guru.nama, 
                   mapel.nama_mapel, 
                   kelas.nama_kelas,
                   semester.semester,
                   tahun_ajar.tahun_ajaran
  FROM guru, mapel, kelas, mengajar, semester, tahun_ajar  
  where mengajar.id_mapel=mapel.id_mapel and 
        mengajar.id_kelas=kelas.id_kelas and 
        mengajar.id_guru=guru.id_guru and 
        mengajar.id_semester=semester.id_semester and 
        mengajar.id_tahun=tahun_ajar.id_tahun order by guru.nama";       
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
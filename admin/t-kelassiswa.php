<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.kelassiswa.php';
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
if(isset($_GET['delete_ks'])){
$crud->deletekelassiswa($_GET['delete_ks']); 
}
?>
<a href="a-kelassiswa" class="btn btn-round btn-primary" style="float: right">Tambah Data</a>
</div>
<div class="divider-dashed"> </div>
<div class="clearfix"><div class="title">
        <h3 align="center"><b>Daftar Kelas Siswa</b></h3>
    </div></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
     <th>NIS</th>
     <th>Nama</th>
     <th style="display: none">Kelas</th>
     <th>Kelas</th>
     <th>Tahun Ajaran</th>
                <th>Ubah Data</th>
                <th>Hapus Data</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT kelas_siswa.id_kelassiswa, siswa.nis, siswa.nama_siswa, kelas.nama_kelas, tahun_ajar.tahun_ajaran
  FROM kelas_siswa, kelas, siswa, tahun_ajar
  where kelas_siswa.id_kelas=kelas.id_kelas and 
        kelas_siswa.id_siswa=siswa.id_siswa and 
        kelas_siswa.id_tahun=tahun_ajar.id_tahun";       
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
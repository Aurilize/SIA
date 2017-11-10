<?php
  session_start();
  $a=$_SESSION["username"];
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.coba.php';
?>
<?php include_once 'page/header.php'; ?>
<body class="nav-md">

    <div class="container body">


        <div class="main_container">


<?php include_once 'page/sidebar1.php'; ?>
</div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Data Jurusan
                    
                </h3>
                        </div>
                        
                    </div>
                    
                        <div class="clearfix"></div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
if(isset($_GET['inserted'])){
    ?>
    <div class="container">
    <div class="alert alert-info">
    <strong>WOW!</strong> Record was updated successfully <a href="tables.php">HOME</a>!
    </div>
    </div>
    <?php
}else if(isset($_GET['failure'])){
    ?>
    <div class="container">
    <div class="alert alert-error">
    <strong>SORRY!</strong> ERROR while updating record !
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
if(isset($_GET['delete_kelompok'])){
$crud->deletekelompok($_GET['delete_kelompok']); 
}
?>
<a href="add-user" class="btn btn-small btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
            <th>No</th>
                <th>ID Kelompok</th>
     <th>Kode Kelompok</th>
     <th>Keterangan</th>
     <th>a</th>
                <th>Pengetahuan</th>
                <th>Ketrampilan</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT  mapel.nama_mapel, 
                    mapel.semester, 
                    kelas.nama_kelas, 
                    mengajar.tahun_ajar, 
                    guru.kd_guru 
                    from mapel, 
                         mengajar,
                         kelas, 
                         guru 
                    where mapel.kd_mapel=mengajar.kd_mapel and 
                          mengajar.id_kelas=kelas.id_kelas and
                          mengajar.kd_guru=guru.kd_guru and 
                          guru.nip=$a"; 
    $no=0;

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
    header("location:../index");}
?>

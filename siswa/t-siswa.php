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

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Data User
                    
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
if(isset($_GET['delete_user'])){
$crud->deleteUser($_GET['delete_user']);
 
}
?>
<a href="add-user" class="btn btn-small btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th align="center">NIS</th>
                <th>Kelas</th>
                <th>Guru</th>
                <th>Mata Pelajaran</th>
                <th>Semester</th>
                <th>Nilai Akhir</th>
                <th>Detail</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT  kelas_siswa.nis, 
                    kelas.nama_kelas, 
                    mengajar.kd_guru, 
                    guru.nama, 
                    mapel.nama_mapel, 
                    mapel.semester, 
                    ((th1+th2+th3)/3) as a
            from kelas_siswa, 
                 kelas, 
                 mapel, 
                 guru, 
                 mengajar, 
                 nilai
            where   kelas_siswa.nis=$a AND 
                    nilai.id_kelassiswa=kelas_siswa.id_kelassiswa AND 
                    kelas_siswa.id_kelas=kelas.id_kelas AND 
                    mengajar.id_mengajar=nilai.id_mengajar AND 
                    mengajar.kd_mapel=mapel.kd_mapel AND 
                    mengajar.kd_guru=guru.kd_guru"; 
  $crud->DataViewRaport($query);
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
        

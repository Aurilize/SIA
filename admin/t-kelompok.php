<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.kelompok.php';
?>
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.kelompok.php';
if(isset($_POST['btn-save'])){
    $kd_kelompok = $_POST['kd_kelompok'];
    $nama_kelompok = $_POST['nama_kelompok'];
    if($crud->addKelompok($kd_kelompok, $nama_kelompok)){
        header("Location: t-kelompok?done");
    }else{
        header("Location: t-kelompok?err");
    }
}
?>
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
</div>
                        
                                <div class="x_panel">
                        <div class="title_left">
        <h3>Penambahan Data Kelompok Mata Pelajaran</h3>
    </div>


                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" method="post">
                                    <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kelompok</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">                                                
                                                    <input type="text" class="form-control" placeholder="Kelompok" name="kd_kelompok">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Keterangan</label>
                                            <div class="input-group col-md-5 col-sm-9 col-xs-12">                                              
                                                    <input type="text" class="form-control" placeholder="Keterangan" name="nama_kelompok">
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary" name="btn-save">Submit</button> 
                                                    </span>
                                            </div>
                                            
                                    </div>
                                      </form> 

 
                                    
                                    </div>
                                     <div class="divider-dashed"></div>
                                    </div>

<div class="container">
<?php
if(isset($_GET['delete_kelompok'])){
$crud->deletekelompok($_GET['delete_kelompok']); 
}
?>
<div class="clearfix"><div class="title">
        <h3 align="center"><b>Daftar Kelompok Mata Pelajaran</b></h3>
    </div></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
     <th>Kode Kelompok</th>
     <th>Keterangan</th>
      <th style="display: none">Keterangan</th>
                <th>Ubah Data</th>
                <th>Hapus Data</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT * FROM kelompok"; 
  $crud->dataview($query);
  ?>
        
    </table>


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
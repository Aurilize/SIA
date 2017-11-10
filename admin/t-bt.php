<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.bobot-tr.php';
?>
<?php include_once 'page/header.php'; ?>
<?php
if(isset($_POST['btn-save'])){
    $proses = $_POST['proses'];
    $produk = $_POST['produk'];
    $proyek = $_POST['proyek'];
    if($crud->createBT($proses, $produk, $proyek)){
        header("Location: t-bt?done");
    }else{
        header("Location: t-bt?err");
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
                        <div class="title_left">
        <h3>Penambahan Data Bobot Keterampilan</h3>
    </div>


                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" method="post">
                                    <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proses </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="proses" placeholder="Masukkan Bobot Proses">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Produk </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="produk" placeholder="Masukkan Bobot Produk">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proyek </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="proyek" placeholder="Masukkan Bobot Proyek">
                                            
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
if(isset($_GET['delete_bt'])){
$crud->deleteBT($_GET['delete_bt']);
 
}
?>
<div class="page-title">
    <div class="title">
        <h3 align="center"><b>Bobot Mata Pelajaran</b></h3>
    </div>



    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th style="display: none">Kode Kelas</th>
                <th>Proses</th>
                <th>Produk</th>
                <th>Proyek</th>
                <th>Ubah Data</th>
                <th>Hapus Data</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT * FROM bobot_tr"; 
  $crud->dataview($query);
  ?>
    </table>
    </div>
</div>
</div>

<!--<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
   $('#example').DataTable();
} );
</script>-->


        <!-- chart js -->
        
        <!-- bootstrap progress js -->
        
        
        <!-- icheck -->
        

        


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

<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.bobot-peng.php';
?>
<?php include_once 'page/header.php'; ?>
<?php
if(isset($_POST['btn-save'])){
    $uh = $_POST['uh'];
    $th = $_POST['th'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];
    if($crud->createBT($uh, $th, $uts, $uas)){
        header("Location: t-tr?done");
    }else{
        header("Location: t-tr?err");
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
        <h3>Penambahan Data Bobot Pengetahuan</h3>
    </div>


                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" method="post">
                                    <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">UH </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="uh" placeholder="Masukkan Bobot UH">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">TH </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="th" placeholder="Masukkan Bobot TH">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">UTS </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="uts" placeholder="Masukkan Bobot UTS">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">UAS </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="uas" placeholder="Masukkan Bobot UAS">
                                            
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
                <th>UH</th>
                <th>TH</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Ubah Data</th>
                <th>Hapus Data</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT * FROM bobot_peng"; 
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

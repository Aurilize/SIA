<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.kepsek.php';
?>
<?php include_once 'page/header.php'; ?>
<?php
if(isset($_POST['btn-save'])){
    $nip = $_POST['nip'];
    $nama_kepsek = $_POST['nama_kepsek'];
    $id_tahun = $_POST['id_tahun'];
    if($crud->createkepsek($nip, $nama_kepsek, $id_tahun)){
        header("Location: t-kepsek?done");
    }else{
        header("Location: t-kepsek?err");
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
        <h3>Penambahan Data Kepala Sekolah</h3>
    </div>


                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" method="post">
                                    <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                            <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NIP </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 input-group">
                                                <input type="text" class="form-control" name="nama_kepsek" placeholder="Masukkan Nama Kepala Sekolah" required>
                                            </div>
                                        </div>
                                            <label class="col-sm-3 control-label">Tahun</label>
                                                
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Masukkan Tahun " name="id_tahun" data-inputmask="'mask': '9999'" required>
                                                    <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary" name="btn-save">Submit</button> 
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                      </form> 
 
                                    
                                    </div>
                                     <div class="divider-dashed"></div>
                                    </div>



<div class="container">
<?php
if(isset($_GET['delete_kepsek'])){
$crud->deletekepsek($_GET['delete_kepsek']);
 
}
?>
<div class="page-title">
    <div class="title">
        <h3 align="center"><b>Daftar Kelas</b></h3>
    </div>



    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th style="display: none">Kode Kelas</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tahun</th>
                <th>Ubah Data</th>
                <th>Hapus Data</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT * FROM kepsek"; 
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
        <script src="js/input_mask/jquery.inputmask.js"></script>
    <script>
        $(document).ready(function () {
            $(":input").inputmask();
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

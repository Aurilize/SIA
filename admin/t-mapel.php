<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'class/class.mapel.php';
?>
<?php include_once 'page/header.php'; ?>
<?php
if(isset($_POST['btn-save'])){
    $nama_mapel = $_POST['nama_mapel'];
    $id_kelompok = $_POST['id_kelompok'];
    if($crud->createMapel($nama_mapel, $id_kelompok)){
        header("Location: t-mapel?done");
    }else{
        header("Location: t-mapel?err");
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
        <h3>Penambahan Data Kelas</h3>
    </div>


                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" method="post">
                                    <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mata Pelajaran</label>
                                            <div class="col-md-8 col-sm-9 col-xs-12">                                                
                                                    <input type="text" class="form-control" placeholder="Masukkan Mata Pelajaran" name="nama_mapel">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kelompok</label>
                                            <div class="col-sm-9">                                                
                                                <div class="input-group col-md-9 col-sm-9 col-xs-12">
                                                    <select class="form-control" name="id_kelompok">
                                                <?php 
                                        include 'koneksi.php';
                                        $result= "SELECT * FROM kelompok";
                                        $hasil= mysql_query($result) or die(mysql_error());
                                        while ($row=mysql_fetch_array($hasil)){
                                            echo "<option value='".$row['id_kelompok']."'>".$row['nama_kelompok']." - ".$row['keterangan']."</option>";
                                        }
                                        ?>
                                                </select>
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
if(isset($_GET['delete_mapel'])){
$crud->deleteMapel($_GET['delete_mapel']);
 
}
?>
<div class="page-title">
    <div class="title">
        <h3 align="center"><b>Daftar Mata Pelajaran</b></h3>
    </div>



    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th style="display: none">Kode Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Kelompok</th>
                <th>Ubah Data</th>
                <th>Hapus Data</th>
            </tr>
        </thead>
        <?php
  $query = "SELECT * FROM mapel, kelompok where mapel.id_kelompok=kelompok.id_kelompok"; 
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

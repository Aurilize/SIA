<?php
  session_start();
  $a=$_SESSION["username"];
  $sql = mysql_query("SELECT * from wali_kelas where nip=$a");
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

<?php 
if ($sql = 0){
include_once 'page/sidebar1.php';
}
else {
 include_once 'page/sidebar.php';   
}
?>
</div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    
                </h3>
                        </div>
                        
                    </div>
                    
                        <div class="clearfix"></div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        
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

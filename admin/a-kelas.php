<?php
session_start();
if(isset($_SESSION["username"])){
    ?>
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.kelas.php';
if(isset($_POST['btn-save'])){
    $nama_kelas = $_POST['nama_kelas'];
    if($crud->createKelas($nama_kelas)){
        header("Location: t-kelas?done");
    }else{
        header("Location: t-kelas?err");
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

                    <div class="page-title">

                        <div class="title_left">
                            <h3> Tambah Data Kelas </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
if(isset($_GET['inserted'])){
    ?>
    <div class="container">
    <div class="alert alert-info">
    <strong>WOW!</strong> Record was inserted successfully <a href="index.php">HOME</a>!
    </div>
    </div>
    <?php
}else if(isset($_GET['failure'])){
    ?>
    <div class="container">
    <div class="alert alert-error">
    <strong>SORRY!</strong> ERROR while inserting record !
    </div>
    </div>
    <?php
}
?>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Data Kelas Baru</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" placeholder="Masukkan Kelas" name="nama_kelas">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <button type="reset" class="btn btn-round btn-primary">Reset</button>
                                                <button type="submit" class="btn btn-round btn-success" name="btn-save">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                
                                </div>
                                
                                </div>

                                </div>

                <!-- footer content -->
                
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <?php include_once 'page/end.php'; ?>
    <?php
}
else {
    header("location:../index");}
?>
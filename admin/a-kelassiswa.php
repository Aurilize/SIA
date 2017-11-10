<?php
session_start();
if(isset($_SESSION["username"])){
    ?>
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.kelassiswa.php';
if(isset($_POST['btn-save'])){
    $id_siswa = $_POST['id_siswa'];
    $id_kelas = $_POST['id_kelas'];
    $id_tahun = $_POST['id_tahun'];
    if($crud->addKelasSiswa($id_siswa, $id_kelas, $id_tahun)){
        header("Location: t-kelassiswa?done");
    }else{
        header("Location: t-kelassiswa?err");
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
                            <h3> Tambah Kelas Siswa</h3>
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
                                    <h2>Form Data Kelas Siswa</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select class="select2_single form-control" name="id_siswa">
                                                <option value=""></option>
                                                <?php 
                                        include_once 'koneksi.php';
                                        $result= "SELECT * FROM siswa";
                                        $hasil= mysql_query($result) or die(mysql_error());
                                        while ($row=mysql_fetch_array($hasil)){
                                            echo "<option value='".$row['id_siswa']."'>".$row['nama_siswa']."</option>";
                                        }
                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select class="select2_single form-control" name="id_kelas">
                                                <option value=""></option>
                                                <?php 
                                        include_once 'koneksi.php';
                                        $result= "SELECT * FROM kelas";
                                        $hasil= mysql_query($result) or die(mysql_error());
                                        while ($row=mysql_fetch_array($hasil)){
                                            echo "<option value='".$row['id_kelas']."'>".$row['nama_kelas']."</option>";
                                        }
                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun Ajaran </label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select class="select2_single form-control" name="id_tahun">
                                                <option value=""></option>
                                                <?php 
                                        include_once 'koneksi.php';
                                        $result= "SELECT * FROM tahun_ajar";
                                        $hasil= mysql_query($result) or die(mysql_error());
                                        while ($row=mysql_fetch_array($hasil)){
                                            echo "<option value='".$row['id_tahun']."'>".$row['tahun_ajaran']."</option>";
                                        }
                                        ?>
                                                </select>
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
    <script src="js/input_mask/jquery.inputmask.js"></script>
    <script>
        $(document).ready(function () {
            $(":input").inputmask();
        });
    </script>

    <?php include_once 'page/end.php'; ?>
    <?php
}
else {
    header("location:../index");}
?>
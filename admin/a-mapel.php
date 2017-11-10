<?php
session_start();
if(isset($_SESSION["username"])){
    ?>
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.mapel.php';
if(isset($_POST['btn-save'])){
    $kd_mapel = $_POST['kd_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $kd_jurusan = $_POST['kd_jurusan'];
    $semester = $_POST['semester'];  
    $id_kelompok = $_POST['id_kelompok'];
    if($crud->createMapel($kd_mapel, $nama_mapel, $kd_jurusan, $semester, $id_kelompok)){
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

                    <div class="page-title">

                        <div class="title_left">
                            <h3> Tambah Data Mata Pelajaran</h3>
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
                                    <h2>Form Mata Pelajaran Baru</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Mata Pelajaran </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="kd_mapel" placeholder="Masukkan Kode Mata Pelajaran">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Mata Pelajaran </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="nama_mapel" placeholder="Masukkan Mata Pelajaran" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jurusan </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="select2_single form-control" name="kd_jurusan">
                                                <option value=""></option>
                                                <?php 
                                        $hostmysql = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $database = "smkfix";
                                        $conn = mysql_connect("$hostmysql","$username","$password");
                                        if (!$conn) die ("Gagal Melakukan Koneksi");
                                        mysql_select_db($database,$conn) or die ("Database Tidak Diketemukan di Server");
                                        
                                        $result= "SELECT * FROM jurusan";
                                        $hasil= mysql_query($result) or die(mysql_error());
                                        while ($row=mysql_fetch_array($hasil)){
                                            echo "<option value='".$row['kd_jurusan']."'>".$row['nama_jurusan']."</option>";
                                        }
                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Semester </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="semester" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Kelompok </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="select2_single form-control" name="id_kelompok">
                                                <option value=""></option>
                                                <?php 
                                        $hostmysql = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $database = "smkfix";
                                        $conn = mysql_connect("$hostmysql","$username","$password");
                                        if (!$conn) die ("Gagal Melakukan Koneksi");
                                        mysql_select_db($database,$conn) or die ("Database Tidak Diketemukan di Server");
                                        
                                        $result= "SELECT * FROM kelompok";
                                        $hasil= mysql_query($result) or die(mysql_error());
                                        while ($row=mysql_fetch_array($hasil)){
                                            echo "<option value='".$row['id_kelompok']."'>".$row['nama_kelompok']."</option>";
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
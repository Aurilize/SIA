<?php
session_start();
if(isset($_SESSION["username"])){
    ?>
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.siswa.php';
if(isset($_POST['btn-save'])){
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $nama_siswa = $_POST['nama_siswa'];
    $nama_ortu = $_POST['nama_ortu'];
    $alamat = $_POST['alamat'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk= $_POST['jk'];
    if(($crud->createsiswa($nis, $nisn, $nama_siswa, $nama_ortu, $alamat, $tempat_lahir, $tgl_lahir, $jk))&&($crud->createUserG($nis))){
        header("Location: t-siswa?done");
    }else{
        header("Location: t-siswa?err");
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
                            <h3> Tambah Data Siswa</h3>
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
                                    <h2>Form Siswa Baru</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NIS </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" name="nis" placeholder="Masukkan NIS" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NISN </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" name="nisn" placeholder="Masukkan NISN" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama </label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control" name="nama_siswa" placeholder="Masukkan Nama" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <select class="form-control" name="jk">
                                                    <optgroup label="Pilih Jenis Kelamin">
                                                        <option value="Laki - Laki">Laki - Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Orang Tua</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control" name="nama_ortu" placeholder="Masukkan Nama" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" name="tgl_lahir" data-inputmask="'mask': '99/99/9999'" required>
                                            </div>
                                            <label class="control-label"><i>Ex: 17/12/2000</i></label>
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
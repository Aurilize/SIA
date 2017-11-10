<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.siswa.php';
if(isset($_POST['btn-update'])){
    $id_siswa=$_GET['edit_nis'];
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn'];
    $nama_siswa = $_POST['nama_siswa'];
    $nama_ortu = $_POST['nama_ortu'];
    $alamat = $_POST['alamat'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    if($crud->updatesiswa($id_siswa, $nis, $nisn, $nama_siswa, $nama_ortu, $alamat, $tempat_lahir, $tgl_lahir, $jk)){
        header("Location: t-siswa?done");
    }else{
        header("Location: t-siswa?err");
    }
}

if(isset($_GET['edit_nis']))
{


 $id_siswa = $_GET['edit_nis'];
 extract($crud->getNis($id_siswa)); 
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
                            <h3> Update Data Siswa </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Data Siswa</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NIS</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="nis" value="<?php echo $nis ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NISN</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="nisn" value="<?php echo $nisn ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Siswa</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control" name="nama_siswa" value="<?php echo $nama_siswa ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <select class="form-control" name="jk">
                                                <optgroup label="Pilih Jenis Kelamin">
                                                <?php
                                                if ($jk== "Laki - Laki") echo "<option value='Laki - Laki' selected>Laki - Laki</option>";
                                                else echo "<option value='Laki - Laki'>Laki - Laki</option>";
                                                if ($jk== "Perempuan") echo "<option value='Perempuan' selected>Perempuan</option>";
                                                else echo "<option value='Perempuan'>Perempuan</option>";                  
                                                ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Orang Tua</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control" name="nama_ortu" value="<?php echo $nama_ortu ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="text" class="form-control" name="alamat" value="<?php echo $alamat ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $tempat_lahir ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" name="tgl_lahir" data-inputmask="'mask': '99/99/9999'" value="<?php echo $tgl_lahir ?>" required>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <?php
                                                $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
                                                ?>
                                                <a href="<?=$url?>" class="btn btn-round btn-primary" >Cancel</a>
                                                <button type="submit" class="btn btn-round btn-success" name="btn-update">Submit</button>
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
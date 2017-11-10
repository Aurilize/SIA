<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.kelassiswa.php';
if(isset($_POST['btn-update'])){
    $id_kelassiswa = $_GET['edit_ks'];
    $id_siswa = $_POST['id_siswa'];
    $id_kelas = $_POST['id_kelas'];
    $id_tahun = $_POST['id_tahun'];
    if($crud->updatesiswa($id_kelassiswa, $id_siswa, $id_kelas, $id_tahun)){
        header("Location: t-kelassiswa?done");
    }else{
        header("Location: t-kelassiswa?err");
    }
}

if(isset($_GET['edit_ks']))
{


 $id_kelassiswa = $_GET['edit_ks'];
 extract($crud->getID($id_kelassiswa)); 
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
                            <h3> Update Kelas Siswa </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Siswa</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_kelassiswa = $_GET['edit_ks'];
                                            $hasil=mysql_query("SELECT * FROM kelas_siswa where id_kelassiswa='".$id_kelassiswa."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_siswa =$data['id_siswa'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_siswa">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("select *from siswa");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_siswa == $baris['id_siswa']) {
                                                        echo '<option value="'.$baris['id_siswa'].'" selected>'.$baris["nama_siswa"].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_siswa'].'" >'.$baris["nama_siswa"];
                                                    echo '</option>';
                                                    }
                                                    ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_kelassiswa = $_GET['edit_ks'];
                                            $hasil=mysql_query("SELECT * FROM kelas_siswa where id_kelassiswa='".$id_kelassiswa."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_kelas =$data['id_kelas'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_kelas">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("select *from kelas");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_kelas == $baris['id_kelas']) {
                                                        echo '<option value="'.$baris['id_kelas'].'" selected>'.$baris["nama_kelas"].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_kelas'].'" >'.$baris["nama_kelas"];
                                                    echo '</option>';
                                                    }
                                                    ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun Ajaran</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_kelassiswa = $_GET['edit_ks'];
                                            $hasil=mysql_query("SELECT * FROM kelas_siswa where id_kelassiswa='".$id_kelassiswa."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_tahun =$data['id_tahun'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_tahun">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("select *from tahun_ajar");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_tahun == $baris['id_tahun']) {
                                                        echo '<option value="'.$baris['id_tahun'].'" selected>'.$baris["tahun_ajaran"].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_tahun'].'" >'.$baris["tahun_ajaran"];
                                                    echo '</option>';
                                                    }
                                                    ?>
                                                    </select>
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
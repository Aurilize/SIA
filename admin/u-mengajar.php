<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.mengajar.php';
if(isset($_POST['btn-update'])){
    $id_mengajar = $_GET['edit_mengajar'];
    $id_guru = $_POST['id_guru'];
    $id_mapel = $_POST['id_mapel'];
    $id_kelas = $_POST['id_kelas'];
    $id_semester= $_POST['id_semester'];
    $id_tahun = $_POST['id_tahun'];
    if($crud->updatemengajar($id_mengajar, $id_guru, $id_mapel, $id_kelas, $id_semester, $id_tahun)){
        header("Location: t-mengajar?done");
    }else{
        header("Location: t-mengajar?err");
    }
}

if(isset($_GET['edit_mengajar']))
{


 $id_mengajar = $_GET['edit_mengajar'];
 extract($crud->getmengajar($id_mengajar)); 
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
                            <h3> Update Data Mengajar </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Data Mengajar</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Guru</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_mengajar = $_GET['edit_mengajar'];
                                            $hasil=mysql_query("select *from mengajar where id_mengajar='".$id_mengajar."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_guru =$data['id_guru'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_guru">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("select *from guru");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_guru == $baris['id_guru']) {
                                                        echo '<option value="'.$baris['id_guru'].'" selected>'.$baris["nama"].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_guru'].'" >'.$baris["nama"];
                                                    echo '</option>';
                                                    }
                                                    ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mata Pelajaran</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <?php 
                                            include_once 'koneksi.php';
                                            $id_mengajar = $_GET['edit_mengajar'];
                                            $hasil=mysql_query("select *from mengajar where id_mengajar='".$id_mengajar."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_mapel =$data['id_mapel'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_mapel">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("select *from mapel");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_mapel == $baris['id_mapel']) {
                                                        echo '<option value="'.$baris['id_mapel'].'" selected>'.$baris["nama_mapel"].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_mapel'].'" >'.$baris["nama_mapel"].'</option>';
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
                                            $id_mengajar = $_GET['edit_mengajar'];
                                            $hasil=mysql_query("select *from mengajar where id_mengajar='".$id_mengajar."'");
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
                                                    echo '<option value="'.$baris['id_kelas'].'" >'.$baris["nama_kelas"].'</option>';
                                                    }
                                                    ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Semester</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <?php 
                                            include_once 'koneksi.php';
                                            $id_mengajar = $_GET['edit_mengajar'];
                                            $hasil=mysql_query("SELECT *from mengajar where id_mengajar='".$id_mengajar."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_semester =$data['id_semester'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_semester">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from semester");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_semester == $baris['id_semester']) {
                                                        echo '<option value="'.$baris['id_semester'].'" selected>'.$baris["semester"].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_semester'].'" >'.$baris["semester"].'</option>';
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
                                            $id_mengajar = $_GET['edit_mengajar'];
                                            $hasil=mysql_query("SELECT *from mengajar where id_mengajar='".$id_mengajar."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_tahun =$data['id_tahun'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_tahun">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from tahun_ajar");
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
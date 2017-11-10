<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.walikelas.php';
if(isset($_POST['btn-update'])){
    $id_wk = $_GET['edit_wk'];
    $id_guru = $_POST['id_guru'];
    $id_kelas = $_POST['id_kelas'];
    $id_semester=$_POST['id_semester'];
    $id_tahun = $_POST['id_tahun'];
    if($crud->updatewk($id_wk, $id_guru, $id_kelas, $id_semester, $id_tahun)){
        header("Location: t-wk?done");
    }else{
        header("Location: t-wk?err");
    }
}

if(isset($_GET['edit_wk']))
{


 $id_wk = $_GET['edit_wk'];
 extract($crud->getwk($id_wk)); 
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
                            <h3> Update Data Wali Kelas </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
if(isset($_GET['inserted'])){
    ?>
    <div class="container">
    <div class="alert alert-info">
    <strong>WOW!</strong> Record was updated successfully <a href="table-mengajar.php">HOME</a>!
    </div>
    </div>
    <?php
}else if(isset($_GET['failure'])){
    ?>
    <div class="container">
    <div class="alert alert-error">
    <strong>SORRY!</strong> ERROR while updating record !
    </div>
    </div>
    <?php
}
?>

                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Data Wali Kelas</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Wali Kelas</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_wk = $_GET['edit_wk'];
                                            $hasil=mysql_query("SELECT * FROM wali_kelas where id_wk='".$id_wk."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_guru =$data['id_guru'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_guru">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from guru");
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_wk = $_GET['edit_wk'];
                                            $hasil=mysql_query("SELECT * FROM wali_kelas where id_wk='".$id_wk."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_kelas =$data['id_kelas'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_kelas">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from kelas");
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Semester</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_wk = $_GET['edit_wk'];
                                            $hasil=mysql_query("SELECT * FROM wali_kelas where id_wk='".$id_wk."'");
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
                                                    echo '<option value="'.$baris['id_semester'].'" >'.$baris["semester"];
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
                                            $id_wk = $_GET['edit_wk'];
                                            $hasil=mysql_query("SELECT * FROM wali_kelas where id_wk='".$id_wk."'");
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
<?php 
session_start();
require 'koneksi.php';
?>
<?php
include_once 'class/class.mengajar.php';
if(isset($_POST['btn-update'])){
    $id_mengajar = $_GET['edit_mengajar'];
    $id_bobot_peng = $_POST['id_bobot_peng'];
    $id_bobot_tr = $_POST['id_bobot_tr'];
    $kb_peng = $_POST['kb_peng'];
    $kb_tr= $_POST['kb_tr'];
    if($crud->updatemengajar($id_mengajar, $kb_peng, $kb_tr, $id_bobot_peng, $id_bobot_tr)){
        header("Location: u-mengajar?done");
    }else{
        header("Location: u-mengajar?err");
    }
}

if(isset($_GET['edit_mengajar']))
{


 $id_mengajar = $_GET['edit_mengajar'];
 extract($crud->getmengajar($id_mengajar)); 
}
?>
<?php
$a=$_SESSION['username'];

if(isset($_SESSION["username"])){



include_once 'page/header.php';
?>
<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <?php 
        $b=mysql_query("SELECT * FROM wali_kelas where id_guru=(SELECT id_guru from guru where nip='$a')");
        if ($b==FALSE){
            die(mysql_error());
        }
        $c=mysql_num_rows($b);
        if ($c=='0'){
            include 'page/sidebar.php';
        }else{
            include 'page/sidebar1.php';
        }
         ?>

            </div>
            <!-- /top navigation -->

            <!-- page content -->

            <div class="right_col" role="main">
                        

                        <div class="clearfix"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                        <div class="clearfix"><div class="title">
        <h3 align="center"><b>Setting Bobot dan KKM Pelajaran</b></h3>
    </div></div><br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">KKM Pengetahuan</label>
                                            <div class="col-md-1 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="kb_peng" value="<?php echo $kb_peng ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">KKM Ketrampilan</label>
                                            <div class="col-md-1 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="kb_tr" value="<?php echo $kb_tr ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot Pengetahuan</label>
                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                <?php 
                                            include_once 'koneksi.php';
                                            $id_mengajar = $_GET['edit_mengajar'];
                                            $hasil=mysql_query("SELECT *from mengajar where id_mengajar='".$id_mengajar."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_bobot_peng =$data['id_bobot_peng'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_bobot_peng">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from bobot_peng");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_bobot_peng == $baris['id_bobot_peng']) {
                                                        echo '<option value="'.$baris['id_bobot_peng'].'" selected>'.$baris["uh"].' (UH) - '.$baris["th"].' (TH) - '.$baris["uts"].' (UTS) - '.$baris["uas"].' (UAS)</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_bobot_peng'].'" >'.$baris["uh"].' (UH) - '.$baris["th"].' (TH) - '.$baris["uts"].' (UTS) - '.$baris["uas"].' (UAS)</option>';
                                                    }
                                                    ?>
                                                    </select>
                                            </div>
                                            <label class="control-label"><i>(%)</i></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot Ketrampilan</label>
                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                <?php 
                                            include_once 'koneksi.php';
                                            $id_mengajar = $_GET['edit_mengajar'];
                                            $hasil=mysql_query("SELECT *from mengajar where id_mengajar='".$id_mengajar."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_bobot_tr =$data['id_bobot_tr'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_bobot_tr">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from bobot_tr");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_bobot_tr == $baris['id_bobot_tr']) {
                                                        echo '<option value="'.$baris['id_bobot_tr'].'" selected>'.$baris["proses"].' (Proses) - '.$baris["produk"].' (Produk) - '.$baris["proyek"].' (Proyek) </option>';
                                                    }
                                                    echo '<option value="'.$baris['id_bobot_tr'].'" >'.$baris["proses"].' (Proses) - '.$baris["produk"].' (Produk) - '.$baris["proyek"].' (Proyek) </option>';
                                                    }
                                                    ?>
                                                    </select>
                                            </div>
                                            <label class="control-label"><i>(%)</i></label>
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
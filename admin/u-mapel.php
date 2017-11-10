<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.mapel.php';
if(isset($_POST['btn-update'])){
    $id_mapel = $_GET['edit_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $id_kelompok = $_POST['id_kelompok'];
    if($crud->updateMapel($id_mapel, $nama_mapel, $id_kelompok)){
        header("Location: t-mapel?done");
    }else{
        header("Location: t-mapel?err");
    }
}

if(isset($_GET['edit_mapel']))
{


 $id_mapel = $_GET['edit_mapel'];
 extract($crud->getMapel($id_mapel)); 
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
                                    <h2>Form Data Mata Pelajaran</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                    <form class="form-horizontal form-label-left" method="post">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Mata Pelajaran</label>
                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="nama_mapel" value="<?php echo $nama_mapel ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelompok</label>
                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_mapel = $_GET['edit_mapel'];
                                            $hasil=mysql_query("SELECT * FROM mapel where id_mapel='".$id_mapel."'");
                                            $data=mysql_fetch_array($hasil);
                                            $id_kelompok =$data['id_kelompok'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="id_kelompok">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from kelompok");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($id_kelompok == $baris['id_kelompok']) {
                                                        echo '<option value="'.$baris['id_kelompok'].'" selected>'.$baris['nama_kelompok'].' - '.$baris["keterangan"].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['id_kelompok'].'" >'.$baris['nama_kelompok'].' - '.$baris["keterangan"];
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

    <?php include_once 'page/end.php'; ?>
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.kelas.php';
if(isset($_POST['btn-update'])){
    $id_kelas = $_GET['edit_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $kd_jurusan = $_POST['kd_jurusan'];
    if($crud->updatekelas($id_kelas, $nama_kelas, $kd_jurusan)){
        header("Location: t-kelas?done");
    }else{
        header("Location: t-kelas?err");
    }
}

if(isset($_GET['edit_kelas']))
{


 $id_kelas = $_GET['edit_kelas'];
 extract($crud->getkelas($id_kelas)); 
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
                            <h3> Update Data Kelas </h3>
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
                                    <h2>Form Data Kelas</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="nama_kelas" value="<?php echo $nama_kelas ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jurusan</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                            <?php 
                                            include_once 'koneksi.php';
                                            $id_kelas = $_GET['edit_kelas'];
                                            $hasil=mysql_query("SELECT * FROM kelas where id_kelas='".$id_kelas."'");
                                            $data=mysql_fetch_array($hasil);
                                            $kd_jurusan =$data['kd_jurusan'];
                                            ?>
                                                <select class="select2_single form-control" required="required" name="kd_jurusan">
                                                <?php
                                                include_once 'koneksi.php';
                                                $sql=mysql_query("SELECT *from jurusan");
                                                while($baris=mysql_fetch_array($sql)){
                                                    if ($kd_jurusan == $baris['kd_jurusan']) {
                                                        echo '<option value="'.$baris['kd_jurusan'].'" selected>'.$baris['nama_jurusan'].'</option>';
                                                    }
                                                    echo '<option value="'.$baris['kd_jurusan'].'" >'.$baris['nama_jurusan'];
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
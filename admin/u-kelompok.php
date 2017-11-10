<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.kelompok.php';
if(isset($_POST['btn-update'])){
    $id_kelompok = $_GET['edit_kelompok'];
    $nama_kelompok = $_POST['nama_kelompok'];
    $keterangan = $_POST['keterangan'];
    if($crud->updatekelompok($id_kelompok, $nama_kelompok, $keterangan)){
        header("Location: t-kelompok?done");
    }else{
        header("Location: t-kelompok?err");
    }
}

if(isset($_GET['edit_kelompok']))
{


 $id_kelompok = $_GET['edit_kelompok'];
 extract($crud->getkelompok($id_kelompok)); 
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
                            <h3> Update Data Kelompok </h3>
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
                                    <h2>Form Ubah Kelompok</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelompok</label>
                                            <div class="col-md-1 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="nama_kelompok" value="<?php echo $nama_kelompok ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="keterangan" value="<?php echo $keterangan ?>">
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
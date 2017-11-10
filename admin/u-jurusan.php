<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.jurusan.php';
if(isset($_POST['btn-update'])){
    $kd_jurusan = $_GET['edit_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];
    if($crud->updatejurusan($kd_jurusan, $nama_jurusan)){
        header("Location: t-jurusan?done");
    }else{
        header("Location: t-jurusan?err");
    }
}

if(isset($_GET['edit_jurusan']))
{


 $kd_jurusan = $_GET['edit_jurusan'];
 extract($crud->getjurusan($kd_jurusan)); 
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
                            <h3> Update Data Jurusan </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
if(isset($_GET['inserted'])){
    ?>
    <div class="container">
    <div class="alert alert-info">
    <strong>WOW!</strong> Record was updated successfully <a href="tables.php">HOME</a>!
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
                                    <h2>Form Data Jurusan</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jurusan </label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="text" class="form-control" name="nama_jurusan" value="<?php echo $nama_jurusan; ?>" required>
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
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.kepsek.php';
if(isset($_POST['btn-update'])){
    $id_kepsek = $_GET['edit_kepsek'];
    $nip = $_POST['nip'];
    $nama_kepsek = $_POST['nama_kepsek'];
    $id_tahun = $_POST['id_tahun'];
    if($crud->updateKepsek($id_kepsek,$nip, $nama_kepsek, $id_tahun)){
        header("Location: t-kepsek?done");
    }else{
        header("Location: t-kepsek?err");
    }
}

if(isset($_GET['edit_kepsek']))
{


 $id_kepsek = $_GET['edit_kepsek'];
 extract($crud->getkepsek($id_kepsek)); 
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
                            <h3> Update Data Kepala Sekolah </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Data Kepala Sekolah</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NIP</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="nip" value="<?php echo $nip ?>" require>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="nama_kepsek" value="<?php echo $nama_kepsek ?>" require>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun</label>
                                            <div class="col-md-1 col-sm-1 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="id_tahun" value="<?php echo $id_tahun ?>">
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
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.bobot-tr.php';
if(isset($_POST['btn-update'])){
    $id_bobot_tr = $_GET['edit_bt'];
    $proses = $_POST['proses'];
    $produk = $_POST['produk'];
    $proyek = $_POST['proyek'];
    if($crud->updateBT($id_bobot_tr, $proses, $produk, $proyek)){
        header("Location: t-bt?done");
    }else{
        header("Location: t-bt?err");
    }
}

if(isset($_GET['edit_bt']))
{


 $id_bobot_tr = $_GET['edit_bt'];
 extract($crud->getBT($id_bobot_tr)); 
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
                       
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Data Bobot Ketrampilan</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    <div class="col-md-12">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proses</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" name="proses" value="<?php echo $proses; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Produk</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" name="produk" value="<?php echo $produk; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Proyek</label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="text" class="form-control" name="proyek" value="<?php echo $proyek; ?>" required>
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
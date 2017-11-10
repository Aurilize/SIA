<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.bobot-peng.php';
if(isset($_POST['btn-update'])){
    $id_bobot_peng = $_GET['edit_bt'];
    $uh = $_POST['uh'];
    $th = $_POST['th'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];
    if($crud->updateBT($id_bobot_peng, $uh, $th, $uts, $uas)){
        header("Location: t-tr?done");
    }else{
        header("Location: t-tr?err");
    }
}

if(isset($_GET['edit_bt']))
{


 $id_bobot_peng = $_GET['edit_bt'];
 extract($crud->getBT($id_bobot_peng)); 
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
                                    <h2>Form Data Bobot Pengetahuan</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    <div class="col-md-6">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">UH</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="uh" value="<?php echo $uh; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">TH</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="th" value="<?php echo $th; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">UTS</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="uts" value="<?php echo $uts; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">UAS</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="uas" value="<?php echo $uas; ?>" required>
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
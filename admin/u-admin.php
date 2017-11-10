<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.admin.php';
if(isset($_POST['btn-update'])){
    $username = $_GET['edit_user'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    if($crud->updateUser($username,$password,$level)){
        header("Location: t-admin?done");
    }else{
        header("Location: t-admin?err");
    }
}

if(isset($_GET['edit_user']))
{


 $username = $_GET['edit_user'];
 extract($crud->getUser($username)); 
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
                            <h3> Update Data User </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Ubah User</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Akses sebagai</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="form-control" name="level" disabled>
                                                <optgroup label="Pilih Akses">
                                                <?php
                                                if ($level== "Guru") echo "<option value='Guru' selected>Guru</option>";
                                                else echo "<option value='Guru'>Guru</option>";
                                                if ($level== "Siswa") echo "<option value='Siswa' selected>Siswa</option>";
                                                else echo "<option value='Siswa'>Siswa</option>";                  
                                                ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" 
                                                name="username" value="<?php echo $username ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required>
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
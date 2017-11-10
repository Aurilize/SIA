<?php
session_start();
if(isset($_SESSION["username"])){
    ?>
<?php include_once 'page/header.php'; ?>
<?php
include_once 'class/class.admin.php';
if(isset($_POST['btn-save'])){
    $username = $_POST['username']; 
    $password = $_POST['password'];
    $level = $_POST['level'];
    if($crud->createUser($username,$password,$level)){
        header("Location: t-admin?done");
    }else{
        header("Location: t-admin?err");
    }
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
                            <h3> Tambah Data User </h3>
                        </div>
                    </div>
                    
                        <div class="clearfix">
                        

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
if(isset($_GET['inserted'])){
    ?>
    <div class="container">
    <div class="alert alert-info">
    <strong>WOW!</strong> Record was inserted successfully <a href="index.php">HOME</a>!
    </div>
    </div>
    <?php
}else if(isset($_GET['failure'])){
    ?>
    <div class="container">
    <div class="alert alert-error">
    <strong>SORRY!</strong> ERROR while inserting record !
    </div>
    </div>
    <?php
}
?>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Data User Baru</small></h2>
                                    <div class="clearfix">
                                    </div>
                                    </div>
                                    <div class="x_content">
                                    	<br />
                                    <form class="form-horizontal form-label-left" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Akses sebagai</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="form-control" name="level" id="level">
                                                    <optgroup label="Pilih Akses">
                                                        <option value=""></option>
                                                        <option value="Guru">Guru</option>
                                                        <option value="Siswa">Siswa</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                            
                                            <select class="select2_single form-control" name="username" id="username">
                                                <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <button type="reset" class="btn btn-round btn-primary">Reset</button>
                                                <button type="submit" class="btn btn-round btn-success" name="btn-save">Submit</button>
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
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;

$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#level").change(function(){
    var level = $("#level").val();
    if(level=='Siswa'){
    $.ajax({
        url: "siswa.php",
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#username").html(msg);
        }
    });
}
else if(level=='Guru'){
    $.ajax({
        url: "guru.php",
        cache: false,
        success: function(msg){
            $("#username").html(msg);
        }
  });
  }
    });
  });

</script>
        </div>

    </div>

    <?php include_once 'page/end.php'; ?>
    <?php
}
else {
    header("location:../index");}
?>
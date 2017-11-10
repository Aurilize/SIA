<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
<?php
// memanggil file config.php
require 'koneksi.php';
?>
<?php include_once 'page/header.php'; ?>
<body class="nav-md">

    <div class="container body">


        <div class="main_container">


<?php include_once 'page/sidebar1.php'; ?>
</div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Data Jurusan
                    
                </h3>
                        </div>
                        
                    </div>
                    
                        <div class="clearfix"></div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <!--Alert Error diletakkan disini-->
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
                                <div class="clearfix"></div>
                                <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Wizards <small>Sessions</small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <!-- Smart Wizard -->
                                    <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
                                    <div id="wizard" class="form_wizard wizard_horizontal">
                                        <ul class="wizard_steps">
                                            <li>
                                                <a href="#step-1">
                                                    <span class="step_no" style="color:#FFF"><b>1</span>
                                                    <span class="step_descr" style="color:#000">
                                            Langkah 1<br />
                                            <small>Pilih Mata Pelajaran</small></b>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="a">
                                                    <span class="step_no">2</span>
                                                    <span class="step_descr">
                                            Step 2<br />
                                            <small>Step 2 description</small>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-3">
                                                    <span class="step_no">3</span>
                                                    <span class="step_descr">
                                            Step 3<br />
                                            <small>Step 3 description</small>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-4">
                                                    <span class="step_no">4</span>
                                                    <span class="step_descr">
                                            Step 4<br />
                                            <small>Step 4 description</small>
                                        </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div id="step-1">
                                        <div class="clearfix"></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Kelompok</th>
                <th>Kode Kelompok</th>
                <th>Keterangan</th>
                <th>a</th>
                <th>Pengetahuan</th>
                <th>Ketrampilan</th>
            </tr>
        </thead>
        <?php
        $id_guru=$_SESSION['id_guru'];
        $view=mysql_query("select * from mengajar, guru, mapel, kelas, tahun_ajar where mengajar.id_guru=guru.id_guru, mengajar.id_mapel=mapel.id_mapel, mengajar.id_kelas=kelas.id_kelas, mengajar.id_tahun=tahun_ajar.id_tahun, mengajar.id_guru='$id_guru' order by id_mengajar asc");
        
        $no=0;
        while($row=mysql_fetch_array($view)){
        ?>  
        <tr>
            <td><?php echo $no=$no+1;?></td>
            <td><a href="input-coba?id_mengajar=<?php echo $row['id_mengajar'];?>" style="text-decoration:underline" title="Pilih Mata Pelajaran"><?php echo $row['nama_pelajaran'];?></a></td>
            <td><a href="input-coba?id_guru=<?php echo $id_guru;?>&id_mapel=<?php echo $row['id_mapel'];?>&id_kelas=<?php echo $row['id_kelas'];?>&id_tahun=<?php echo $row['id_tahun'];?>" style="text-decoration:underline" title="Pilih Mata Pelajaran"><?php echo $row['nama_pelajaran'];?></a></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td><?php echo $row['tahun_ajaran'];?></td>
        </tr>
        <?php
        }
        ?>
        
    </table>
 
</div>
<?php
if(isset($_GET['id_mengajar'])){
    
    $id_mengajar=$_GET['id_mengajar'];
//    $id_kelas=$_GET['id_kelas'];
 //   $id_mapel=$_GET['id_mapel'];
 //   $id_tahun=$_GET['id_tahun'];
    
    $query=mysql_query("select * from pengetahuan where id_mengajar='$id_mengajar'");
    $cek=mysql_num_rows($query);
    
    if($cek=='0'){
        //kalo belum ada mode input
        ?><script language="javascript">document.location.href="input-coba?id_mengajar=<?php echo $id_mengajar?>";</script><?php
    }else{
        //kalo sudah ada mode update
        ?><script language="javascript">document.location.href="update-coba?id_mengajar=<?php echo $id_mengajar?>";</script><?php
    }
    
}else{
    unset($_POST['id_mengajar']);
}


?>
</div>

                                        </div>
                                        </div>
                                        </div>
        <!-- Datatables -->
        <script src="../js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
                    
                });
        </script>
        
        <?php include_once 'page/footer.php'; ?>
        </div>
        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index");}
?>

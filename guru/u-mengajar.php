<?php 
session_start();
require 'koneksi.php';
?>
<?php
if(isset($_GET['id_mengajar'])){
    
    $id_mengajar=$_GET['id_mengajar'];
    
    $query=mysql_query("SELECT kb_peng, kb_tr, id_bobot_peng, id_bobot_tr from mengajar where id_mengajar='$id_mengajar'");
    if ($query==FALSE){
            die(mysql_error());
        }
    $cek=mysql_num_rows($query);
    
    if($cek=='0'){
        //kalo belum ada mode input
        ?><script language="javascript">document.location.href="input-mengajar?id_mengajar=<?php echo $id_mengajar?>";</script><?php
    }else{
        //kalo sudah ada mode update
        ?><script language="javascript">document.location.href="update-mengajar?edit_mengajar=<?php echo $id_mengajar?>";</script><?php
    }
    
}else{
    unset($_POST['id_mengajar']);
}


?>
<?php
$a=$_SESSION['username'];

if(isset($_SESSION["username"])){



include_once 'page/header.php';
?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
        <?php 
        $b=mysql_query("SELECT * FROM wali_kelas where id_guru=(SELECT id_guru from guru where nip='$a')");
        if ($b==FALSE){
            die(mysql_error());
        }
        $c=mysql_num_rows($b);
        if ($c=='0'){
            include 'page/sidebar.php';
        }else{
            include 'page/sidebar1.php';
        }
         ?>
        </div>

        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php
if(isset($_GET['done'])){
    ?>
    <div class="container">
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><center>Data berhasil ditambahkan atau diperbaharui</center></strong>
    </div>
    </div>
    <?php
}else if(isset($_GET['err'])){
    ?>
    <div class="container">
    <div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong><center>Data gagal ditambahkan atau diperbaharui</center></strong>
    </div>
    </div>
    <?php
}
?>
            <div class="clearfix"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                        <div class="clearfix"><div class="title">
        <h3 align="center"><b>Setting Bobot dan KKM Pelajaran</b></h3>
    </div></div><br />
                                    <!-- Smart Wizard -->
                                    
                                    <div id="wizard" class="form_wizard wizard_horizontal">
                                        <div id="step-1">
                                        <div class="clearfix"></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Bobot</th>
                <th>Tahun Ajaran</th>
                <th>Setting Nilai</th>
            </tr>
        </thead>
        <?php
        $view=(mysql_query(
            "SELECT mengajar.id_mengajar, 
            mapel.nama_mapel, 
            kelas.nama_kelas,
            tahun_ajar.id_tahun,
            tahun_ajar.tahun_ajaran,
            semester.semester 
            FROM mengajar, 
            guru, 
            mapel, 
            kelas, 
            semester,
            tahun_ajar 
            where 
            mengajar.id_guru=(SELECT id_guru from guru where nip='$a') and 
            mengajar.id_mapel=mapel.id_mapel and 
            mengajar.id_kelas=kelas.id_kelas and 
            mengajar.id_tahun=tahun_ajar.id_tahun and 
            mengajar.id_semester=semester.id_semester 
            group by mengajar.id_mengajar
            order by id_mengajar asc"));

        if ($view==FALSE){
            die(mysql_error());
        }
        
        $no=0;
        while($row=mysql_fetch_array($view)){
        ?>  
        <tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_mapel'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td><?php echo $row['semester'];?></td>
            <td><?php echo $row['tahun_ajaran'];?></td>
            <td><a href="u-mengajar?id_mengajar=<?php echo $row['id_mengajar'];?>&id_tahun=<?php echo $row['id_tahun'];?>" style="text-decoration:underline">Pengisian KKM dan Bobot Penilaian</a></td>
        </tr>
        <?php
        }
        ?>
        
    </table>
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



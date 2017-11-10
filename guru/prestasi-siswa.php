<?php 
session_start();
require 'koneksi.php';
?>

<?php
$a=$_SESSION['username'];

if(isset($_SESSION["username"])){

require 'koneksi.php';

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
            <div class="clearfix"></div>
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
                            		<div class="x_panel">
                                		
                                		<div class="x_content">
                                    <!-- Smart Wizard -->
                                    <div class="clearfix"><div class="title">
        <h3 align="center"><b>Prestasi</b></h3>
    </div></div><br />
                                    <div id="wizard" class="form_wizard wizard_horizontal">
                                        
                                        <div id="step-1">
                                        <div class="clearfix"></div><br />

<div class="container">
<?php
        
        $id_wk=$_GET['id_wk'];
        
        $view=mysql_query("SELECT *
            FROM wali_kelas, 
            guru,
            kelas,
            semester, 
            tahun_ajar 
            where 
            wali_kelas.id_guru=(SELECT id_guru from guru where nip='$a') and 
            wali_kelas.id_kelas=kelas.id_kelas and 
            wali_kelas.id_guru=guru.id_guru and
            wali_kelas.id_tahun=tahun_ajar.id_tahun and 
            wali_kelas.id_semester=semester.id_semester and 
            wali_kelas.id_wk='$id_wk'
            group by wali_kelas.id_wk
            order by id_wk asc");

        if ($view==FALSE){
            die(mysql_error());
        }

        while($ajar=mysql_fetch_array($view)){

        $nama_guru=$ajar['nama'];
        $nama_kelas=$ajar['nama_kelas'];
        $semester=$ajar['semester'];
        $tahun_ajaran=$ajar['tahun_ajaran'];
    }
        
        ?>
        <table>
        <tr>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Guru</label></th>
            <td><input type="text" class="form-control" name="tahun_ajar" value="<?php echo $nama_guru ?>"></td>
            <td></td>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kelas</label></th>
            <td><input type="text" class="form-control" name="tahun_ajar" value="<?php echo $nama_kelas ?>"></td>
            <td></td>
        </tr>
        <tr>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Semester</label></th>
            <td><input type="text" class="form-control" name="tahun_ajar" value="<?php echo $semester ?>"></td>
            <td class="col-md-4"></td>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun Ajaran</label></th>
            <td><input type="text" class="form-control" name="tahun_ajar" value="<?php echo $tahun_ajaran ?>"></td>
            <td></td>
        </tr>
        </table>
        <br>


    <form  method="post">
    <table class='table table-bordered responsive-utilities jambo_table' id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat</th>
            </tr>
        </thead>
        <?php
        $view=mysql_query(
        	"SELECT siswa.id_siswa, 
                    siswa.nis, 
                    siswa.nama_siswa, 
                    wali_kelas.id_wk, 
                    kelas_siswa.id_kelassiswa 
            FROM siswa,  
                 kelas_siswa,
                 wali_kelas 
            WHERE kelas_siswa.id_siswa=siswa.id_siswa AND 
                  kelas_siswa.id_kelassiswa=(SELECT id_kelassiswa FROM wali_kelas WHERE id_wk='$id_wk') AND 
                  wali_kelas.id_wk='$id_wk' AND 
                  wali_kelas.id_tahun=kelas_siswa.id_tahun AND
                  kelas_siswa.id_kelas=(SELECT id_kelas FROM wali_kelas WHERE id_wk='$id_wk')
                  group by siswa.nama_siswa");

        if ($view==FALSE){
        	die(mysql_error());
        }

        $i=1;
        while($row=mysql_fetch_array($view)){
        ?>  
        <input type="hidden" name="id_wk" value="<?php echo $id_wk;?>" />
        <?php echo "<input type='hidden' name='id_kelassiswa' value='".$row['id_kelassiswa']."' />"; ?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><a href="input-prestasi?id_wk=<?php echo $row['id_wk'];?>&id_kelassiswa=<?php echo $row['id_kelassiswa'];?>" style="text-decoration:underline" title="Pilih Siswa">Isi Prestasi</a></td>
        </tr>
        <?php
            $i++;
        }
            $jumSis = $i-1;
        ?>
        
    </table>
    </div>

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



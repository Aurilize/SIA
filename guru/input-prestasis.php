<?php 
session_start();
require 'koneksi.php';
?>
<?php
if(isset($_POST['submit'])){   
       $id_kelassiswa = $_POST['id_kelassiswa'];
       $id_wk = $_POST['id_wk'];
       $jenis_pres1 = $_POST['jenis_pres1'];
       $keterangan1 = $_POST['keterangan1'];
       $jenis_pres2 = $_POST['jenis_pres2'];
       $keterangan2 = $_POST['keterangan2'];
       $jenis_pres3 = $_POST['jenis_pres3'];
       $keterangan3 = $_POST['keterangan3'];
       
    
       $query = "insert into prestasicoba values('','$id_kelassiswa','$id_wk','$jenis_pres1','$keterangan1','$jenis_pres2','$keterangan2', '$jenis_pres3', '$keterangan3')";
       $hasil=mysql_query($query);
       if ($query==FALSE){
            die(mysql_error());
    }
    if($hasil){
        ?><script language="javascript">document.location.href="prestasi-siswa?id_wk=<?php echo $id_wk;?>&done";</script><?php
    }else{
        ?><script language="javascript">document.location.href="prestasi-siswa?id_wk=<?php echo $id_wk;?>&err";</script><?php
    }
    
}else{
    unset($_POST['submit']);
}
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
    	<?php include_once 'page/sidebar1.php'; ?>
    	</div>

    	<div class="right_col" role="main">
            <div class="clearfix"></div>
                            	<div class="col-md-12 col-sm-12 col-xs-12">
                            		<div class="x_panel">
                                		<div class="x_title">
                                			<h2>Prestasi Siswa</h2>
                                    		<div class="clearfix"></div>
                                		</div>
                                		<div class="x_content">
                                    <!-- Smart Wizard -->

<div class="container">
<?php
        
        $id_wk=$_GET['id_wk'];
        $id_kelassiswa=$_GET['id_kelassiswa'];
        
        $view=mysql_query("SELECT *
            FROM wali_kelas, 
            guru,
            kelas,
            semester, 
            tahun_ajar 
            where 
            wali_kelas.id_guru=(SELECT id_guru from guru where nip='$a') and 
            wali_kelas.id_kelas=kelas.id_kelas and 
            wali_kelas.id_tahun=tahun_ajar.id_tahun and 
            wali_kelas.id_guru=guru.id_guru and
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

    <form  class="form-horizontal form-label-left" method="post">
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
                  kelas_siswa.id_kelas=(SELECT id_kelas FROM wali_kelas WHERE id_wk='$id_wk') AND 
                  kelas_siswa.id_kelassiswa='$id_kelassiswa'
                  group by siswa.nama_siswa");

        if ($view==FALSE){
        	die(mysql_error());
        }
        while($row=mysql_fetch_array($view)){
            $nama=$row['nama_siswa'];
        }
        ?>  
        <input type="hidden" name="id_wk" value="<?php echo $id_wk;?>" >
        <input type='hidden' name='id_kelassiswa' value="<?php echo $id_kelassiswa;?>">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="password" value="<?php echo $nama; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="password" value="<?php echo $nama_kelas; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Prestasi 1 </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="jenis_pres1" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="keterangan1" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Prestasi 2 </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="jenis_pres2" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="keterangan2" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Prestasi 3 </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="jenis_pres3" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="keterangan3" >
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="reset" class="btn btn-round btn-primary">Reset</button>
                <button type="submit" class="btn btn-round btn-success" name="submit" onclick="return confirm('Apakah Anda yakin?')">Submit</button>
            </div>
        </div>
    </form>
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
        ?>
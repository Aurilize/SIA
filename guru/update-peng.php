<?php 
session_start();
require 'koneksi.php';
?>
<?php
if(isset($_POST['submit'])){
    
    $jumSis = $_POST['jumlah'];
    
    
    for ($i=1; $i<=$jumSis; $i++)
    {
       $id_kelassiswa = $_POST['id_kelassiswa'.$i];
       $uh  = $_POST['uh'.$i];
       $th  = $_POST['th'.$i];
       $uts  = $_POST['uts'.$i];
       $uas  = $_POST['uas'.$i];

       $id_mengajar = $_POST['id_mengajar'];
    
       $query = "UPDATE pengetahuan set uh='$uh', th='$th', uts='$uts', uas='$uas' where id_kelassiswa='$id_kelassiswa' and id_mengajar='$id_mengajar'";
       $hasil=mysql_query($query);
       if ($query==FALSE){
            die(mysql_error());
        }
    }
    
    if($hasil){
        ?><script language="javascript">document.location.href="selesai-peng?id_mengajar=<?php echo $id_mengajar;?>&done";</script><?php
    }else{
        ?><script language="javascript">document.location.href="selesai-peng?id_mengajar=<?php echo $id_mengajar;?>&err";</script><?php
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
                            		<div class="x_panel">
                                		<div class="x_content">
                                        <div class="clearfix"><div class="title">
        <h3 align="center"><b>Update Nilai Pengetahuan</b></h3>
    </div></div><br />
                                    <!-- Smart Wizard -->
                                    <div id="wizard" class="form_wizard wizard_horizontal">
                                        <div id="step-1">
                                        <div class="clearfix"></div><br />

<div class="container">
<?php
        
        $id_mengajar=$_GET['id_mengajar'];
        
        $view=mysql_query("SELECT *
            FROM mengajar, 
            guru, 
            mapel, 
            kelas, 
            bobot_peng,
            semester, 
            tahun_ajar 
            where 
            mengajar.id_guru=(SELECT id_guru from guru where nip='$a') and 
            mengajar.id_mapel=mapel.id_mapel and 
            mengajar.id_kelas=kelas.id_kelas and 
            mengajar.id_guru=guru.id_guru and
            mengajar.id_tahun=tahun_ajar.id_tahun and 
            mengajar.id_bobot_peng=bobot_peng.id_bobot_peng and
            mengajar.id_semester=semester.id_semester and 
            mengajar.id_mengajar='$id_mengajar'
            group by mengajar.id_mengajar
            order by id_mengajar asc");

        if ($view==FALSE){
            die(mysql_error());
        }

        while($ajar=mysql_fetch_array($view)){

        $nama_guru=$ajar['nama'];
        $nama_kelas=$ajar['nama_kelas'];
        $nama_pelajaran=$ajar['nama_mapel'];
        $b_uh = $ajar['uh'];
        $b_th = $ajar['th'];
        $b_uts = $ajar['uts'];
        $b_uas = $ajar['uas'];
        $semester=$ajar['semester'];
        $tahun_ajaran=$ajar['tahun_ajaran'];
    }
        
        ?>
        <table>
        <tr>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Guru</label></th>
            <td><input type="text" class="form-control" name="tahun_ajar" value="<?php echo $nama_guru ?>"></td>
            <td></td>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Mata Pelajaran</label></th>
            <td><input type="text" class="form-control" name="nama_pelajaran" value="<?php echo $nama_pelajaran ?>"></td>
            <td></td>
        </tr>
        <tr>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kelas</label></th>
            <td><input type="text" class="form-control" name="tahun_ajar" value="<?php echo $nama_kelas ?>"></td>
            <td class="col-md-4"></td>
            <th><label class="control-label col-md-3 col-sm-3 col-xs-12">Bobot Nilai</label></th>
            <td><input type="text" class="form-control" name="nama_pelajaran" value="<?php echo $b_uh ?> : <?php echo $b_th?> : <?php echo $b_uts?> : <?php echo $b_uas?>"></td>
            <td><label class="control-label"><i>&nbsp;(%)</i></label></td>
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

    <form  action="update-peng" method="post">
    <table table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>KKM</th>
                <th>UH</th>
                <th>TH</th>
                <th>UTS</th>
                <th>UAS</th>
            </tr>
        </thead>
        <?php
        $view=mysql_query(
        	"SELECT *
            FROM siswa, mengajar, kelas_siswa, pengetahuan 
            WHERE kelas_siswa.id_siswa=siswa.id_siswa AND 
            kelas_siswa.id_kelas=(SELECT id_kelas FROM mengajar WHERE id_mengajar='$id_mengajar') AND 
            mengajar.id_mengajar='$id_mengajar' AND 
            kelas_siswa.id_kelassiswa=pengetahuan.id_kelassiswa AND 
            mengajar.id_mengajar=pengetahuan.id_mengajar 
            group by siswa.nama_siswa");
        if ($view==FALSE){
        	die(mysql_error());
        }

        $i=1;
        while($row=mysql_fetch_array($view)){
        ?>  
        <input type="hidden" name="id_mengajar" value="<?php echo $id_mengajar;?>" />
        <?php echo "<input type='hidden' name='id_kelassiswa".$i."' value='".$row['id_kelassiswa']."' />"; ?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['nis'];?></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><?php echo $row['kb_peng'];?></td>
            <td><?php echo "<input type='text' name='uh".$i."' size='10' value='".$row['uh']."'/>"; ?></td>
                <td><?php echo "<input type='text' name='th".$i."' size='10' value='".$row['th']."'/>"; ?></td>
                <td><?php echo "<input type='text' name='uts".$i."' size='10' value='".$row['uts']."'/>"; ?></td>
                <td><?php echo "<input type='text' name='uas".$i."' size='10' value='".$row['uas']."'/>"; ?></td>
        </tr>
        <?php
            $i++;
        }
            $jumSis = $i-1;
        ?>
        <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" />
        <tr>
            <td colspan="8" align="center"><input type="submit" onclick="return confirm('Apakah Anda yakin?')" value="Update" name="submit"/></td>
        </tr>
        
    </table>
    </div>

</div>

                                        </div>
        <!-- Datatables -->
        
        
        <?php include_once 'page/footer.php'; ?>
        </div>
        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index");}
?>



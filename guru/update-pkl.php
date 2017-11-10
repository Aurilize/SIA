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
       $tempat  = $_POST['tempat'.$i];
       $lokasi  = $_POST['lokasi'.$i];
       $lama  = $_POST['lama'.$i];
       $ket  = $_POST['ket'.$i];

       $id_wk = $_POST['id_wk'];
    
       $query = "UPDATE pkl set tempat='$tempat', lokasi='$lokasi', lama='$lama', ket='$ket' where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk'";
       $hasil=mysql_query($query);
       if ($query==FALSE){
            die(mysql_error());
        }
    }
    
    if($hasil){
        ?><script language="javascript">document.location.href="selesai-pkl?id_wk=<?php echo $id_wk;?>&done";</script><?php
    }else{
        ?><script language="javascript">document.location.href="selesai-pkl?id_wk=<?php echo $id_wk;?>&err";</script><?php
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
    	<div class="main_container"><?php 
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
                                		<div class="x_title">
                                        <div class="clearfix"><div class="title">
        <h3 align="center"><b>Update Praktik Kerja Lapangan</b></h3>
    </div></div><br />
                                		</div>
                                		<div class="x_content">
                                    <!-- Smart Wizard -->
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


    <form  action="update-pkl.php" method="post">
    <table table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat</th>
                <th>Lokasi</th>
                <th>Lama</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <?php
        $view=mysql_query(
        	"SELECT * 
            FROM siswa,  
                 kelas_siswa,
                 wali_kelas, 
                 pkl
            WHERE kelas_siswa.id_siswa=siswa.id_siswa AND
                  pkl.id_wk=wali_kelas.id_wk AND
                  pkl.id_wk='$id_wk' AND 
                  kelas_siswa.id_kelassiswa=pkl.id_kelassiswa AND
                  kelas_siswa.id_kelas=(SELECT id_kelas FROM wali_kelas WHERE id_wk='$id_wk')
                  group by siswa.nama_siswa");

        if ($view==FALSE){
        	die(mysql_error());
        }

        $i=1;
        while($row=mysql_fetch_array($view)){
        ?>  
        <input type="hidden" name="id_wk" value="<?php echo $id_wk;?>" />
        <?php echo "<input type='hidden' name='id_kelassiswa".$i."' value='".$row['id_kelassiswa']."' />"; ?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><?php echo "<input type='text' name='tempat".$i."' value='".$row['tempat']."'/>"; ?></td>
            <td><?php echo "<input type='text' name='lokasi".$i."' value='".$row['lokasi']."'/>"; ?></td>
            <td><?php echo "<input type='text' name='lama".$i."' value='".$row['lama']."'/>"; ?></td>
            <td><?php
                    echo "<select name='ket".$i."' value='".$row['ket']."'>";
                    echo "<optgroup label='Pilih Akses'>";
                    if ($ket== "Amat Baik") echo "<option value='Amat Baik' selected>Amat Baik</option>";
                    else echo "<option value='Amat Baik'>Amat Baik</option>";
                    if ($ket== "Baik") echo "<option value='Baik' selected>Baik</option>";
                    else echo "<option value='Baik'>Baik</option>";
                    if ($ket== "Cukup") echo "<option value='Cukup' selected>Cukup</option>";
                    else echo "<option value='Cukup'>Cukup</option>";                  
                    "</optgroup>
                    </select>";
                    ?>
                    </td>
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



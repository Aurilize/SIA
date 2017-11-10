<?php 
session_start();
require 'koneksi.php';
?>
<?php
if(isset($_POST['submit'])){   
       $id_kelassiswa = $_POST['id_kelassiswa'];
       $id_wk = $_POST['id_wk'];
       $id_ekstra1 = $_POST['id_ekstra1'];
       $nilai1 = $_POST['nilai1'];
       $id_ekstra2 = $_POST['id_ekstra2'];
       $nilai2 = $_POST['nilai2'];
       $id_ekstra3 = $_POST['id_ekstra3'];
       $nilai3 = $_POST['nilai3'];
       
    
       $query = "UPDATE escoba SET id_ekstra1='$id_ekstra1',nilai1='$nilai1',id_ekstra2='$id_ekstra2',nilai2='$nilai2', id_ekstra3='$id_ekstra3', nilai3='$nilai3' WHERE id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk'";
       $hasil=mysql_query($query);
       if ($query==FALSE){
            die(mysql_error());
    }
    if($hasil){
        ?><script language="javascript">document.location.href="eskul-siswa?id_wk=<?php echo $id_wk;?>&done";</script><?php
    }else{
        ?><script language="javascript">document.location.href="eskul-siswa?id_wk=<?php echo $id_wk;?>&err";</script><?php
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
        <h3 align="center"><b>Ekstrakurikuler</b></h3>
    </div></div><br />
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
        	"SELECT *
            FROM siswa,  
                 kelas_siswa,
                 wali_kelas,
                 escoba, ekstra
            WHERE kelas_siswa.id_siswa=siswa.id_siswa AND 
                  escoba.id_wk='$id_wk' AND 
                  kelas_siswa.id_kelas=(SELECT id_kelas FROM wali_kelas WHERE id_wk='$id_wk') AND 
                  kelas_siswa.id_kelassiswa='$id_kelassiswa' and 
                  wali_kelas.id_tahun=kelas_siswa.id_tahun
                  group by siswa.nama_siswa");

        if ($view==FALSE){
        	die(mysql_error());
        }
while($row=mysql_fetch_array($view)){
            $nama_siswa=$row['nama_siswa'];
            $id_ekstra1=$row['id_ekstra1'];
            $nilai1=$row['nilai1'];
            $id_ekstra2=$row['id_ekstra2'];
            $nilai2=$row['nilai2'];
            $id_ekstra3=$row['id_ekstra3'];
            $nilai3=$row['nilai3'];
        }
        ?>
        <input type="hidden" name="id_wk" value="<?php echo $id_wk;?>" >
        <input type='hidden' name='id_kelassiswa' value="<?php echo $id_kelassiswa;?>">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="password" value="<?php echo $nama_siswa; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="password" value="<?php echo $nama_kelas; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ekstrakurikuler 1</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <?php
                    $hasil=mysql_query("SELECT id_ekstra1 FROM escoba where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk'");
                    $data=mysql_fetch_array($hasil);
                    $id_ekstra1 =$data['id_ekstra1'];
                    ?>
                    <select class="select2_single form-control" name="id_ekstra1">
                        <?php
                            $sql=mysql_query("SELECT nama_ekstra as nam FROM ekstra");
                            while($baris=mysql_fetch_array($sql)){
                            if ($id_ekstra1 == $baris['nam']) {
                            echo '<option value="'.$baris['nam'].'" selected>'.$baris["nam"].'</option>';
                                                    }
                            echo '<option value="'.$baris['nam'].'" >'.$baris["nam"];
                                                    echo '</option>';
                                                    }
                        ?>
                    </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="nilai1">
                    <optgroup label="Pilih Nilai">
                        <?php
                        if ($nilai1== "") echo "<option value='' selected></option>";
                        else echo "<option value=''></option>";
                        if ($nilai1== "Amat Baik") echo "<option value='Amat Baik' selected>Amat Baik</option>";
                        else echo "<option value='Amat Baik'>Amat Baik</option>";
                        if ($nilai1== "Baik") echo "<option value='Baik' selected>Baik</option>";
                        else echo "<option value='Baik'>Baik</option>";
                        if ($nilai1== "Cukup") echo "<option value='Cukup' selected>Cukup</option>";
                        else echo "<option value='Cukup'>Cukup</option>";
                        if ($nilai1== "Kurang") echo "<option value='Kurang' selected>Kurang</option>";
                        else echo "<option value='Kurang'>Kurang</option>";                  
                        ?>
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ekstrakurikuler 2</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <?php 
                    $hasil=mysql_query("SELECT id_ekstra2 FROM escoba where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk'");
                    $data=mysql_fetch_array($hasil);
                    $id_ekstra2 =$data['id_ekstra2'];
                    ?>
                    <select class="select2_single form-control" name="id_ekstra2">
                        <?php
                            $sql=mysql_query("SELECT nama_ekstra as ne FROM ekstra");
                            while($baris=mysql_fetch_array($sql)){
                            if ($id_ekstra2 == $baris['ne']) {
                            echo '<option value="'.$baris['ne'].'" selected>'.$baris["ne"].'</option>';
                                                    }
                            echo '<option value="'.$baris['ne'].'" >'.$baris["ne"];
                                                    echo '</option>';
                                                    }
                        ?>
                    </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="nilai2">
                    <optgroup label="Pilih Nilai">
                        <?php
                        if ($nilai2== "") echo "<option value='' selected></option>";
                        else echo "<option value=''></option>";
                        if ($nilai2== "Amat Baik") echo "<option value='Amat Baik' selected>Amat Baik</option>";
                        else echo "<option value='Amat Baik'>Amat Baik</option>";
                        if ($nilai2== "Baik") echo "<option value='Baik' selected>Baik</option>";
                        else echo "<option value='Baik'>Baik</option>";
                        if ($nilai2== "Cukup") echo "<option value='Cukup' selected>Cukup</option>";
                        else echo "<option value='Cukup'>Cukup</option>";
                        if ($nilai2== "Kurang") echo "<option value='Kurang' selected>Kurang</option>";
                        else echo "<option value='Kurang'>Kurang</option>";                  
                        ?>
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ekstrakurikuler 3</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <?php 
                include_once 'koneksi.php';
                    $id_kelassiswa = $_GET['id_kelassiswa'];
                    $id_wk = $_GET['id_wk'];
                    $hasil=mysql_query("SELECT id_ekstra3 FROM escoba where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk'");
                    $data=mysql_fetch_array($hasil);
                    $id_ekstra3 =$data['id_ekstra3'];
                    ?>
                    <select class="select2_single form-control" name="id_ekstra3">
                        <?php
                            include_once 'koneksi.php';
                            $sql=mysql_query("SELECT nama_ekstra as na FROM ekstra");
                            while($baris=mysql_fetch_array($sql)){
                            if ($id_ekstra3 == $baris['na']) {
                            echo '<option value="'.$baris['na'].'" selected>'.$baris["na"].'</option>';
                                                    }
                            echo '<option value="'.$baris['na'].'" >'.$baris["na"];
                                                    echo '</option>';
                                                    }
                        ?>
                    </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" name="nilai3">
                    <optgroup label="Pilih Nilai">
                        <?php
                        if ($nilai3== "") echo "<option value='' selected></option>";
                        else echo "<option value=''></option>";
                        if ($nilai3== "Amat Baik") echo "<option value='Amat Baik' selected>Amat Baik</option>";
                        else echo "<option value='Amat Baik'>Amat Baik</option>";
                        if ($nilai3== "Baik") echo "<option value='Baik' selected>Baik</option>";
                        else echo "<option value='Baik'>Baik</option>";
                        if ($nilai3== "Cukup") echo "<option value='Cukup' selected>Cukup</option>";
                        else echo "<option value='Cukup'>Cukup</option>";
                        if ($nilai3== "Kurang") echo "<option value='Kurang' selected>Kurang</option>";
                        else echo "<option value='Kurang'>Kurang</option>";                  
                        ?>
                    </optgroup>
                </select>
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
        
        <?php include_once 'page/footer.php'; ?>
        </div>
        <?php include_once 'page/end.php'; ?>
        <?php
    }
        ?>
<?php 
session_start();

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
                                        <div class="clearfix"><div class="title">
        <h3 align="center"><b>Input Praktik Kerja Lapangan</b></h3>
    </div></div><br />
                                    <!-- Smart Wizard -->
                                        <div class="clearfix"></div><br />

<div class="container">
<?php
        
        $id_mengajar=$_GET['id_mengajar'];
        
        $view=mysql_query("SELECT *
            FROM mengajar, 
            guru, 
            mapel, 
            kelas, 
            bobot_tr,
            semester, 
            tahun_ajar 
            where 
            mengajar.id_guru=(SELECT id_guru from guru where nip='$a') and 
            mengajar.id_mapel=mapel.id_mapel and 
            mengajar.id_kelas=kelas.id_kelas and
            mengajar.id_guru=guru.id_guru and 
            mengajar.id_tahun=tahun_ajar.id_tahun and 
            mengajar.id_bobot_tr=bobot_tr.id_bobot_tr and
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
        $b_uh = $ajar['proses'];
        $b_th = $ajar['produk'];
        $b_uts = $ajar['proyek'];
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
            <td><input type="text" class="form-control" name="nama_pelajaran" value="<?php echo $b_uh ?> : <?php echo $b_th?> : <?php echo $b_uts?>"></td>
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


    <form  action="home.php?page=input_nilai_siswa" method="post">
    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>KKM</th>
                <th>Proses</th>
                <th>Produk</th>
                <th>Proyek</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <?php
        $view=mysql_query(
            "SELECT kelas_siswa.id_siswa, siswa.nis, siswa.nama_siswa, mengajar.kb_tr, ketrampilan.pros, ketrampilan.prod, ketrampilan.proy, ((bobot_tr.proses*ketrampilan.pros)+(bobot_tr.produk*ketrampilan.prod)+(bobot_tr.proyek*ketrampilan.proy))/100 AS nilai 
            FROM siswa, mengajar, kelas_siswa, ketrampilan, bobot_tr
            WHERE kelas_siswa.id_siswa=siswa.id_siswa AND 
            kelas_siswa.id_kelas=(SELECT id_kelas FROM mengajar WHERE id_mengajar='$id_mengajar') AND 
            mengajar.id_mengajar='$id_mengajar' AND 
            kelas_siswa.id_kelassiswa=ketrampilan.id_kelassiswa AND 
            bobot_tr.id_bobot_tr=mengajar.id_bobot_tr and
            mengajar.id_mengajar=ketrampilan.id_mengajar 
            group by siswa.nama_siswa");
        if ($view==FALSE){
        	die(mysql_error());
        }

        $i=1;
        while($row=mysql_fetch_array($view)){
        ?>  
        <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['nis'];?></td>
                <td><?php echo $row['nama_siswa'];?></td>
                <td><?php echo $row['kb_tr'];?></td>
                <td><?php echo $row['pros'];?></td>
                <td><?php echo $row['prod'];?></td>
                <td><?php echo $row['proy'];?></td>
                <td><?php echo round($row['nilai']);?> (<?php echo $row['nilai'];?>)</td>
        </tr>
        <?php
            $i++;
        }
            $jumSis = $i-1;
        ?>
        <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" />
        
    </table>
    </div>

</div>

                                        </div>
                                        </form>
                                        
                                        
        <!-- Datatables -->
        
        <?php include_once 'page/footer.php'; ?>
        </div>
        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index");}
?>



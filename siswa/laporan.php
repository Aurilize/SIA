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
        <?php include_once 'page/sidebar1.php'; ?>
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
                                        <div class="x_title">
                                            <h2>Form Wizards <small>Sessions</small></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                    <!-- Smart Wizard -->
                                        <div class="clearfix"></div><br />

<div class="container">
<?php
        
        $id_mengajar=$_GET['id_mengajar'];
        
        $view=mysql_query("SELECT * FROM pengetahuan, pkl, prestasicoba, ketrampilan, guru, mapel, kelas, semester, tahun_ajar 
            where 
            pengetahuan.id_guru=(SELECT id_guru from guru where nip='$a') and 
            pkl.id_mapel=mapel.id_mapel and 
            prestasicoba.id_kelas=kelas.id_kelas and 
            ketrampilan.id_tahun=tahun_ajar.id_tahun and 
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


    <form  action="home.php?page=input_nilai_siswa" method="post">
    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>UH</th>
                <th>TH</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <?php
        $view=mysql_query(
            "SELECT kelas_siswa.id_siswa, 
            siswa.nis, 
            siswa.nama_siswa, 
            mengajar.kb, 
            pengetahuan.uh, 
            pengetahuan.th, 
            pengetahuan.uts,
            pengetahuan.uas, 
            ((bobot_peng.uh*pengetahuan.uh)+(bobot_peng.th*pengetahuan.th)+(bobot_peng.uts*pengetahuan.uts)+(bobot_peng.uas*pengetahuan.uas))/10 AS nilai 
            FROM siswa, mengajar, kelas_siswa, pengetahuan, bobot_peng 
            WHERE kelas_siswa.id_siswa=siswa.id_siswa AND 
            kelas_siswa.id_kelas=(SELECT id_kelas FROM mengajar WHERE id_mengajar='$id_mengajar') AND 
            mengajar.id_mengajar='$id_mengajar' AND 
            kelas_siswa.id_kelassiswa=pengetahuan.id_kelassiswa AND
            mengajar.id_bobot_peng=bobot_peng.id_bobot_peng and 
            mengajar.id_mengajar=pengetahuan.id_mengajar 
            group by siswa.nama_siswa");
        if ($view==FALSE){
            die(mysql_error());
        }

        $i=1;
        while($row=mysql_fetch_array($view)){
        ?>  
        <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['nama_siswa'];?></td>
                <td><?php echo $row['nis'];?></td>
                <td><?php echo $row['uh'];?></td>
                <td><?php echo $row['th'];?></td>
                <td><?php echo $row['uts'];?></td>
                <td><?php echo $row['uas'];?></td>
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
                                        
                                        
        <!-- Datatables -->
        <script src="../js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
                    
                });
        </script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="js/wizard/jquery.smartWizard.js"></script>
        <script type="text/javascript">
        $(document).ready(function () {
            // Smart Wizard     
            $('#wizard').smartWizard();

            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
        });

        $(document).ready(function () {
            // Smart Wizard 
            $('#wizard_verticle').smartWizard({
                transitionEffect: 'slide'
            });

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



<?php 
session_start();
error_reporting(0);
require 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }
        table, th, td. tr {
            border: 1px solid black;
        }
    </style>
</head>
<body>



<?php
$a=$_SESSION['username'];

if(isset($_SESSION["username"])){

require 'koneksi.php';
?>

<script>  
    window.load = print_sk();  
    function print_sk(){  
      window.print();  
    }  
</script>
                            		
<?php
        
        $id_wk=$_GET['id_wk'];
        $id_kelassiswa=$_GET['id_kelassiswa'];
        $id_semester=$_GET['id_semester'];
        
        $view=mysql_query("SELECT *
            FROM siswa, wali_kelas, kelas_siswa, 
            guru,
            kelas,
            semester, 
            tahun_ajar, 
            jurusan 
            where 
            wali_kelas.id_guru=(SELECT id_guru from guru where nip='$a') and 
            wali_kelas.id_kelas=kelas.id_kelas and 
            wali_kelas.id_tahun=tahun_ajar.id_tahun and 
            wali_kelas.id_semester=semester.id_semester and 
            wali_kelas.id_wk='$id_wk' and 
            jurusan.kd_jurusan=kelas.kd_jurusan and 
            siswa.id_siswa=kelas_siswa.id_siswa and 
            kelas_siswa.id_kelassiswa='$id_kelassiswa'
            group by wali_kelas.id_wk
            order by id_wk asc");

        if ($view==FALSE){
            die(mysql_error());
        }

        while($ajar=mysql_fetch_array($view)){

        $nama=$ajar['nama_siswa'];
        $wali=$ajar['nama'];
        $nis=$ajar['nis'];
        $nisn=$ajar['nisn'];
        $nama_kelas=$ajar['nama_kelas'];
        $semester=$ajar['semester'];
        $tahun_ajaran=$ajar['tahun_ajaran'];
        $id_semester=$ajar['id_semester'];
        $nama_jurusan=$ajar['nama_jurusan'];
    }
        
        ?>
        <table>
        <tr>
            <td>Nama Sekolah</td>
            <td>:</td>
            <td><u>SMK Negeri 1 Purwokerto</u></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Kelas</td>
            <td>:</td>
            <td><u><?php echo $nama_kelas; ?></u></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><u>Jl. Dr. Suparno</u></td>
            <td></td>
            <td>Semester</td>
            <td>:</td>
            <td><u><?php echo $semester; ?></u></td>
            <td></td>
        </tr>
        <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td><u><?php echo $nama; ?></u></td>
            <td></td>
            <td>Tahun Ajaran</td>
            <td>:</td>
            <td><u><?php echo $tahun_ajaran; ?></u></td>
            <td></td>
        </tr>
        <tr>
            <td>NIS/NISN</td>
            <td>:</td>
            <td><u><?php echo $nis; ?>/<?php echo $nisn; ?></u></td>
            <td></td>  
        </tr>
        </table>
        <br>

    <table border="1" width="100%">
        <b>Pengetahuan dan Ketrampilan</b>
        <th>No</th>
        <th>Mata Pelajaran</th>
        <th>KB</th>
        <th>Angka</th>
        <th>Predikat</th>
        <th>Deskripsi</th>
        <th>KB</th>
        <th>Angka</th>
        <th>Predikat</th>
        <th>Deskripsi</th>
 <?php
    $a=mysql_query("SELECT mapel.nama_mapel, 
                           mengajar.kb_peng, 
                           pengetahuan.uh, 
                           CASE WHEN uh <= 55 THEN 'C' 
                                WHEN uh >= 56 AND uh <= 85 THEN 'B' 
                                WHEN uh >= '86' THEN 'A' END predikat, 
                           CASE WHEN uh <= 55 THEN 'C' 
                                WHEN uh >= 56 AND uh <= 85 THEN 'Menguasai Materi dengan Baik' 
                                WHEN uh >= '86' THEN 'Menguasai Keseluruhan Materi dengan Sangat Baik' END deskripsi, 
                            mengajar.kb_tr,ketrampilan.proy, 
                            CASE WHEN proy <= 55 THEN 'C' 
                                 WHEN proy >= 56 AND proy <= 85 THEN 'B' 
                                 WHEN proy >= '86' THEN 'A' END predikat1, 
                            CASE WHEN proy <= 55 THEN 'C' 
                                 WHEN proy >= 56 AND uh <= 85 THEN 'Menguasai Dasar Ketrampilan dengan Baik' 
                                 WHEN proy >= '86' THEN 'Menguasai Keseluruhan Ketrampilan dengan Sangat Baik' END deskripsi1 
                            FROM mapel, mengajar, pengetahuan, ketrampilan, semester 
                            WHERE pengetahuan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_mapel=mapel.id_mapel AND 
                                  pengetahuan.id_kelassiswa='$id_kelassiswa' AND 
                                  ketrampilan.id_kelassiswa='$id_kelassiswa' and 
                                  ketrampilan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_semester=semester.id_semester AND 
                                  mengajar.id_semester='$id_semester'");

    if ($a==FALSE){
            die(mysql_error());
        }

        $no=0;

        while($row=mysql_fetch_array($a)){
        ?>  
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_mapel'];?></td>
            <td><?php echo $row['kb_peng'];?></td>
            <td><?php echo $row['uh'];?></td>
            <td><?php echo $row['predikat'];?></td>
            <td><?php echo $row['deskripsi'];?></td>
            <td><?php echo $row['kb_tr'];?></td>
            <td><?php echo $row['proy'];?></td>
            <td><?php echo $row['predikat1'];?></td>
            <td><?php echo $row['deskripsi1'];?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>
    </br>
    PKL
    <table border="1" width="100%">
        <th width="10%">No</th>
        <th width="25%">Tempat</th>
        <th width="15%">Lokasi</th>
        <th width="15%">Lama (bulan)</th>
        <th width="35%">Keterangan</th>
        <?php 
        $b=mysql_query("SELECT * FROM pkl where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk' ");
        $no=0;

        while($row=mysql_fetch_array($b)){
        ?>  
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['tempat'];?></td>
            <td><?php echo $row['lokasi'];?></td>
            <td><?php echo $row['lama'];?></td>
            <td>Melaksanakan PKL dengan <b><?php echo $row['ket'];?></b></td>
        </tr>
        <?php
        }
        ?>
    </table>
    </br>
    Ekstrakurikuler
    <table border="1" width="100%">
        <th width="5%">No</th>
        <th width="40%">Kegiatan Ekstrakurikuler</th>
        <th width="35%">Keterangan</th>
        <?php 
        $b=mysql_query("SELECT * FROM escoba where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk' ");
        $no=0;

        while($row=mysql_fetch_array($b)){
        ?>  
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['id_ekstra1'];?></td>
            <td><?php echo $row['nilai1'];?></td>
        </tr>
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['id_ekstra2'];?></td>
            <td><?php echo $row['nilai2'];?></td>
        </tr>
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['id_ekstra3'];?></td>
            <td><?php echo $row['nilai3'];?></td>
        </tr>
        <?php
        }
        ?>
        
    </table>
    </br>
    Prestasi
    <table border="1" width="100%">
        <th width="5%">No</th>
        <th width="40%">Kegiatan Ekstrakurikuler</th>
        <th width="35%">Keterangan</th>
        <?php 
        $c=mysql_query("SELECT * FROM prestasicoba where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk' ");
        $no=0;

        while($row=mysql_fetch_array($c)){
        ?>  
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['jenis_pres1'];?></td>
            <td><?php echo $row['keterangan1'];?></td>
        </tr>
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['jenis_pres2'];?></td>
            <td><?php echo $row['keterangan2'];?></td>
        </tr>
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['jenis_pres3'];?></td>
            <td><?php echo $row['keterangan3'];?></td>
        </tr>
        <?php
        }
        ?>
        
    </table>
    </br>
    Ketidakhadiran
    <table border="1" width="20%">
        <?php 
        $d=mysql_query("SELECT * FROM ketidakhadiran where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk' ");
        $no=0;

        while($row=mysql_fetch_array($d)){
        ?>  
        <tr>
            <td>Sakit</td>
            <td>: <?php echo $row['sakit'];?> Hari</td>
        </tr>
        <tr>
            <td>Ijin</td>
            <td>: <?php echo $row['ijin'];?> Hari</td>
        </tr>
        <tr>
            <td>Alpa</td>
            <td>: <?php echo $row['alpa'];?> Hari</td>
        </tr>
        <?php
        }
        ?>
        
    </table>

</div>
<br>
<?php
    $e=mysql_fetch_array(mysql_query("SELECT id_semester from wali_kelas"));

    if($e['id_semester']==1){
        echo " ";
        echo "<br>";
    }else{
        echo "<b>Keputusan :</b><br>";
        echo "Berdasarkan hasil yang dicapai pada semester 1 dan 2, peserta didik ditetapkan<br>";
        echo "<br>";
        echo "Naik ke kelas ............. (...............)<br>";
        echo "Tinggal di kelas ........... (...............)<br>";
    }

?>
<?php
    $f=mysql_fetch_array(mysql_query("SELECT * from siswa where id_siswa=(SELECT id_siswa from kelas_siswa where id_kelassiswa='$id_kelassiswa') "));
    $g=mysql_fetch_array(mysql_query("SELECT nip, nama from guru where id_guru=(select id_guru from wali_kelas where id_wk='$id_wk')")); 
    $h=mysql_fetch_array(mysql_query("SELECT * from kepsek where id_tahun='".date(Y)."' "));
?>

<table width="100%">
    <tr>
        <td width="20%">Mengetahui:</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">Purwokerto, <?php echo date("d - m - Y");?></td>
    </tr>
    <tr>
        <td width="20%">Orang Tua/Wali</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">Wali Kelas</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%"><u><?php echo $f['nama_ortu'];?></u></td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%"><u><?php echo $g['nama'];?></u></td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</u></td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">NIP. <?php echo $g['nip'];?></td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">Mengetahui,</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">Kepala Sekolah</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%"><u><?php echo $h['nama_kepsek'];?></u></td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="20%">NIP. <?php echo $h['nip'];?></td>
        <td width="20%">&nbsp;</td>
        <td width="20%">&nbsp;</td>
    </tr>
</table>








                                        </div>
                                        </div>
                                        </div>
        
</body>
</html>
        <?php
}
else {
    header("location:../index");}
?>



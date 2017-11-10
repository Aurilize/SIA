<?php 
session_start();
error_reporting(0);
require 'koneksi.php';
?>

<head>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }
        table, td. tr {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

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
            jurusan,
            tahun_ajar
            where 
            wali_kelas.id_guru=(SELECT id_guru from guru where nip='$a') and 
            wali_kelas.id_kelas=kelas.id_kelas and 
            wali_kelas.id_tahun=tahun_ajar.id_tahun and 
            kelas.kd_jurusan=jurusan.kd_jurusan and
            wali_kelas.id_semester=semester.id_semester and 
            wali_kelas.id_wk='$id_wk' and  
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
            <td><u>Jalan Dr. Soeparno No. 29 Purwokerto 53111</u></td>
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
            <td><u><?php echo $nis; ?> / <?php echo $nisn; ?></u></td>
            <td></td>  
        </tr>
        </table>
        <br>
<div style="page-break-after: always;">
<b>Pengetahuan dan Ketrampilan</b>
    <table border="1" width="100%">
        <thead align="center">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Mata Pelajaran</th>
                <th colspan="4">Pengetahuan</th>
                <th colspan="4">Keterampilan</th>
                <!--<td rowspan="2"><b>No</b></td>
                <td rowspan="2"><b>Mata Pelajaran</b></td>
                <td colspan="4"><b>Pengetahuan</b></td>
                <td colspan="4"><b>Keterampilan</b></td>-->
            </tr>
            <tr>
                <th>KB</th>
                <th>Angka</th>
                <th>Predikat</th>
                <th>Deskripsi</th>
                <th>KB</th>
                <th>Angka</th>
                <th>Predikat</th>
                <th>Deskripsi</th>
                <!--<td><b>KB</b></td>
                <td><b>Angka</b></td>
                <td><b>Predikat</b></td>
                <td><b>Deskripsi</b></td>
                <td><b>KB</b></td>
                <td><b>Angka</b></td>
                <td><b>Predikat</b></td>
                <td><b>Deskripsi</b></td>-->
            </tr>
        </thead>
        <tbody>
            <td colspan="10">Kelompok A</td>
        </tr>
 <?php
    $a=mysql_query("SELECT mapel.nama_mapel, 
                           mengajar.kb_peng, 
                           pengetahuan.uh, 
                            pengetahuan.th, 
                            pengetahuan.uts,
                            pengetahuan.uas, 
                            ((bobot_peng.uh*pengetahuan.uh)+(bobot_peng.th*pengetahuan.th)+(bobot_peng.uts*pengetahuan.uts)+(bobot_peng.uas*pengetahuan.uas))/100 AS nilai,
                           mapel.id_kelompok,
                           
                            ketrampilan.pros, ketrampilan.prod, ketrampilan.proy, ((bobot_tr.proses*ketrampilan.pros)+(bobot_tr.produk*ketrampilan.prod)+(bobot_tr.proyek*ketrampilan.proy))/100 AS nilai2,
                            mengajar.kb_tr
                             
                            FROM mapel, mengajar, pengetahuan, ketrampilan, semester, kelompok, bobot_peng, bobot_tr
                            WHERE pengetahuan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_mapel=mapel.id_mapel AND 
                                  mengajar.id_bobot_peng=bobot_peng.id_bobot_peng and
                                  mengajar.id_bobot_tr=bobot_tr.id_bobot_tr and
                                  pengetahuan.id_kelassiswa='$id_kelassiswa' AND 
                                  ketrampilan.id_kelassiswa='$id_kelassiswa' and 
                                  ketrampilan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_semester=semester.id_semester AND 
                                  mapel.id_kelompok=kelompok.id_kelompok and 
                                  mapel.id_kelompok='1' and
                                  mengajar.id_semester='$id_semester'");

    if ($a==FALSE){
            die(mysql_error());
        }

        $no=0;

        while($row=mysql_fetch_array($a)){
            if ($row[nilai] >= 85) {
                $row[predikat] = 'A';
                $row[deskripsi] = 'Menguasai Keseluruhan Materi dengan Sangat Baik';
            }else if (($row[nilai] < 85)&&($row[nilai] >= 56)) {
                $row[predikat] = 'B';
                $row[deskripsi] = 'Menguasai Keseluruhan Materi dengan  Baik';
            }else{
               $row[predikat] = 'C'; 
               $row[deskripsi] = 'Menguasai Materi dengan Cukup Baik';
            }
            if ($row[nilai2] >= 85) {
                $row[predikat1] = 'A';
                $row[deskripsi1] = 'Menguasai Keseluruhan Materi dengan Sangat Baik';
            }else if (($row[nilai2] < 85)&&($row[nilai] >= 56)) {
                $row[predikat1] = 'B';
                $row[deskripsi1] = 'Menguasai Keseluruhan Materi dengan Baik';
            }else{
               $row[predikat1] = 'C';
               $row[deskripsi1] = 'Menguasai Materi dengan Cukup Baik'; 
            }
        ?>  
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_mapel'];?></td>
            <td align="center"><?php echo $row['kb_peng'];?></td>
            <td align="center"><?php echo round($row['nilai']);?></td>
            <td align="center"><?php echo $row['predikat'];?></td>
            <td><?php echo $row['deskripsi'];?></td>
            <td align="center"><?php echo $row['kb_tr'];?></td>
            <td align="center"><?php echo round($row['nilai2']);?></td>
            <td align="center"><?php echo $row['predikat1'];?></td>
            <td><?php echo $row['deskripsi1'];?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="10">Kelompok B</td>
        </tr>
        <?php
    $b=mysql_query("SELECT mapel.nama_mapel, 
                           mengajar.kb_peng, 
                           pengetahuan.uh, 
                            pengetahuan.th, 
                            pengetahuan.uts,
                            pengetahuan.uas, 
                            ((bobot_peng.uh*pengetahuan.uh)+(bobot_peng.th*pengetahuan.th)+(bobot_peng.uts*pengetahuan.uts)+(bobot_peng.uas*pengetahuan.uas))/100 AS nilai,
                           mapel.id_kelompok,
                           
                            ketrampilan.pros, ketrampilan.prod, ketrampilan.proy, ((bobot_tr.proses*ketrampilan.pros)+(bobot_tr.produk*ketrampilan.prod)+(bobot_tr.proyek*ketrampilan.proy))/100 AS nilai2,
                            mengajar.kb_tr
                             
                            FROM mapel, mengajar, pengetahuan, ketrampilan, semester, kelompok, bobot_peng, bobot_tr
                            WHERE pengetahuan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_mapel=mapel.id_mapel AND 
                                  mengajar.id_bobot_peng=bobot_peng.id_bobot_peng and
                                  mengajar.id_bobot_tr=bobot_tr.id_bobot_tr and
                                  pengetahuan.id_kelassiswa='$id_kelassiswa' AND 
                                  ketrampilan.id_kelassiswa='$id_kelassiswa' and 
                                  ketrampilan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_semester=semester.id_semester AND 
                                  mapel.id_kelompok=kelompok.id_kelompok and 
                                  mapel.id_kelompok='2' and
                                  mengajar.id_semester='$id_semester'");

    if ($b==FALSE){
            die(mysql_error());
        }

        $no=0;

        while($row=mysql_fetch_array($b)){
            if ($row[nilai] >= 85) {
                $row[predikat] = 'A';
                $row[deskripsi] = 'Menguasai Keseluruhan Materi dengan Sangat Baik';
            }else if (($row[nilai] < 85)&&($row[nilai] >= 56)) {
                $row[predikat] = 'B';
                $row[deskripsi] = 'Menguasai Keseluruhan Materi dengan  Baik';
            }else{
               $row[predikat] = 'C'; 
               $row[deskripsi] = 'Menguasai Materi dengan Cukup Baik';
            }
            if ($row[nilai2] >= 85) {
                $row[predikat1] = 'A';
                $row[deskripsi1] = 'Menguasai Keseluruhan Materi dengan Sangat Baik';
            }else if (($row[nilai2] < 85)&&($row[nilai] >= 56)) {
                $row[predikat1] = 'B';
                $row[deskripsi1] = 'Menguasai Keseluruhan Materi dengan Baik';
            }else{
               $row[predikat1] = 'C';
               $row[deskripsi1] = 'Menguasai Materi dengan Cukup Baik'; 
            }
        ?>  
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_mapel'];?></td>
            <td align="center"><?php echo $row['kb_peng'];?></td>
            <td align="center"><?php echo round($row['nilai']);?></td>
            <td align="center"><?php echo $row['predikat'];?></td>
            <td><?php echo $row['deskripsi'];?></td>
            <td align="center"><?php echo $row['kb_tr'];?></td>
            <td align="center"><?php echo round($row['nilai2']);?></td>
            <td align="center"><?php echo $row['predikat1'];?></td>
            <td><?php echo $row['deskripsi1'];?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="10">Kelompok C</td>
        </tr>
        <?php
    $b=mysql_query("SELECT mapel.nama_mapel, 
                           mengajar.kb_peng, 
                           pengetahuan.uh, 
                            pengetahuan.th, 
                            pengetahuan.uts,
                            pengetahuan.uas, 
                            ((bobot_peng.uh*pengetahuan.uh)+(bobot_peng.th*pengetahuan.th)+(bobot_peng.uts*pengetahuan.uts)+(bobot_peng.uas*pengetahuan.uas))/100 AS nilai,
                           mapel.id_kelompok,
                           
                            ketrampilan.pros, ketrampilan.prod, ketrampilan.proy, ((bobot_tr.proses*ketrampilan.pros)+(bobot_tr.produk*ketrampilan.prod)+(bobot_tr.proyek*ketrampilan.proy))/100 AS nilai2,
                            mengajar.kb_tr
                             
                            FROM mapel, mengajar, pengetahuan, ketrampilan, semester, kelompok, bobot_peng, bobot_tr
                            WHERE pengetahuan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_mapel=mapel.id_mapel AND 
                                  mengajar.id_bobot_peng=bobot_peng.id_bobot_peng and
                                  mengajar.id_bobot_tr=bobot_tr.id_bobot_tr and
                                  pengetahuan.id_kelassiswa='$id_kelassiswa' AND 
                                  ketrampilan.id_kelassiswa='$id_kelassiswa' and 
                                  ketrampilan.id_mengajar=mengajar.id_mengajar AND 
                                  mengajar.id_semester=semester.id_semester AND 
                                  mapel.id_kelompok=kelompok.id_kelompok and 
                                  mapel.id_kelompok='3' and
                                  mengajar.id_semester='$id_semester'");

    if ($b==FALSE){
            die(mysql_error());
        }

        $no=0;

        while($row=mysql_fetch_array($b)){
            if ($row[nilai] >= 85) {
                $row[predikat] = 'A';
                $row[deskripsi] = 'Menguasai Keseluruhan Materi dengan Sangat Baik';
            }else if (($row[nilai] < 85)&&($row[nilai] >= 56)) {
                $row[predikat] = 'B';
                $row[deskripsi] = 'Menguasai Keseluruhan Materi dengan  Baik';
            }else{
               $row[predikat] = 'C'; 
               $row[deskripsi] = 'Menguasai Materi dengan Cukup Baik';
            }
            if ($row[nilai2] >= 85) {
                $row[predikat1] = 'A';
                $row[deskripsi1] = 'Menguasai Keseluruhan Materi dengan Sangat Baik';
            }else if (($row[nilai2] < 85)&&($row[nilai] >= 56)) {
                $row[predikat1] = 'B';
                $row[deskripsi1] = 'Menguasai Keseluruhan Materi dengan Baik';
            }else{
               $row[predikat1] = 'C';
               $row[deskripsi1] = 'Menguasai Materi dengan Cukup Baik'; 
            }
        ?>  
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_mapel'];?></td>
            <td align="center"><?php echo $row['kb_peng'];?></td>
            <td align="center"><?php echo round($row['nilai']);?></td>
            <td align="center"><?php echo $row['predikat'];?></td>
            <td><?php echo $row['deskripsi'];?></td>
            <td align="center"><?php echo $row['kb_tr'];?></td>
            <td align="center"><?php echo round($row['nilai2']);?></td>
            <td align="center"><?php echo $row['predikat1'];?></td>
            <td><?php echo $row['deskripsi1'];?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
    </div>
    </br>
    <b>Praktik Kerja Lapangan</b>
    <table border="1" width="100%">
        <th width="10%">No</th>
        <th width="25%">Tempat</th>
        <th width="15%">Lokasi</th>
        <th width="15%">Lama (bulan)</th>
        <th width="35%">Keterangan</th>
        <?php 
        $aa=mysql_query("SELECT * FROM pkl where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk' ");
        $no=0;
        $cek=mysql_num_rows($aa);
        if($cek=='0'){
        ?>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td></td>
                <td align="center"></td>
                <td></td>
                <td></td>
            </tr>
        <?php 
        }else{
            while ($row=mysql_fetch_array($aa)) {
            ?>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td><?php echo $row['tempat'];?></td>
                <td><?php echo $row['lokasi'];?></td>
                <td align="center"><?php echo $row['lama'];?></td>
                <td>Melaksanakan PKL dengan <b><?php echo $row['ket'];?></b></td>
            </tr>
            <?php
        }
        }?>
    </table>
    </br>
    <b>Ekstra Kurikuler</b>
    <table border="1" width="100%">
        <th width="5%">No</th>
        <th width="40%">Kegiatan Ekstrakurikuler</th>
        <th width="35%">Keterangan</th>
        <?php 
        $b=mysql_query("SELECT * FROM escoba where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk' ");
        $no=0;
        $cek=mysql_num_rows($b);
        if($cek=='0'){
        ?>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td></td>
                <td align="center"></td>
            </tr>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td></td>
                <td align="center"></td>
            </tr>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td></td>
                <td align="center"></td>
            </tr>
        <?php 
        }else{
            while ($row=mysql_fetch_array($b)) {
            ?>
            <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['id_ekstra1'];?></td>
            <td align="center"><?php echo $row['nilai1'];?></td>
        </tr>
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['id_ekstra2'];?></td>
            <td align="center"><?php echo $row['nilai2'];?></td>
        </tr>
        <tr>
            <td align="center"><?php echo $no=$no+1;?></td>
            <td><?php echo $row['id_ekstra3'];?></td>
            <td align="center"><?php echo $row['nilai3'];?></td>
        </tr>
            <?php
        }
        }?>
        
    </table>
    </br>
    <b>Prestasi</b>
    <table border="1" width="100%">
        <th width="5%">No</th>
        <th width="40%">Prestasi</th>
        <th width="35%">Keterangan</th>
        <?php 
        $c=mysql_query("SELECT * FROM prestasicoba where id_kelassiswa='$id_kelassiswa' and id_wk='$id_wk' ");
        $no=0;
        $cek=mysql_num_rows($c);
        if($cek=='0'){
        ?>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td></td>
                <td align="center"></td>
            </tr>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td></td>
                <td align="center"></td>
            </tr>
            <tr>
                <td align="center"><?php echo $no=$no+1;?></td>
                <td></td>
                <td align="center"></td>
            </tr>
        <?php 
        }else{
            while ($row=mysql_fetch_array($c)) {
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
        }?>
        
    </table>
    </br>
    <b>Ketidakhadiran</b>
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
    $e=mysql_fetch_array(mysql_query("SELECT id_semester from wali_kelas WHERE id_semester='$id_semester'"));

    if($e['id_semester']=='1'){
        echo " ";
        echo "<br>";
    }else{
        echo "<b>Keputusan :</b><br>";
        echo "Berdasarkan hasil yang dicapai pada semester 1 dan 2, peserta didik ditetapkan<br>";
        echo "<br>";
        echo "Naik ke kelas ............. (...............)<br>";
        echo "Tinggal di kelas ........... (...............)<br><br>";
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
        <!-- Datatables -->
        
        <?php
}
else {
    header("location:../index");}
?>



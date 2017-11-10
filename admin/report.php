<?php
  session_start();
if(isset($_SESSION["username"])){

  ?> 
<?php
// memanggil file config.php
require 'koneksi.php';
?>
<?php include_once 'page/header.php'; ?>
<body class="nav-md">

    <div class="container body">

        <div class="main_container">


<?php include_once 'page/sidebar.php'; ?>
</div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                
                <div class="clearfix"></div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        
                        <div class="x_panel">
                            <div class="title_left">
                                <h3>Nilai Siswa</h3>
                            </div>

                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" method="post">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="flat" name="nisCat"> <b>NIS</b></label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="text" name="nis" size="10">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="flat" name="namaCat"> <b>Nama</b></label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="text" name="nama" size="30">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="checkbox" class="flat" name="kelasCat"> <b>Kelas</b></label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <select name="kelas" class="select2_single col-md-5">
                                                <option value="">Pilih Kelas</option>
                                                    <?php 
                                                        mysql_connect("localhost", "root", "");
                                                        mysql_select_db("smk");
                                                        $result= "SELECT * FROM kelas";
                                                        $hasil= mysql_query($result) or die(mysql_error());
                                                        while ($row=mysql_fetch_array($hasil)){
                                                            echo "<option value='".$row['id_kelas']."'>".$row['nama_kelas']."</option>";
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="checkbox" class="flat" name="tahunCat"> <b>Tahun Ajaran</b></label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <select name="id_tahun" class="select2_single col-md-5">
                                                <option value="">Pilih Tahun Ajaran</option>
                                                    <?php 
                                                        mysql_connect("localhost", "root", "");
                                                        mysql_select_db("smk");
                                                        $result= "SELECT * FROM tahun_ajar";
                                                        $hasil= mysql_query($result) or die(mysql_error());
                                                        while ($row=mysql_fetch_array($hasil)){
                                                            echo "<option value='".$row['id_tahun']."'>".$row['tahun_ajaran']."</option>";
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-4">
                                            <br><button type="submit" class="btn btn-round btn-default" name="submit"><span class="glyphicon glyphicon-search"></span> &nbsp;&nbsp;Cari Data</button>
                                        </div>
                                    </div>

                                </div>
                                </form> 
                                <div class="divider-dashed"></div>
</div>
                            
                                     

                                     <?php

mysql_connect("localhost", "root", "");
mysql_select_db("smk");



$bagianWhere = "";
if (isset($_POST['submit'])){


if (isset($_POST['nisCat']))
{
   $nis = $_POST['nis'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "nis = '$nis'";
   }
}

if (isset($_POST['namaCat']))
{
   $nama = $_POST['nama'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "nama_siswa LIKE '%$nama%'";
   }
   else
   {
        $bagianWhere .= " AND nama_siswa LIKE '%$nama%'";
   }
}

if (isset($_POST['kelasCat']))
{
   $kelas = $_POST['kelas'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "kelas_siswa.id_kelas = '$kelas'";
   }
   else
   {
        $bagianWhere .= " AND kelas_siswa.id_kelas = '$kelas'";
   }
}

if (isset($_POST['tahunCat']))
{
   $id_tahun = $_POST['id_tahun'];
   if (empty($bagianWhere))
   {
        $bagianWhere .= "kelas_siswa.id_tahun = '$id_tahun'";
   }
   else
   {
        $bagianWhere .= " AND kelas_siswa.id_tahun = '$id_tahun'";
   }
}

$query = "SELECT * FROM siswa, tahun_ajar, kelas, kelas_siswa WHERE ".$bagianWhere."AND kelas.id_kelas=kelas_siswa.id_kelas AND tahun_ajar.id_tahun=kelas_siswa.id_tahun AND siswa.id_siswa=kelas_siswa.id_siswa ";
$hasil = mysql_query($query);
echo "<table id='example' table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Tahun Ajaran</th>
                <th>Kelas</th>
                <th>Detail</th>
            </tr>
        </thead>";
        $i=0;
while ($data = mysql_fetch_array($hasil))
{
   echo "<tr><td>"; print($i+1);
   echo "</td><td>".$data['nis']."</td><td>".$data['nama_siswa']."</td><td>".$data['tahun_ajaran']."</td><td>".$data['nama_kelas']."</td><td><a href='det2.php?nis=".$data['id_kelassiswa']."'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='right' title='Klik Detail'>Detail Nilai</button></a></td></tr>";

$i++;
}
echo "</table>";

}

?>


                                
        <!-- Datatables -->
        <script src="js/icheck/icheck.min.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function () {
                $('#example').DataTable();
                    
                });
        </script>

        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index.php");}
?>
        

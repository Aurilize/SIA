<?php 
session_start();
require 'koneksi.php';
?>
<?php
if(isset($_GET['id_wk'])){
    
    $id_wk=$_GET['id_wk'];
    $id_tahun=$_GET['id_tahun'];
    
    $query=mysql_query("select * from pkl where id_wk='$id_wk'");
    if ($query==FALSE){
        	die(mysql_error());
        }
    $cek=mysql_num_rows($query);
    
    if($cek=='0'){
        //kalo belum ada mode input
        ?><script language="javascript">document.location.href="input-pkl?id_wk=<?php echo $id_wk?>&id_tahun=<?php echo $id_tahun ?>";</script><?php
    }else{
        //kalo sudah ada mode update
        ?><script language="javascript">document.location.href="update-pkl?id_wk=<?php echo $id_wk?>&id_tahun=<?php echo $id_tahun ?>";</script><?php
    }
    
}else{
    unset($_POST['id_mengajar']);
}


?>
<?php
$a=$_SESSION['username'];

if(isset($_SESSION["username"])){



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
        <h3 align="center"><b>Pengisian Nilai Praktik Kerja Lapangan</b></h3>
    </div></div><br />

<div class="container">

    <table id="example" table class='table table-bordered responsive-utilities jambo_table'>
        <thead>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
                <th>Isi Nilai</th>
            </tr>
        </thead>
        <?php
        $view=(mysql_query(
        	"SELECT wali_kelas.id_wk, 
        	kelas.nama_kelas,
        	tahun_ajar.tahun_ajaran,
        	semester.semester,
            tahun_ajar.id_tahun 
        	FROM wali_kelas, 
        	kelas, 
        	semester, 
        	tahun_ajar 
        	where 
        	wali_kelas.id_guru=(SELECT id_guru from guru where nip='$a') and 
        	wali_kelas.id_kelas=kelas.id_kelas and 
        	wali_kelas.id_tahun=tahun_ajar.id_tahun and 
        	wali_kelas.id_semester=semester.id_semester 
        	group by wali_kelas.id_wk
        	order by id_wk asc"));

        if ($view==FALSE){
        	die(mysql_error());
        }
        
        $no=0;
        while($row=mysql_fetch_array($view)){
        ?>  
        <tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td><?php echo $row['semester'];?></td>
            <td><?php echo $row['tahun_ajaran'];?></td>
            <td><a href="pkl?id_wk=<?php echo $row['id_wk'];?>&id_tahun=<?php echo $row['id_tahun'];?>" style="text-decoration:underline" title="Pilih Siswa">Daftar Siswa</a></td>
        </tr>
        <?php
        }
        ?>
        
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
        
        <?php include_once 'page/footer.php'; ?>
        </div>
        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index");}
?>


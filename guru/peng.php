<?php
  session_start();
if(isset($_SESSION["username"])){

  ?>
  <?php

include "koneksi.php";

if(isset($_GET['nip'])){
	
	$nip=$_GET['nip'];
	$id_kelassiswa=$_GET['id_kelassiswa'];
	$id_mengajar=$_GET['id_mengajar'];
	$id_bobot=$_GET['id_bobot'];
	
	$query=mysql_query("select * from pengetahuan, mengajar where pengetahuan.id_mengajar=mengajar.id_mengajar and mengajar.nip='$nip' and id_mengajar='$id_mengajar' and id_kelassiswa='$id_pelajaran and id_bobot=$id_bobot'");
	$cek=mysql_num_rows($query);
	
	if($cek=='0'){
		//kalo belum ada mode input
		?><script language="javascript">document.location.href="?page=input_peng&a=<?php echo $nip;?>&b=<?php echo $id_kelassiswa;?>&c=<?php echo $id_mengajar;?>&d=<?php echo $id_bobot;?>";</script><?php
	}else{
		//kalo sudah ada mode update
		?><script language="javascript">document.location.href="?page=input_peng_update&nip=<?php echo $a;?>&b=<?php echo $id_kelassiswa;?>&c=<?php echo $id_mengajar;?>&d=<?php echo $id_bobot;?>";</script><?php
	}
	
}else{
	unset($_POST['username']);
}


?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Input Nilai</h1>
</div>
<!-- end page-heading -->



<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
    <th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
    <th class="topleft"></th>
    <td id="tbl-border-top">&nbsp;</td>
    <th class="topright"></th>
    <th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
    <td id="tbl-border-left"></td>
    <td>
    <!--  start content-table-inner ...................................................................... START -->
    <div id="content-table-inner">
    		
            <?php
			if($_GET['status']=='1'){
			?>
			
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Alhamdulilah sesuatu banget, Data berhasil disimpan :)</td>
                <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
			<?php
			}
			
			if($_GET['status']=='0'){
			?>

            <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="red-left">Yach data gagal di simpan, cape dech!</td>
                <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
			<?php
			}
			?>


      	<!--  start product-table ..................................................................................... -->
        
        <!--  start step-holder -->
		<div id="step-holder">
			<div class="step-no">1</div>
			<div class="step-dark-left">Pilih Mata Pelajaran</div>
			<div class="step-dark-right">&nbsp;</div>
			<div class="step-no-off">2</div>
			<div class="step-light-left">Input Nilai Siswa</div>
			<div class="step-light-right">&nbsp;</div>
			<div class="step-no-off">3</div>
			<div class="step-light-left">Selesai</div>
			<div class="step-light-round">&nbsp;</div>
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
	
        
        
        <form id="mainform" action="">
        <table border="0" width="48%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th width="60%" class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
            <th width="30%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Guru</a></th>
            <th width="30%" class="table-header-repeat line-left minwidth-1"><a href="">Bobot</a></th>
        </tr>
        
        
        <?php
		$nip=$_SESSION['username'];
		$view=mysql_query("SELECT pengetahuan.id_nilai, kelas_siswa.id_kelassiswa, kelas_siswa.nama_kelas, mengajar.id_mengajar from pengetahuan p, mengajar m, kelas_siswa ks, bobot_peng b where p.id_kelassiswa=ks.id_kelassiswa and p.id_mengajar=m.id_mengajar and p.id_bobot=b.id_bobot and m.nip='$nip'");
		
		$no=0;
		while($row=mysql_fetch_row($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><a href="?page=peng&a=<?php echo $nip;?>&b=<?php echo $row['id_kelassiswa'];?>&c=<?php echo $row['id_mengajar'];?>&d=<?php echo $row['id_bobot'];?>" style="text-decoration:underline" title="Pilih Mata Pelajaran"><?php echo $row['nama_mapel'];?></a></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td><?php echo $row['tahun_ajar'];?></td>
        </tr>
		<?php
		}
		?>
        </table>
        <!--  end product-table................................... --> 
        </form>
		
        
        
	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-border-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>

<?php
}
else {
    header("location:../index.php");}
?>

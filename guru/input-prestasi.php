<?php 
session_start();
require 'koneksi.php';
?>
<?php
if(isset($_GET['id_wk'])){
    
    $id_wk=$_GET['id_wk'];
    $id_kelassiswa=$_GET['id_kelassiswa'];
    
    $query=mysql_query("SELECT * from prestasicoba where id_wk='$id_wk' and id_kelassiswa='$id_kelassiswa'");
    if ($query==FALSE){
            die(mysql_error());
        }
    $cek=mysql_num_rows($query);
    
    if($cek=='0'){
        //kalo belum ada mode input
        ?><script language="javascript">document.location.href="input-prestasis?id_wk=<?php echo $id_wk?>&id_kelassiswa=<?php echo $id_kelassiswa?>";</script><?php
    }else{
        //kalo sudah ada mode update
        ?><script language="javascript">document.location.href="update-prestasi?id_wk=<?php echo $id_wk?>&id_kelassiswa=<?php echo $id_kelassiswa?>";</script><?php
    }
    
}else{
    unset($_POST['id_wk']);
}


?>

<?php 
mysql_connect("localhost","root",""); mysql_select_db("ajax");  
$op = $_GET['op'];  
if($op == "ambiloption"){     
	$option = mysql_query("SELECT nik FROM datakaryawan");     
	echo "<option>Pilih NIK</option>\n";     
	while($op = mysql_fetch_array($option)){         
		echo "<option>".$op['nik']."</option>\n";     
	} 
}else if($op == "ambildata"){     
	$nik = $_GET['nik'];     
	$data = mysql_query("SELECT * FROM datakaryawan WHERE nik='$nik'");     
	$d = mysql_fetch_array($data);     
	echo $d['nama']."|".$d['email']."|".$d['alamat'];
}else if($op == "update"){     
	$nik = $_GET['nik'];     
	$nama = htmlspecialchars($_GET['nama']);    
	 $email = htmlspecialchars($_GET['email']);     
	 $alamat = htmlspecialchars($_GET['alamat']);     
	 $update = mysql_query("UPDATE datakaryawan SET nama='$nama', email='$email', alamat='$alamat' WHERE nik='$nik'");     
	 if($update){         
	 	echo "sukses";     
	 }else{         
	 	echo "error";     
	 } 
	}
	else if($op == "delete"){     
		$nik = $_GET['nik'];     
		$del = mysql_query("DELETE FROM datakaryawan WHERE nik='$nik'");     
		if($del){         
			echo "sukses";     
		}else{         
			echo "error";     
		} 
	}else if($op == "tambah"){     
		$nik = $_GET['nik'];     
		$nama = htmlspecialchars($_GET['nama']);     
		$email = htmlspecialchars($_GET['email']);     
		$alamat = htmlspecialchars($_GET['alamat']);     
		$tambah = mysql_query("INSERT INTO datakaryawan VALUES('$nik','$nama','$email','$alamat')");
		if($tambah){         
			echo "sukses";     
		}else{         
			echo "ERROR";     
		} 
	} 
	?>
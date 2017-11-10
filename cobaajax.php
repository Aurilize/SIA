<html>
<head>
<title>Ajax jQuery by Desrizal</title> 
<script type="text/javascript" src="js/jquery.min.js"> 
</script> 
<script> 
var nik; 
var nama; 
var email; 
var alamat; 
var datanya; 
$(document).ready(function(){     
//meloading option NIK dari database     
$("#nik").load("proses.php","op=ambiloption");          
//jika ada event onchange ambil data dari database
$("#nik").change(function(){         
//ambil nilai nik dari form         
nik = $("#nik").val();  
        //tampilkan status loading dan animasinya         
$("#status").html("Loading...");         
$("#loading").show();                  //lakukan pengiriman dan pengambilan data         
$.ajax({         
url: "proses.php",         
data: "op=ambildata&nik="+nik,         
cache: false,         
success: function(msg){             //karna di server pembatas setiap data adalah |             //maka kita split dan akan membentuk array             
data = msg.split("|");                          
//masukkan ke masing-masing textfield
$("#nama").val(data[0]);             
$("#email").val(data[1]);             
$("#alamat").val(data[2]);             //hilangkan status dan animasi loading             
$("#status").html("");             
$("#loading").hide();         
}         
});     
});          //jika tombol update diclick     
$("#tupdate").click(function(){         //ambil nilai-nilai dari masing-masing input         
	nik = $("#nik").val();         
	if(nik=="Pilih NIK"){             
		alert("Pilih dulu NIK");             
		exit();         
		}         
		nama = $("#nama").val();         
		email = $("#email").val();         
		alamat = $("#alamat").val();         
		datanya = "&nik="+nik+"&nama="+nama+"&email="+email;         
		datanya = datanya+"&alamat="+alamat;         //tampilkan status Updating dan animasinya         
		$("#status").html("Lagi diupdate...");         
		$("#loading").show();         
		$.ajax({         
			url: "proses.php",         
			data: "op=update"+datanya,         
			cache: false,         
			success: function(msg){             
				if(msg=="sukses"){                 
					$("#status").html("Update Berhasil...");             
					}else{                 
						$("#status").html("ERROR..");             
						}             
						$("#loading").hide();         
						}         
						});     
						});          //jika tombol DEL diklik     
						$("#tdelete").click(function(){         
							nik = $("#nik").val();         
							if(nik=="Pilih NIK"){             
								alert("Pilih dulu NIK");             
								exit();         
								}         
								$("#status").html("Lagi didelete...");         
								$("#loading").show();         
								$.ajax({         
									url: "proses.php",         
									data: "op=delete&nik="+nik,         
									cache: false,  
									success: function(msg){             
										if(msg=="sukses"){                 
											$("#status").html("Delete Berhasil...");             
											}else{                 
												$("#status").html("ERROR..");             }             
												$("#nama").val("");             
												$("#email").val("");             
												$("#alamat").val("");             
												$("#loading").hide();             
												$("#nik").load("proses.php","op=ambiloption");         }         });     });          //jika link Tambah Data Karyawan diklik     
												$("#formtambah").click(function(){         
												$("#formnik").show();         
												$("#nik2").val("");         
												$("#nama").val("");         
												$("#email").val("");         
												$("#alamat").val("");     });          //jika tombol TAMBAH diklik     
												$("#ttambah").click(function(){         //ambil nilai-nilai dari masing-masing input         
													nik = $("#nik2").val();         
													if(nik==""){             
														alert("NIK belum diisi\nKlik Tambah Data Karyawan");             
														exit();         
													}         
													nama = $("#nama").val();         
													email = $("#email").val();         
													alamat = $("#alamat").val();         
													datanya = "&nik="+nik+"&nama="+nama+"&email="+email;         
													datanya = datanya+"&alamat="+alamat;         
													$("#status").html("Lagi ditambah...");         
													$("#loading").show();         
													$.ajax({         
														url: "proses.php",         
														data: "op=tambah"+datanya,         
														cache: false,         
														success: function(msg){             
															if(msg=="sukses"){                 
																$("#status").html("Berhasil ditambah...");             
															}else{                 
																$("#status").html("ERROR..");             }             
																$("#loading").hide();             
																$("#nik").load("proses.php","op=ambiloption");             
																$("#formnik").hide();             
																$("#nik2").val("");         
															} 
														});     
												}); 
}); 
</script> 

</head> 
<body> 
Nomor Induk Karyawan : <select id="nik"></select>
<br>
<a id="formtambah" style="cursor:pointer;color:red"> 
<u>Tambah Data Karyawan</u></a> 
<p style="display:none" id="formnik"> 
NIK :<br> <input type="text" id="nik2"> 
</p> 
<p> Nama :<br> <input type="text" id="nama"><p> Email :<br> <input type="text" id="email"><p> Alamat :<br> <input type="text" id="alamat" size="30"><p> <button id="tupdate">UPDATE</button> <button id="tdelete">DEL</button> <button id="ttambah">TAMBAH</button> <br> <span id="status"></span> <img src="loading.gif" id="loading" style="display:none"> </body> </html>

<table>
<tr>
<td>1</td>
</tr>
</table>
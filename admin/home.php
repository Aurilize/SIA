<?php 
session_start();
error_reporting(0);
require 'koneksi.php';
?>

<?php
$a=$_SESSION['username'];

if(isset($_SESSION["username"])){

require 'koneksi.php';

include_once 'page/header.php';
?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
        <?php include_once 'page/sidebar.php'; ?>
        
    </div>

        <div class="right_col" role="main">
            <div class="clearfix"></div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                                    <!-- Smart Wizard -->
                            <div class="container">
                            <h3 align="center"><b>SMK NEGERI 1 PURWOKERTO</b></h3>
                            <div class="divider-dashed"></div>
                                <div class="img-container">
                                    <img src="../images/profil3.jpg" alt="Picture" height="300px" width="800px">
                                </div>                                                
                            </div>
                            <div class="divider-dashed"></div>
                            <div class="container">
                                <?php $h=mysql_fetch_array(mysql_query("SELECT * from kepsek where id_tahun='".date(Y)."' ")); ?>
                                <div>
                                    <h2><b>Profil</b></h2>
                                    <h5>Lokasi : Jalan dr. Soeparno No. 29 Purwokerto 53111</h5>
                                    <h5>Email  : <a class="count green"><b>admin@smkn1purwokerto.sch.id</b></a></h5>
                                    <h5>Telepon/Fax : 0281 – 637132 </h5>
                                    <h5>Kepala Sekolah : <?php echo $h['nama_kepsek'];?></h5>
                                    <h5>NIP : <?php echo $h['nip'];?></h5>
                                </div>                                                
                            </div>
                            <div class="divider-dashed"></div>
                                <div class="container">
                                    <?php $h=mysql_fetch_array(mysql_query("SELECT * from kepsek where id_tahun='".date(Y)."' ")); ?>
                                    <div>
                                        <h2 align="center"><b>Motto </b></h2><br>
                                        <h4 align="center" class="count green"><u><b>Mendidik, Mengajar Dengan Hati dan Ketulusan</b></u></h4><br>
                                    </div>                                                
                                </div>
                            <div class="divider-dashed"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                    <!-- Smart Wizard -->
                                <div class="container">
                                    <div> <b><?php echo "Tanggal saat ini <b class='count green'>" .date("d - m - Y") . "<br>"; ?></b></div>
                                    <div class="divider-dashed"></div>
                                    <div>
                                        <div class="animated flipInY tile_stats_count">
                                            <div class="left"></div>
                                                <div class="right">
                                                    <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                                                    <?php $b=mysql_fetch_array(mysql_query("SELECT COUNT(*) as count FROM user")); 
                                                    $count=$b['count'];?>
                                                    <div class="count green"><?php echo $count; ?></div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="divider-dashed"></div>
                                        <div>
                                            <div class="animated flipInY tile_stats_count">
                                                <div class="left"></div>
                                                    <div class="right">
                                                                <span class="count_top"><i class="fa fa-user"></i> Total Guru</span>
                                                                <?php $b=mysql_fetch_array(mysql_query("SELECT COUNT(*) as count FROM guru")); 
                                                                $count=$b['count'];
                                                                ?>
                                                                <div class="count"><?php echo $count; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                <div class="divider-dashed"></div>
                                                <div>
                                                    <div class="animated flipInY tile_stats_count">
                                                        <div class="left"></div>
                                                            <div class="right">
                                                                <span class="count_top"><i class="fa fa-user"></i> Total Siswa</span>
                                                                <?php $b=mysql_fetch_array(mysql_query("SELECT COUNT(*) as count FROM siswa")); 
                                                                $count=$b['count'];
                                                                ?>
                                                                <div class="count"><?php echo $count; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                <div class="divider-dashed"></div>
                                                <div>
                                                    <div class="animated flipInY tile_stats_count">
                                                        <div class="left"></div>
                                                            <div class="right">
                                                                <span class="count_top"><i class="fa fa-user"></i> Total Kelas</span>
                                                                <?php $b=mysql_fetch_array(mysql_query("SELECT COUNT(*) as count FROM kelas")); 
                                                                $count=$b['count'];
                                                                ?>
                                                                <div class="count green"><?php echo $count; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="divider-dashed"></div>
                                                <div>
                                                    <div class="animated flipInY tile_stats_count">
                                                        <div class="left"></div>
                                                            <div class="right">
                                                                <span class="count_top"><i class="fa fa-user"></i> Total Ekstrakurikuler</span>
                                                                <?php $b=mysql_fetch_array(mysql_query("SELECT COUNT(*) as count FROM ekstra")); 
                                                                $count=$b['count'];
                                                                ?>
                                                                <div class="count"><?php echo $count; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="divider-dashed"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>         

        
        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index");}
?>



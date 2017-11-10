<div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="glyphicon glyphicon-education"></i> <span>SINR SMEKON</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                            <ul class="nav side-menu">
                            <li><a href="home"><i class="fa fa-edit"></i> Home </a>
                                </li>                              
                            </ul>
                            </div>
                        <div class="menu_section">
                            <h3>GURU</h3>
                            <ul class="nav side-menu">    
                                <li><a href="u-mengajar"><i class="fa fa-edit"></i> Setting Bobot dan KKM </a>
                                </li>                                 
                            </ul>
                            <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Penilaian<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                <li><a href="nilai-peng"><i class="fa fa-edit"></i> Nilai Pengetahuan </a>
                                </li>
                                <li><a href="nilai-tr"><i class="fa fa-edit"></i> Nilai Keterampilan </a>
                                </li>
                                    </ul>
                                </li>
                                <li><a href="laporan-peng"><i class="fa fa-edit"></i> Laporan Nilai </a>
                                </li>                             
                            </ul>
                            </div>
                        <div class="menu_section">
                            <h3>WALI KELAS</h3>
                            <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Penilaian<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                <li><a href="absen-kelas"><i class="fa fa-edit"></i> Absensi </a>
                                </li>
                                <li><a href="pkl"><i class="fa fa-edit"></i> Nilai PKL </a>
                                </li>
                                <li><a href="prestasi"><i class="fa fa-edit"></i> Nilai Prestasi </a>
                                </li>
                                <li><a href="eskul"><i class="fa fa-edit"></i> Nilai Ekstrakurikuler </a>
                                </li>  
                                    </ul>
                                </li>                               
                                <li><a><i class="fa fa-home"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                    <li><a href="laporan-absen"><i class="fa fa-edit"></i> Laporan Absensi </a>
                                    </li> 
                                    <li><a href="laporan-pkl"><i class="fa fa-edit"></i> Laporan PKL </a>
                                    </li> 
                                    <li><a href="laporan-prestasi"><i class="fa fa-edit"></i> Laporan Prestasi </a>
                                    </li> 
                                    <li><a href="laporan-eskul"><i class="fa fa-edit"></i> Laporan Ekstrakurikuler </a>
                                    </li>
                                    </ul>
                                </li> 
                                <li><a href="cetak-raport"><i class="fa fa-edit"></i> Cetak Raport </a>
                                </li>                           
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!--<div class="sidebar-footer hidden-small right">
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>-->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                             <?php 
                            $a=$_SESSION['username'];
                            require 'koneksi.php';
                            $m=mysql_query("SELECT * FROM guru where nip='$a'");
                            $n=mysql_fetch_array($m);
                            ?>
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i>&nbsp; &nbsp; <?php echo $n['nama']?> &nbsp; &nbsp;
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="pass"><i class="fa fa-gear pull-right"></i> Ubah Password</a></li>
                                    <li><a href="../logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
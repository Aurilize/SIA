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
                            <h3>Menu</h3>
                            <ul class="nav side-menu">
                                <li><a href="home"><i class="fa fa-book"></i> Home </a>    
                                </li>
                                <li><a href="lap-sem"><i class="fa fa-book"></i> Hasil Nilai </a>    
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
                            $m=mysql_query("SELECT * FROM siswa where nis='$a'");
                            $n=mysql_fetch_array($m);
                            ?>
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i>&nbsp; &nbsp; <?php echo $n['nama_siswa']?> &nbsp; &nbsp;
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
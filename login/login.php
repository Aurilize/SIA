<!DOCTYPE html>
<?php  

include "session.php"; ?>
<html>
    <head>
    <?php
        include "smk-fix/page/header.php";
        ?>
    <body >
<center><h1>SISTEM INFORMASI PERPUSTAKAAN</h1></center>

        <div class="form-box" id="login-box">
            <div class="header">Login</div>
          <form action="proses.php" method="post">
                <div class="body bg-gray">
                     <?php error_reporting(0);
                     if ($_GET) {
               
                       $cek=abs((int)$_GET['status']);   if ($cek==2) { ?>
                  <div class="alert alert-danger">
                Maaf,user ID dan password tidak valid 
            </div> <?php 
                }elseif ($cek==1) { ?>
                  <div class="alert alert-danger">
                Maaf,username dan password tidak valid 
            </div> 
               <?php }elseif ($cek!=1 && $cek!=2) {
                   header("location:index.php");}  
                }

              ?>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="login" class="btn bg-olive btn-block">Masuk</button>  
                    
                    
                </div>
            </form>

        </div>

<br><br><br><br><br><br><br><br>
<br><br><br><br>
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>
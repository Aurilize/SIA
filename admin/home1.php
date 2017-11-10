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
    </div>
</div>
<div class="container">a</div>
</body>



                                    
            
        <!-- Datatables -->
        <script type="text/javascript">
            $(document).ready(function(){
                $("#tgl").DatePicker();
            });
        </script>
        
        <?php include_once 'page/end.php'; ?>
        <?php
}
else {
    header("location:../index");}
?>



<?php
error_reporting(0);
session_start();
if (isset($_SESSION['level']))
{

   if ($_SESSION['level'] == "admin")
   {
      echo "<h1>Konten Untuk User</h1>";
   }
   else if ($_SESSION['level'] == "user")
   {
       echo "<h1>Konten Untuk Admin</h1>";
   }
}
?>
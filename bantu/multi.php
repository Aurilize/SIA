<html>
<head>
 <title>Multi Insert</title>
</head>
<body>
 <form method="post" action="multi_insert.php">
  <?php
   for($i=0;$i<$_POST['angka'];$i++){
  ?>
  <input type="text" name="nis<?php echo $i?>" placeholder="NIS"/>
  <input type="text" name="nama<?php echo $i?>" placeholder="Nama"/>
  <br/>
  <?php
   }
  ?>
  <input type="hidden" name="jumlah" value="<?php echo $_POST['angka']?>"/>
  <input type="submit" value="Post"/>
 </form>
</body>
</html>
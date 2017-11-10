<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script> <!-- ini disesuaikan -->
    <script type="text/javascript" src="js/jquery_append.js"></script> <!-- yang ini juga disesuaikan -->
  </head>
  <body>
  <form id="id_form" action="insertotosave.php" method="post">
        <table>
            <tr>
            <td><input type="button" name="add_btn" value="Add" id="add_btn"></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
        </tr>
            <tr>
                <td>No</td><td>NIM</td><td>Nama Depan</td><td>Nama Belakang</td><td>&nbsp;</td>
            </tr>
            <tbody id="container">
<!-- nanti rows nya muncul di sini -->
        </tbody>
        <tr>
            <td><input type="submit" name=submit value="Save"></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
          </tr>
        </table>
    </form>
  </body>
</html>
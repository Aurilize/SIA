<?php
require_once 'db/db.php';
class KepribadianEskul{
  private $conn;

  public function __construct(){
    $database = new Database();
    $db_con = $database->Connect();
    $this->conn = $db_con;
  }
  public function createKepEsk($id_kelassiswa, $kelakuan, $kerapihan, $kerajinan, $sakit, $ijin, $alpa){
    try{
      $stmt = $this->conn->prepare("INSERT INTO kepribadian (id_kepribadian, id_kelassiswa, kelakuan, kerapihan kerajinan, sakit, ijin, alpa, kd_ekstra, kd_ekstra2, kd_ekstra3) VALUES ('', :nis, :semester, :id_kelas, :kd_jurusan, :tahun_ajar, :kelakuan, :$kerapihan, :kerajinan, :sakit, :ijin, :alpa, :kd_ekstra, :kd_ekstra2, :kd_ekstra3)");
        $stmt->bindparam(":id_kelassiswa",$id_kelassiswa);
        $stmt->bindparam(":kelakuan",$kelakuan);
        $stmt->bindparam(":kerapihan",$kerapihan);
        $stmt->bindparam(":kerajinan",$kerajinan);
        $stmt->bindparam(":sakit",$sakit);
        $stmt->bindparam(":ijin",$ijin);
        $stmt->bindparam(":alpa",$alpa);
        $stmt->bindparam(":kd_ekstra",$kd_ekstra);
        $stmt->bindparam(":kd_ekstra2",$kd_ekstra2);
        $stmt->bindparam(":kd_ekstra3",$kd_ekstra3);
        $stmt->execute();
        return true;
    }
    catch(PDOException $e){
      echo $e->getMessage(); 
        return false;
    }
  }
  public function getKepEks($id_kepribadian){
    $stmt = $this->conn->prepare("SELECT * FROM kepribadian WHERE id_kepribadian=:id_kepribadian");
    $stmt->execute(array(":id_kepribadian"=>$id_kepribadian));
      $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
      return $editRow;
  }
  public function updateKep($id_kepribadian, $kelakuan, $kerapihan, $kerajinan, $sakit, $ijin, $alpa){
    try{
      $stmt=$this->conn->prepare("UPDATE kepribadian SET kelakuan=:kelakuan, kerapihan=:kerapihan, kerajinan=:kerajinan, sakit=:sakit, ijin=:ijin, alpa=:alpa WHERE id_kepribadian=:id_kepribadian ");
      $stmt->bindparam(":id_kepribadian",$id_kepribadian);
        $stmt->bindparam(":kelakuan",$kelakuan);
        $stmt->bindparam(":kerapihan",$kerapihan);
        $stmt->bindparam(":kerajinan",$kerajinan);
        $stmt->bindparam(":sakit",$sakit);
        $stmt->bindparam(":ijin",$ijin);
        $stmt->bindparam(":alpa",$alpa);
        $stmt->execute();
        return true;
    }
      catch(PDOException $e){
      echo $e->getMessage(); 
        return false;
    }
  }
  public function updateEks($id_kepribadian, $kelakuan, $kerapihan, $kerajinan, $sakit, $ijin, $alpa){
    try{
      $stmt=$this->conn->prepare("UPDATE kepribadian SET kd_ekstra=:kd_ekstra, kd_ekstra2=:kd_ekstra2, kd_ekstra3=:kd_ekstra3 WHERE id_kepribadian=:id_kepribadian ");
      $stmt->bindparam(":id_kepribadian",$id_kepribadian);
      $stmt->bindparam(":kd_ekstra",$kd_ekstra);
        $stmt->bindparam(":kd_ekstra2",$kd_ekstra2);
        $stmt->bindparam(":kd_ekstra3",$kd_ekstra3);
        $stmt->execute();
        return true;
    }
      catch(PDOException $e){
      echo $e->getMessage(); 
        return false;
    }
  }
  public function deleteKepEks($id_kepribadian){
    $stmt = $this->conn->prepare("DELETE FROM kepribadian WHERE id_kepribadian=:id_kepribadian");
      $stmt->bindparam(":id_kepribadian",$id_kepribadian);
      $stmt->execute();
      return true;
  }
    public function dataview($query){
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    if($stmt->rowCount()>0){
      while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
                <td><?php print($row['id_kepribadian']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td align="center"> 
                <a href="d-pribadi?detail_priskul=<?php print($row['id_kepribadian']); ?>">Detail</a></td>
                <td align="center">
                <a href="u-mengajar?edit_priskul=<?php print($row['id_mengajar']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="t-mengajar.php?delete_mengajar=<?php print($row['id_mengajar']); ?>" onclick="return confirm('Yakin?');"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
            }
        }
        else{
          ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
        }
    }
    public function paging($query,$records_per_page){
      $starting_position=0;
      if(isset($_GET["page_no"])){
        $starting_position=($_GET["page_no"]-1)*$records_per_page;
      }
      $query2=$query." limit $starting_position,$records_per_page";
      return $query2;
    }
    public function paginglink($query,$records_per_page){
      $self = $_SERVER['PHP_SELF'];
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $total_no_of_records = $stmt->rowCount();
      if($total_no_of_records > 0){
        ?>
        <ul class="pagination">
        <?php
        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
        $current_page=1;
        if(isset($_GET["page_no"])){
          $current_page=$_GET["page_no"];
        }
        if($current_page!=1){
          $previous =$current_page-1;
          echo "<li><a href='".$self."?page_no=1'>First</a></li>";
          echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
        }
        for($i=1;$i<=$total_no_of_pages;$i++){
          if($i==$current_page){
            echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
          }else{
            echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
          }
        }
        if($current_page!=$total_no_of_pages){
          $next=$current_page+1;
          echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
          echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
        }
        ?>
        </ul>
        <?php
      }
    }
}
$crud=new KepribadianEskul;
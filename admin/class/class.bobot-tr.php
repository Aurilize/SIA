<?php
require_once '../db/db.php';
class BT{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createBT($proses, $produk, $proyek){
		try{
			$stmt = $this->conn->prepare("INSERT INTO bobot_tr (id_bobot_tr, proses, produk, proyek) 
                VALUES ('', :proses, :produk, :proyek)");
   			$stmt->bindparam(":proses",$proses);
            $stmt->bindparam(":produk",$produk);
            $stmt->bindparam(":proyek",$proyek);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getBT($id_bobot_tr){
		$stmt = $this->conn->prepare("SELECT * FROM bobot_tr WHERE id_bobot_tr=:id_bobot_tr");
		$stmt->execute(array(":id_bobot_tr"=>$id_bobot_tr));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateBT($id_bobot_tr, $proses, $produk, $proyek){
		try{
			$stmt=$this->conn->prepare("UPDATE bobot_tr SET proses=:proses, produk=:produk, proyek=:proyek WHERE id_bobot_tr=:id_bobot_tr ");
			$stmt->bindparam(":id_bobot_tr",$id_bobot_tr);
   			$stmt->bindparam(":proses",$proses);
            $stmt->bindparam(":produk",$produk);
            $stmt->bindparam(":proyek",$proyek);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteBT($id_bobot_tr){
		$stmt = $this->conn->prepare("DELETE FROM bobot_tr WHERE id_bobot_tr=:id_bobot_tr");
  		$stmt->bindparam(":id_bobot_tr",$id_bobot_tr);
  		$stmt->execute();
  		return true;
	}
  	public function dataview($query){
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount()>0){
            $i=1;
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
                <td><?php print $i; ?></td>
                <td style="display: none"><?php print($row['id_bobot_tr']); ?></td>
                <td><?php print($row['proses']); ?></td>
                <td><?php print($row['produk']); ?></td>
                <td><?php print($row['proyek']); ?></td>
                <td align="center">
                <a href="u-bt?edit_bt=<?php print($row['id_bobot_tr']); ?>"><i class="label label-success"> Ubah Data</i></a>
                <td align="center">
                <a href="t-bt?delete_bt=<?php print($row['id_bobot_tr']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
                </td>
                </tr>
                <?php
                $i++;
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
}
$crud=new BT;
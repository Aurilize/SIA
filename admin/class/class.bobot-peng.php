<?php
require_once '../db/db.php';
class BT{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createBT($uh, $th, $uts, $uas){
		try{
			$stmt = $this->conn->prepare("INSERT INTO bobot_peng (id_bobot_peng, uh, th, uts, uas) 
                VALUES ('', :uh, :th, :uts, :uas)");
   			$stmt->bindparam(":uh",$uh);
            $stmt->bindparam(":th",$th);
            $stmt->bindparam(":uts",$uts);
            $stmt->bindparam(":uas",$uas);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getBT($id_bobot_peng){
		$stmt = $this->conn->prepare("SELECT * FROM bobot_peng WHERE id_bobot_peng=:id_bobot_peng");
		$stmt->execute(array(":id_bobot_peng"=>$id_bobot_peng));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateBT($id_bobot_peng, $uh, $th, $uts, $uas){
		try{
			$stmt=$this->conn->prepare("UPDATE bobot_peng SET uh=:uh, th=:th, uts=:uts, uas=:uas WHERE id_bobot_peng=:id_bobot_peng ");
			$stmt->bindparam(":id_bobot_peng",$id_bobot_peng);
   			$stmt->bindparam(":uh",$uh);
            $stmt->bindparam(":th",$th);
            $stmt->bindparam(":uts",$uts);
            $stmt->bindparam(":uas",$uas);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteBT($id_bobot_peng){
		$stmt = $this->conn->prepare("DELETE FROM bobot_peng WHERE id_bobot_peng=:id_bobot_peng");
  		$stmt->bindparam(":id_bobot_peng",$id_bobot_peng);
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
                <td style="display: none"><?php print($row['id_bobot_peng']); ?></td>
                <td><?php print($row['uh']); ?></td>
                <td><?php print($row['th']); ?></td>
                <td><?php print($row['uts']); ?></td>
                <td><?php print($row['uas']); ?></td>
                <td align="center">
                <a href="u-tr?edit_bt=<?php print($row['id_bobot_peng']); ?>"><i class="label label-success"> Ubah Data</i></a>
                <td align="center">
                <a href="t-tr?delete_bt=<?php print($row['id_bobot_peng']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
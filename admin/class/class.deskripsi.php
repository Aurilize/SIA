<?php
require_once '../db/db.php';
class Deskripsi{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createDes($kd_deskripsi, $keterangan){
		try {
        $stmt = $this->conn->prepare("INSERT INTO deskripsi (kd_deskripsi, keterangan)
         VALUES (:kd_deskripsi, :keterangan)");
   			$stmt->bindparam(":kd_deskripsi",$kd_deskripsi);
            $stmt->bindparam(":keterangan",$keterangan);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getDes($kd_deskripsi){
		$stmt = $this->conn->prepare("SELECT * FROM deskripsi WHERE kd_deskripsi=:kd_deskripsi");
		$stmt->execute(array(":kd_deskripsi"=>$kd_deskripsi));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateDes($kd_deskripsi, $keterangan){
		try{
			$stmt=$this->conn->prepare("UPDATE deskripsi SET keterangan=:keterangan WHERE kd_deskripsi=:kd_deskripsi");
			$stmt->bindparam(":kd_deskripsi",$kd_deskripsi);
            $stmt->bindparam(":keterangan",$keterangan);
   		    $stmt->execute();
   		return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   		return false;
		}
	}
	public function deleteDes($kd_deskripsi){
		$stmt = $this->conn->prepare("DELETE FROM deskripsi WHERE kd_deskripsi=:kd_deskripsi");
  	$stmt->bindparam(":kd_deskripsi",$kd_deskripsi);
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
                <td><?php print($row['kd_deskripsi']); ?></td>
                <td><?php print($row['keterangan']); ?></td>
                <td align="center">
                <a href="u-deskripsi?edit_des=<?php print($row['kd_deskripsi']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-deskripsi?delete_des=<?php print($row['kd_deskripsi']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
}
$crud=new Deskripsi;
<?php
require_once '../db/db.php';
class Kelas{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createTahun($tahun_ajaran){
		try{
			$stmt = $this->conn->prepare("INSERT INTO tahun_ajar (id_tahun, tahun_ajaran) VALUES ('', :tahun_ajaran)");
   			$stmt->bindparam(":tahun_ajaran",$tahun_ajaran);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getTahun($id_tahun){
		$stmt = $this->conn->prepare("SELECT * FROM tahun_ajar WHERE id_tahun=:id_tahun");
		$stmt->execute(array(":id_tahun"=>$id_tahun));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateTahun($id_tahun, $tahun_ajaran){
		try{
			$stmt=$this->conn->prepare("UPDATE tahun_ajar SET tahun_ajaran=:tahun_ajaran WHERE id_tahun=:id_tahun ");
			$stmt->bindparam(":id_tahun",$id_tahun);
   			$stmt->bindparam(":tahun_ajaran",$tahun_ajaran);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteTahun($id_tahun){
		$stmt = $this->conn->prepare("DELETE FROM tahun_ajar WHERE id_tahun=:id_tahun");
  		$stmt->bindparam(":id_tahun",$id_tahun);
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
                <td style="display: none"><?php print($row['id_tahun']); ?></td>
                <td><?php print($row['tahun_ajaran']); ?></td>
                <td align="center">
                <a href="u-tahun?edit_tahun=<?php print($row['id_tahun']); ?>"><i class="label label-success"> Ubah Data</i></a>
                <td align="center">
                <a href="t-tahun?delete_tahun=<?php print($row['id_tahun']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Kelas;
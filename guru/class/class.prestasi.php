<?php
require_once '../db/db.php';
class Prestasi{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createPres($id_kelassiswa, $semester, $jenis, $ket){
		try {
        $stmt = $this->conn->prepare("INSERT INTO prestasi (id_prestasi, id_kelassiswa, semester, jenis, ket)
         VALUES ('', :id_kelassiswa, :semester, :jenis, :ket)");
   			$stmt->bindparam(":id_kelassiswa",$id_kelassiswa);
        $stmt->bindparam(":semester",$semester);
   			$stmt->bindparam(":jenis",$jenis);
        $stmt->bindparam(":ket",$ket);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getPres($id_prestasi){
		$stmt = $this->conn->prepare("SELECT * FROM prestasi WHERE id_prestasi=:id_prestasi");
		$stmt->execute(array(":id_prestasi"=>$id_prestasi));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatePres($id_prestasi, $id_kelassiswa, $semester, $jenis, $ket){
		try{
			$stmt=$this->conn->prepare("UPDATE pkl SET id_kelassiswa=:id_kelassiswa, semester=:semester, jenis=:jenis, ket=:ket WHERE id_prestasi=:id_prestasi");
            $stmt->bindparam(":id_prestasi",$id_prestasi);
			      $stmt->bindparam(":id_kelassiswa",$id_kelassiswa);
            $stmt->bindparam(":semester",$semester);
            $stmt->bindparam(":jenis",$jenis);
            $stmt->bindparam(":ket",$ket);
   		      $stmt->execute();
   		return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   		return false;
		}
	}
	public function deletePres($id_prestasi){
		$stmt = $this->conn->prepare("DELETE FROM prestasi WHERE id_prestasi=:id_prestasi");
  	$stmt->bindparam(":id_prestasi",$id_prestasi);
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
                <td><?php print($row['id_prestasi']); ?></td>
                <td><?php print($row['nis']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td><?php print($row['semester']); ?></td>
                <td><?php print($row['jenis']); ?></td>
                <td><?php print($row['ket']); ?></td>
                <td><?php print($row['lama']); ?></td>
                <td><?php print($row['kete']); ?></td>
                <td align="center">
                <a href="u-prestasi?edit_pres=<?php print($row['id_prestasi']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-prestasi?delete_pres=<?php print($row['id_prestasi']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Prestasi;
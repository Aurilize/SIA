<?php
require_once '../db/db.php';
class Pkl{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createPkl($id_kelassiswa, $semester, $nama_pkl, $lokasi, $lama, $keterangan){
		try {
        $stmt = $this->conn->prepare("INSERT INTO pkl (id_pkl, id_kelassiswa, semester, nama_pkl, lokasi, lama, keterangan)
         VALUES ('', :id_kelassiswa, :semester, :nama_pkl, :lokasi, :lama, :keterangan)");
   			$stmt->bindparam(":id_kelassiswa",$id_kelassiswa);
            $stmt->bindparam(":semester",$semester);
   			$stmt->bindparam(":nama_pkl",$nama_pkl);
            $stmt->bindparam(":lokasi",$lokasi);
            $stmt->bindparam(":lama",$lama);
            $stmt->bindparam(":keterangan",$keterangan);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getPkl($id_pkl){
		$stmt = $this->conn->prepare("SELECT * FROM pkl WHERE id_pkl=:id_pkl");
		$stmt->execute(array(":id_pkl"=>$id_pkl));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatePkl($id_pkl,$id_kelassiswa, $semester, $nama_pkl, $lokasi, $lama, $keterangan){
		try{
			$stmt=$this->conn->prepare("UPDATE pkl SET id_kelassiswa=:id_kelassiswa, semester=:semester, nama_pkl=:nama_pkl,
                lokasi=:lokasi, lama=:lama, keterangan=:keterangan WHERE id_pkl=:id_pkl");
            $stmt->bindparam(":id_pkl",$id_pkl);
			$stmt->bindparam(":id_kelassiswa",$id_kelassiswa);
            $stmt->bindparam(":semester",$semester);
            $stmt->bindparam(":nama_pkl",$nama_pkl);
            $stmt->bindparam(":lokasi",$lokasi);
            $stmt->bindparam(":lama",$lama);
            $stmt->bindparam(":keterangan",$keterangan);
   		$stmt->execute();
   		return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   		return false;
		}
	}
	public function deletePkl($id_pkl){
		$stmt = $this->conn->prepare("DELETE FROM pkl WHERE id_pkl=:id_pkl");
  	$stmt->bindparam(":id_pkl",$id_pkl);
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
                <td><?php print($row['id_pkl']); ?></td>
                <td><?php print($row['nis']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td><?php print($row['semester']); ?></td>
                <td><?php print($row['nama_pkl']); ?></td>
                <td><?php print($row['lokasi']); ?></td>
                <td><?php print($row['lama']); ?></td>
                <td><?php print($row['ket']); ?></td>
                <td align="center">
                <a href="u-pkl?edit_pkl=<?php print($row['id_pkl']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-pkl?delete_pkl=<?php print($row['id_pkl']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Pkl;
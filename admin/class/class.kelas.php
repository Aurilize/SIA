<?php
require_once '../db/db.php';
class Kelas{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createKelas($nama_kelas, $kd_jurusan){
		try{
			$stmt = $this->conn->prepare("INSERT INTO kelas (id_kelas, nama_kelas, kd_jurusan) VALUES ('', :nama_kelas, :kd_jurusan)");
   			$stmt->bindparam(":nama_kelas",$nama_kelas);
        $stmt->bindparam(":kd_jurusan",$kd_jurusan);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getkelas($id_kelas){
		$stmt = $this->conn->prepare("SELECT * FROM kelas WHERE id_kelas=:id_kelas");
		$stmt->execute(array(":id_kelas"=>$id_kelas));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatekelas($id_kelas, $nama_kelas, $kd_jurusan){
		try{
			$stmt=$this->conn->prepare("UPDATE kelas SET nama_kelas=:nama_kelas, kd_jurusan=:kd_jurusan WHERE id_kelas=:id_kelas ");
			$stmt->bindparam(":id_kelas",$id_kelas);
   			$stmt->bindparam(":nama_kelas",$nama_kelas);
        $stmt->bindparam(":kd_jurusan",$kd_jurusan);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deletekelas($id_kelas){
		$stmt = $this->conn->prepare("DELETE FROM kelas WHERE id_kelas=:id_kelas");
  		$stmt->bindparam(":id_kelas",$id_kelas);
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
                <td style="display: none"><?php print($row['id_kelas']); ?></td>
                <td><?php print($row['nama_kelas']); ?></td>
                <td><?php print($row['nama_jurusan']); ?></td>
                <td align="center">
                <a href="u-kelas?edit_kelas=<?php print($row['id_kelas']); ?>"><i class="label label-success"> Ubah Data</i></a>
                <td align="center">
                <a href="t-kelas?delete_kelas=<?php print($row['id_kelas']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
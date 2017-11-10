<?php
require_once '../db/db.php';
class Nilai{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createNilai($id_kelassiswa, $id_mengajar, $bobot_th, $th1, $th2, $th3, $bobot_uh, $$uh1, $uh2, $uh3, $uh4, $uh5, $uts, $uas, $nh, ){
		try{
			$stmt = $this->conn->prepare("INSERT INTO nilai (kd_jurusan, nama_jurusan) VALUES (:kd_jurusan, :nama_jurusan)");
			$stmt->bindparam(":kd_jurusan",$kd_jurusan);
   			$stmt->bindparam(":nama_jurusan",$nama_jurusan);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getjurusan($kd_jurusan){
		$stmt = $this->conn->prepare("SELECT * FROM jurusan WHERE kd_jurusan=:kd_jurusan");
		$stmt->execute(array(":kd_jurusan"=>$kd_jurusan));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatejurusan($kd_jurusan, $nama_jurusan){
		try{
			$stmt=$this->conn->prepare("UPDATE jurusan SET nama_jurusan=:nama_jurusan WHERE kd_jurusan=:kd_jurusan ");
			$stmt->bindparam(":kd_jurusan",$kd_jurusan);
   			$stmt->bindparam(":nama_jurusan",$nama_jurusan);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deletejurusan($kd_jurusan){
		$stmt = $this->conn->prepare("DELETE FROM jurusan WHERE kd_jurusan=:kd_jurusan");
  		$stmt->bindparam(":kd_jurusan",$kd_jurusan);
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
                <td><?php print($row['kd_jurusan']); ?></td>
                <td><?php print($row['nama_jurusan']); ?></td>
                <td align="center">
                <a href="u-jurusan?edit_jurusan=<?php print($row['kd_jurusan']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-jurusan?delete_jurusan=<?php print($row['kd_jurusan']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Nilai;
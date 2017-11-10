<?php
require_once '../db/db.php';
class Mengajar{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createAkun($id_guru, $id_mapel, $id_kelas, $id_semester, $id_tahun){
		try{
			$stmt = $this->conn->prepare("INSERT INTO mengajar (id_mengajar, id_guru, id_mapel, id_kelas, id_semester, id_tahun) 
        VALUES ('', :id_guru, :id_mapel, :id_kelas, :id_semester, :id_tahun)");
   			$stmt->bindparam(":id_guru",$id_guru);
   			$stmt->bindparam(":id_mapel",$id_mapel);
        $stmt->bindparam(":id_kelas",$id_kelas);
        $stmt->bindparam(":id_semester",$id_semester);
        $stmt->bindparam(":id_tahun",$id_tahun);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getmengajar($id_mengajar){
		$stmt = $this->conn->prepare("SELECT * FROM mengajar WHERE id_mengajar=:id_mengajar");
		$stmt->execute(array(":id_mengajar"=>$id_mengajar));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatemengajar($id_mengajar, $id_guru, $id_mapel, $id_kelas, $id_semester, $id_tahun){
		try{
			$stmt=$this->conn->prepare("UPDATE mengajar SET id_guru=:id_guru, id_mapel=:id_mapel, id_kelas=:id_kelas, id_semester=:id_semester, id_tahun=:id_tahun WHERE id_mengajar=:id_mengajar ");
			$stmt->bindparam(":id_mengajar",$id_mengajar);
   			$stmt->bindparam(":id_guru",$id_guru);
        $stmt->bindparam(":id_mapel",$id_mapel);
        $stmt->bindparam(":id_kelas",$id_kelas);
        $stmt->bindparam(":id_semester",$id_semester);
        $stmt->bindparam(":id_tahun",$id_tahun);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteMengajar($id_mengajar){
		$stmt = $this->conn->prepare("DELETE FROM mengajar WHERE id_mengajar=:id_mengajar");
  		$stmt->bindparam(":id_mengajar",$id_mengajar);
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
                <td style="display: none"><?php print($row['id_mengajar']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama_kelas']); ?></td>
                <td align="center"><?php print($row['semester']); ?></td>
                <td><?php print($row['tahun_ajaran']); ?></td>
                <td align="center">
                <a href="u-mengajar?edit_mengajar=<?php print($row['id_mengajar']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-mengajar.php?delete_mengajar=<?php print($row['id_mengajar']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Mengajar;
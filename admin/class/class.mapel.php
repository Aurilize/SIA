<?php
require_once '../db/db.php';
class Mapel{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createMapel($nama_mapel, $id_kelompok){
		try{
			$stmt = $this->conn->prepare("INSERT INTO mapel (id_mapel, nama_mapel, id_kelompok) VALUES ('', :nama_mapel, :id_kelompok)");
			
   			$stmt->bindparam(":nama_mapel",$nama_mapel);
        $stmt->bindparam(":id_kelompok",$id_kelompok);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getMapel($id_mapel){
		$stmt = $this->conn->prepare("SELECT * FROM mapel WHERE id_mapel=:id_mapel");
		$stmt->execute(array(":id_mapel"=>$id_mapel));
  	$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  	return $editRow;
	}
	public function updateMapel($id_mapel, $nama_mapel, $id_kelompok){
		try{
			$stmt=$this->conn->prepare("UPDATE mapel SET nama_mapel=:nama_mapel, id_kelompok=:id_kelompok WHERE id_mapel=:id_mapel ");
			$stmt->bindparam(":id_mapel",$id_mapel);
      $stmt->bindparam(":nama_mapel",$nama_mapel);
      $stmt->bindparam(":id_kelompok",$id_kelompok);
   		$stmt->execute();
   		return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteMapel($id_mapel){
    $stmt = $this->conn->prepare("DELETE FROM mapel WHERE id_mapel=:id_mapel");
  	$stmt->bindparam(":id_mapel",$id_mapel);
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
                <td style="display: none"><?php print($row['id_mapel']); ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama_kelompok']); ?> - <?php print($row['keterangan']); ?></td>
                <td align="center">
                <a href="u-mapel?edit_mapel=<?php print($row['id_mapel']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-mapel?delete_mapel=<?php print($row['id_mapel']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Mapel;
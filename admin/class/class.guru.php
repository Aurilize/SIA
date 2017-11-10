<?php
require_once '../db/db.php';
class Guru{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createGuru($nip, $nama, $tempat_lahir, $tgl_lahir, $jk){
		try{
			$stmt = $this->conn->prepare("INSERT INTO guru (id_guru, nip, nama, tempat_lahir, tgl_lahir, jk) VALUES ('', :nip, :nama, :tempat_lahir, :tgl_lahir, :jk)");
        
        $stmt->bindparam(":nip",$nip);
   			$stmt->bindparam(":nama",$nama);
        $stmt->bindparam(":tempat_lahir",$tempat_lahir);
        $stmt->bindparam(":tgl_lahir",$tgl_lahir);
        $stmt->bindparam(":jk",$jk);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
  public function createUserG($nip){
    try{
      $stmt = $this->conn->prepare("INSERT INTO user (id_user, username, password, level) VALUES ('', :nip, :nip, 'Guru')");
        
        $stmt->bindparam(":nip",$nip);
        $stmt->execute();
        return true;
    }
    catch(PDOException $e){
      echo $e->getMessage(); 
        return false;
    }
  }
	public function getID($id_guru){
		$stmt = $this->conn->prepare("SELECT * FROM guru WHERE id_guru=:id_guru");
		$stmt->execute(array(":id_guru"=>$id_guru));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateGuru($id_guru, $nip, $nama, $tempat_lahir, $tgl_lahir, $jk){
		try{
			$stmt=$this->conn->prepare("UPDATE guru SET nip=:nip, nama=:nama, tempat_lahir=:tempat_lahir, tgl_lahir=:tgl_lahir, jk=:jk WHERE id_guru=:id_guru");
			$stmt->bindparam(":id_guru",$id_guru);
            $stmt->bindparam(":nip",$nip);
   			$stmt->bindparam(":nama",$nama);
            $stmt->bindparam(":tempat_lahir",$tempat_lahir);
            $stmt->bindparam(":tgl_lahir",$tgl_lahir);
            $stmt->bindparam(":jk",$jk);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteGuru($id_guru){
		$stmt = $this->conn->prepare("DELETE FROM guru WHERE id_guru=:id_guru");
  		$stmt->bindparam(":id_guru",$id_guru);
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
                <td style="display: none"><?php print($row['id_guru']); ?></td>
                <td><?php print($row['nip']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td><?php print($row['jk']); ?></td>
                <td><?php print($row['tempat_lahir']); ?></td>
                <td><?php print($row['tgl_lahir']); ?></td>
                <td align="center">
                <a href="u-guru?edit_guru=<?php print($row['id_guru']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-guru?delete_guru=<?php print($row['id_guru']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Guru;
<?php
require_once '../db/db.php';
class Ekstrakulikuler{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createEkstra($nama_ekstra){
		try{
			$stmt = $this->conn->prepare("INSERT INTO ekstra (id_ekstra, nama_ekstra) VALUES ('', :nama_ekstra)");
   			$stmt->bindparam(":nama_ekstra",$nama_ekstra);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getUser($id_ekstra){
		$stmt = $this->conn->prepare("SELECT * FROM ekstra WHERE id_ekstra=:id_ekstra");
		$stmt->execute(array(":id_ekstra"=>$id_ekstra));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateUser($id_ekstra, $nama_ekstra){
		try{
			$stmt=$this->conn->prepare("UPDATE ekstra SET nama_ekstra=:nama_ekstra WHERE id_ekstra=:id_ekstra");
			  $stmt->bindparam(":id_ekstra",$id_ekstra);
        $stmt->bindparam(":nama_ekstra",$nama_ekstra);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteUser($id_ekstra){
		$stmt = $this->conn->prepare("DELETE FROM ekstra WHERE id_ekstra=:id_ekstra");
  		$stmt->bindparam(":id_ekstra",$id_ekstra);
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
                <td style="display: none"><?php print($row['id_ekstra']); ?></td>
                <td><?php print($row['nama_ekstra']); ?></td>
                <td align="center">
                <a href="u-ekstra.php?edit_ekstra=<?php print($row['id_ekstra']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-ekstra.php?delete_ekstra=<?php print($row['id_ekstra']); ?>" onclick="return confirm('Apakah Anda yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Ekstrakulikuler;
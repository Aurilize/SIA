<?php
require_once '../db/db.php';
class Kelompok{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function addKelompok($nama_kelompok, $keterangan){
    try{
        $stmt = $this->conn->prepare("INSERT INTO kelompok (id_kelompok, nama_kelompok, keterangan) VALUES ('', :nama_kelompok, :keterangan)");
        $stmt->bindparam(":nama_kelompok",$nama_kelompok);
        $stmt->bindparam(":keterangan",$keterangan);
        $stmt->execute();
        return true;
    }
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getkelompok($id_kelompok){
		$stmt = $this->conn->prepare("SELECT * FROM kelompok WHERE id_kelompok=:id_kelompok");
		$stmt->execute(array(":id_kelompok"=>$id_kelompok));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatekelompok($id_kelompok, $nama_kelompok, $keterangan){
		try{
			$stmt=$this->conn->prepare("UPDATE kelompok SET nama_kelompok=:nama_kelompok, keterangan=:keterangan WHERE id_kelompok=:id_kelompok ");
			$stmt->bindparam(":id_kelompok",$id_kelompok);
            $stmt->bindparam(":nama_kelompok",$nama_kelompok);
            $stmt->bindparam(":keterangan",$keterangan);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deletekelompok($id_kelompok){
		$stmt = $this->conn->prepare("DELETE FROM kelompok WHERE id_kelompok=:id_kelompok");
  		$stmt->bindparam(":id_kelompok",$id_kelompok);
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
				<tr>    <td><?php print $i;; ?></td>
                <td style="display: none"><?php print($row['id_kelompok']); ?></td>
                <td><?php print($row['nama_kelompok']); ?></td>
                <td><?php print($row['keterangan']); ?></td>
                <td align="center">
                <a href="u-kelompok?edit_kelompok=<?php print($row['id_kelompok']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-kelompok?delete_kelompok=<?php print($row['id_kelompok']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Kelompok;
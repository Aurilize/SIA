<?php
require_once '../db/db.php';
class Pkl{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createkepsek($nip, $nama_kepsek, $id_tahun){
		try {
        $stmt = $this->conn->prepare("INSERT INTO kepsek (id_kepsek, nip, nama_kepsek, id_tahun)
         VALUES ('', :nip, :nama_kepsek, :id_tahun)");
            $stmt->bindparam(":nip",$nip);
   			    $stmt->bindparam(":nama_kepsek",$nama_kepsek);
            $stmt->bindparam(":id_tahun",$id_tahun);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getkepsek($id_kepsek){
		$stmt = $this->conn->prepare("SELECT * FROM kepsek WHERE id_kepsek=:id_kepsek");
		$stmt->execute(array(":id_kepsek"=>$id_kepsek));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateKepsek($id_kepsek,$nip, $nama_kepsek, $id_tahun){
		try{
			$stmt=$this->conn->prepare("UPDATE kepsek SET nip=:nip, nama_kepsek=:nama_kepsek,
                id_tahun=:id_tahun WHERE id_kepsek=:id_kepsek");
            $stmt->bindparam(":id_kepsek",$id_kepsek);
            $stmt->bindparam(":nip",$nip);
            $stmt->bindparam(":nama_kepsek",$nama_kepsek);
            $stmt->bindparam(":id_tahun",$id_tahun);
   		$stmt->execute();
   		return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   		return false;
		}
	}
	public function deletekepsek($id_kepsek){
		$stmt = $this->conn->prepare("DELETE FROM kepsek WHERE id_kepsek=:id_kepsek");
  	$stmt->bindparam(":id_kepsek",$id_kepsek);
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
                <td style="display: none"><?php print($row['id_kepsek']); ?></td>
                <td><?php print($row['nip']); ?></td>
                <td><?php print($row['nama_kepsek']); ?></td>
                <td><?php print($row['id_tahun']); ?></td>
                <td align="center">
                <a href="u-kepsek?edit_kepsek=<?php print($row['id_kepsek']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-kepsek?delete_kepsek=<?php print($row['id_kepsek']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Pkl;
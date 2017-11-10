<?php
require_once '../db/db.php';
class Siswa{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createsiswa($nis, $nisn, $nama_siswa, $nama_ortu, $alamat, $tempat_lahir, $tgl_lahir, $jk){
		try {
        $stmt = $this->conn->prepare("INSERT INTO siswa (id_siswa, nis, nisn, nama_siswa, nama_ortu, alamat, tempat_lahir, tgl_lahir, jk)
         VALUES ('', :nis, :nisn, :nama_siswa, :nama_ortu, :alamat, :tempat_lahir, :tgl_lahir, :jk)");
   			$stmt->bindparam(":nis",$nis);
            $stmt->bindparam(":nisn",$nisn);
   			$stmt->bindparam(":nama_siswa",$nama_siswa);
            $stmt->bindparam(":nama_ortu",$nama_ortu);
            $stmt->bindparam(":alamat",$alamat);
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
  public function createUserG($nis){
    try{
      $stmt = $this->conn->prepare("INSERT INTO user (id_user, username, password, level) VALUES ('', :nis, :nis, 'Siswa')");
        
        $stmt->bindparam(":nis",$nis);
        $stmt->execute();
        return true;
    }
    catch(PDOException $e){
      echo $e->getMessage(); 
        return false;
  }
  } 
	public function getNis($id_siswa){
		$stmt = $this->conn->prepare("SELECT * FROM siswa WHERE id_siswa=:id_siswa");
		$stmt->execute(array(":id_siswa"=>$id_siswa));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatesiswa($id_siswa, $nis, $nisn, $nama_siswa, $nama_ortu, $alamat, $tempat_lahir, $tgl_lahir, $jk){
		try{
			$stmt=$this->conn->prepare("UPDATE siswa SET nis=:nis, nisn=:nisn, nama_siswa=:nama_siswa, nama_ortu=:nama_ortu, alamat=:alamat,
                tempat_lahir=:tempat_lahir, tgl_lahir=:tgl_lahir, jk=:jk WHERE id_siswa=:id_siswa");
            $stmt->bindparam(":id_siswa",$id_siswa);
			      $stmt->bindparam(":nis",$nis);
            $stmt->bindparam(":nisn",$nisn);
   		      $stmt->bindparam(":nama_siswa",$nama_siswa);
            $stmt->bindparam(":nama_ortu",$nama_ortu);
            $stmt->bindparam(":alamat",$alamat);
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
	public function deleteSiswa($id_siswa){
		$stmt = $this->conn->prepare("DELETE FROM siswa WHERE id_siswa=:id_siswa");
  	$stmt->bindparam(":id_siswa",$id_siswa);
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
                <td style="display: none"><?php print($row['id_siswa']); ?></td>
                <td><?php print($row['nis']); ?></td>
                <td><?php print($row['nisn']); ?></td>
                <td><?php print($row['nama_siswa']); ?></td>
                <td><?php print($row['jk']); ?></td>
                <td><?php print($row['nama_ortu']); ?></td>
                <td><?php print($row['alamat']); ?></td>
                <td><?php print($row['tempat_lahir']); ?></td>
                <td><?php print($row['tgl_lahir']); ?></td>
                <td align="center">
                <a href="u-siswa?edit_nis=<?php print($row['id_siswa']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-siswa?delete_nis=<?php print($row['id_siswa']); ?>" onclick="return confirm('Apakah Anda Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Siswa;
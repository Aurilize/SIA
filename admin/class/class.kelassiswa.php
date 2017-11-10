<?php
require_once '../db/db.php';
class Kelas{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function addKelasSiswa($id_siswa, $id_kelas, $id_tahun){
    try{
    	$stmt = $this->conn->prepare("INSERT INTO kelas_siswa (id_kelassiswa, id_siswa, id_kelas, id_tahun) 
    		VALUES ('', :id_siswa, :id_kelas, :id_tahun)");
        $stmt->bindparam(":id_siswa",$id_siswa);
        $stmt->bindparam(":id_kelas",$id_kelas);
        $stmt->bindparam(":id_tahun",$id_tahun);
        $stmt->execute();
        return true;
    }
    catch(PDOException $e){
    	echo $e->getMessage(); 
    	return false;
    }
}
    public function getID($id_kelassiswa){
		$stmt = $this->conn->prepare("SELECT * FROM kelas_siswa WHERE id_kelassiswa=:id_kelassiswa");
		$stmt->execute(array(":id_kelassiswa"=>$id_kelassiswa));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatesiswa($id_kelassiswa, $id_siswa, $id_kelas, $id_tahun){
		try{
			$stmt=$this->conn->prepare("UPDATE kelas_siswa SET id_siswa=:id_siswa, id_kelas=:id_kelas, id_tahun=:id_tahun WHERE id_kelassiswa=:id_kelassiswa");
			$stmt->bindparam(":id_kelassiswa",$id_kelassiswa);
            $stmt->bindparam(":id_siswa",$id_siswa);
            $stmt->bindparam(":id_kelas",$id_kelas);
            $stmt->bindparam(":id_tahun",$id_tahun);
            $stmt->execute();
   		return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   		return false;
		}
	}
	public function deletekelassiswa($id_kelassiswa){
		$stmt = $this->conn->prepare("DELETE FROM kelas_siswa WHERE id_kelassiswa=:id_kelassiswa");
  	$stmt->bindparam(":id_kelassiswa",$id_kelassiswa);
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
                <td style="display: none"><?php print($row['id_kelassiswa']); ?></td>
                <td><?php print($row['nis']); ?></td>
                <td><?php print($row['nama_siswa']); ?></td>
                <td><?php print($row['nama_kelas']); ?></td>
                <td><?php print($row['tahun_ajaran']); ?></td>
                <td align="center">
                <a href="u-kelassiswa?edit_ks=<?php print($row['id_kelassiswa']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-kelassiswa?delete_ks=<?php print($row['id_kelassiswa']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger"> Hapus</i></a>
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
    public function paging($query,$records_per_page){
    	$starting_position=0;
    	if(isset($_GET["page_no"])){
    		$starting_position=($_GET["page_no"]-1)*$records_per_page;
    	}
    	$query2=$query." limit $starting_position,$records_per_page";
    	return $query2;
    }
    public function paginglink($query,$records_per_page){
    	$self = $_SERVER['PHP_SELF'];
    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();
    	$total_no_of_records = $stmt->rowCount();
    	if($total_no_of_records > 0){
    		?>
    		<ul class="pagination">
    		<?php
    		$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
    		$current_page=1;
    		if(isset($_GET["page_no"])){
    			$current_page=$_GET["page_no"];
    		}
    		if($current_page!=1){
    			$previous =$current_page-1;
    			echo "<li><a href='".$self."?page_no=1'>First</a></li>";
    			echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
    		}
    		for($i=1;$i<=$total_no_of_pages;$i++){
    			if($i==$current_page){
    				echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
    			}else{
    				echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
    			}
    		}
    		if($current_page!=$total_no_of_pages){
    			$next=$current_page+1;
    			echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
    			echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
    		}
    		?>
    		</ul>
    		<?php
    	}
    }
}
$crud=new Kelas;

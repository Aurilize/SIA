<?php
require_once '../db/db.php';
class Admin{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function createUser($username, $password, $level){
		try{
			$stmt = $this->conn->prepare("INSERT INTO user (id_user, username, password, level) VALUES ('',:username, :password, :level)");
			$stmt->bindparam(":username",$username);
   			$stmt->bindparam(":password",$password);
   			$stmt->bindparam(":level",$level);
   			$stmt->execute();
   			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function getUser($id_user){
		$stmt = $this->conn->prepare("SELECT * FROM user WHERE id_user=:id_user");
		$stmt->execute(array(":id_user"=>$id_user));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updateUser($id_user, $password, $level){
		try{
			$stmt=$this->conn->prepare("UPDATE user SET password=:password, level=:level WHERE id_user=:id_user");
			  $stmt->bindparam(":id_user",$id_user);
   			$stmt->bindparam(":password",$password);
   			$stmt->bindparam(":level",$level);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
	public function deleteUser($id_user){
		$stmt = $this->conn->prepare("DELETE FROM user WHERE id_user=:id_user");
  		$stmt->bindparam(":id_user",$id_user);
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
				<tr>    <td><?php print $i; ?></td>
                <td style="display: none"><?php print($row['id_user']); ?></td>
                <td><?php print($row['username']); ?></td>
                <td><?php print md5($row['password']); ?></td>
                <td><?php print($row['level']); ?></td>
                <td align="center">
                <a href="u-admin.php?edit_user=<?php print($row['id_user']); ?>"><i class="label label-success"> Ubah Data</i></a>
                </td>
                <td align="center">
                <a href="t-admin.php?delete_user=<?php print($row['id_user']); ?>" onclick="return confirm('Apakah Anda yakin?');"><i class="label label-danger"> Hapus</i></a>
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
$crud=new Admin;
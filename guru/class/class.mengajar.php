<?php
require_once '../db/db.php';
class Mengajar{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
	public function getmengajar($id_mengajar){
		$stmt = $this->conn->prepare("SELECT * FROM mengajar WHERE id_mengajar=:id_mengajar");
		$stmt->execute(array(":id_mengajar"=>$id_mengajar));
  		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  		return $editRow;
	}
	public function updatemengajar($id_mengajar, $kb_peng, $kb_tr, $id_bobot_peng, $id_bobot_tr){
		try{
			$stmt=$this->conn->prepare("UPDATE mengajar SET kb_peng=:kb_peng, kb_tr=:kb_tr, id_bobot_peng=:id_bobot_peng, id_bobot_tr=:id_bobot_tr WHERE id_mengajar=:id_mengajar ");
			$stmt->bindparam(":id_mengajar",$id_mengajar);
   			$stmt->bindparam(":kb_peng",$kb_peng);
        $stmt->bindparam(":kb_tr",$kb_tr);
        $stmt->bindparam(":id_bobot_peng",$id_bobot_peng);
        $stmt->bindparam(":id_bobot_tr",$id_bobot_tr);
   			$stmt->execute();
   			return true;
		}
   		catch(PDOException $e){
			echo $e->getMessage(); 
   			return false;
		}
	}
}
$crud=new Mengajar;
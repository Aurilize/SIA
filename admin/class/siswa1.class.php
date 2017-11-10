<?php
require_once '../db/db.php';
class NSiswa{
	private $conn;

	public function __construct(){
		$database = new Database();
		$db_con = $database->Connect();
		$this->conn = $db_con;
	}
    public function DataView($query){
	$stmt = $this->conn->prepare($query);
	$stmt->execute();
    if($stmt->rowCount()>0){
        $i=1;
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
				<tr>
                <td><?php print $i; ?></td>
                <td style="display: none"><?php print($row['id_kelassiswa']); ?></td>
                <td style="display: none"><?php print($row['id_semester']); ?></td>
                <td><?php print($row['nama_kelas']); ?></td>
                <td><?php print($row['semester']); ?></td>
                <td><?php print($row['tahun_ajaran']); ?></td>
                <td align="center">
                <a href="detail?id_kelassiswa=<?php print($row['id_kelassiswa']); ?>&id_semester=<?php print($row['id_semester']); ?>" style="text-decoration:underline">Detail</a>
                </td>
                </tr>
                <?php
                $i++;
            }
        }
        else{
        	?>
            <tr>
            <td>Tidak Ada Data</td>
            </tr>
            <?php
        }
    }
    public function DetailViewRaport($query){
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    if($stmt->rowCount()>0){
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
                <b>NIS : <?php print($row['nis']); ?></b><br>                
                <b>Nama : <?php print($row['nama_siswa']); ?></b><br>
                <?php
            }
        }
        else{
            ?>
            <tr>
            <td>Tidak Ada Data</td>
            </tr>
            <?php
        }
    }
    public function DataViewD($query){
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $i=0;
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
                <tr>
                <td><?php print $i=$i+1; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td><?php print($row['kb_peng']); ?></td>
                <td><?php print($row['th']); ?></td>
                <td><?php print($row['uh']); ?></td>
                <td><?php print($row['uts']); ?></td>
                <td><?php print($row['uas']); ?></td>
                <?php 
                if ($row['nap'] < $row['kb_peng']){ ?>
                    <td style="color: red"><b><?php print round($row['nap']); ?></b></td>
                <?php 
                }else{ ?>
                    <td><?php print round($row['nap']); ?></td>
                <?php }
                ?>
                <td><?php print($row['kb_tr']); ?></td>
                <td><?php print($row['pros']); ?></td>
                <td><?php print($row['proy']); ?></td>
                <td><?php print($row['prod']); ?></td>
                <?php 
                if ($row['nat'] < $row['kb_tr']){ ?>
                    <td style="color: red"><b><?php print round($row['nat']); ?></b></td>
                <?php 
                }else{ ?>
                    <td><?php print round($row['nat']); ?></td>
                <?php }
                ?>
                </tr>
                <?php
                
            }
        }
        else{
            ?>
            <tr>
            <td colspan="14" style="text-align: center">Tidak Ada Data</td>
            </tr>
            <?php
        }
    }
}
$crud=new NSiswa;
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
                <b>Tahun Ajaran : <?php print($row['tahun_ajaran']); ?></b><br>
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
                <td>Ulangan Harian</td>
                <td><?php print($row['kb_peng']); ?></td>
                <td><?php print($row['pu']); ?></td>
                <td><?php print($row['uh']); ?></td>
                <td rowspan="4"><?php print round($row['nap']); ?></td>
                </tr>
                <tr>
                <td><?php print $i=$i+1; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td>Tugas Harian</td>
                <td><?php print($row['kb_peng']); ?></td>
                <td><?php print($row['pt']); ?></td>
                <td><?php print($row['th']); ?></td>
                <td style="display: none"> A </td>
                </tr>
                <tr>
                <td><?php print $i=$i+1; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td>Ujian Tengah Semester</td>
                <td><?php print($row['kb_peng']); ?></td>
                <td><?php print($row['pts']); ?></td>
                <td><?php print($row['uts']); ?></td>
                <td style="display: none"> A </td>
                </tr>
                <tr>
                <td><?php print $i=$i+1; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td>Ujian Akhir Semester</td>
                <td><?php print($row['kb_peng']); ?></td>
                <td><?php print($row['pas']); ?></td>
                <td><?php print($row['uas']); ?></td>
                <td style="display: none"> A </td>
                </tr>
                <tr>
                <td><?php print $i=$i+1; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td>Proses</td>
                <td><?php print($row['kb_tr']); ?></td>
                <td><?php print($row['proses']); ?></td>
                <td><?php print($row['pros']); ?></td>
                <td rowspan="3"><?php print round($row['nat']); ?></td>
                <td style="display: none"> A </td>
                </tr>
                <tr>
                <td><?php print $i=$i+1; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td>Produk</td>
                <td><?php print($row['kb_tr']); ?></td>
                <td><?php print($row['produk']); ?></td>
                <td><?php print($row['prod']); ?></td>
                <td style="display: none"> A </td>
                </tr>
                <tr>
                <td><?php print $i=$i+1; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama']); ?></td>
                <td>Proyek</td>
                <td><?php print($row['kb_tr']); ?></td>
                <td><?php print($row['proyek']); ?></td>
                <td><?php print($row['proy']); ?></td>
                <td style="display: none"> A </td>
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
}
$crud=new NSiswa;
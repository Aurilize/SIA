<?php
require_once '../db/db.php';
class Coba{
    private $conn;

    public function __construct(){
        $database = new Database();
        $db_con = $database->Connect();
        $this->conn = $db_con;
    }
    public function dataview($query){
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount()>0){
            $i=1;
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
                <td><?php echo $i; ?></td>
                <td><?php print($row['nama_mapel']); ?></td>
                <td><?php print($row['nama_kelas']); ?></td>
                <td><?php print($row['semester']); ?></td>
                <td><?php print($row['tahun_ajar']); ?></td>
                <td align="center">
                <a href="inputnilai?a=<?php echo $a;?>&b=<?php echo $row['kd_mapel'];?>&c=<?php echo $row['id_kelas'];?>&d=<?php echo $row['tahun_ajar'];?>"><i class="label label-success" data-toggle="tooltip" data-placement="left" title="Isi Nilai Pengetahuan"> Isi Nilai</i></a>
                </td>
                <td align="center">
                <a href="t-jurusan?delete_jurusan=<?php print($row['kd_jurusan']); ?>" onclick="return confirm('Yakin?');"><i class="label label-danger" data-toggle="tooltip" data-placement="right" title="Isi Nilai Pengetahuan"> Isi Nilai</i></a>
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
$crud=new Coba;
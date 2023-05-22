<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_modal WHERE keterangan_modal = '" . $_POST['keterangan_modal'] . "' AND tanggal_modal = CURDATE()"));

if($cek3 > 0) {
	echo json_encode(['message'=>'Nomor Surat Sudah Ada', 'status'=>'2']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_modal(keterangan_modal,jumlah_modal,tanggal_modal) VALUES('" . ucwords($_POST['keterangan_modal']) . "', '" . str_replace(".", "", $_POST['jumlah_modal']) . "', NOW())");
	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
}
?>
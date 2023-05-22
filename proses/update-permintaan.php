<?php
include '../koneksi.php';

$id = $_POST['id'];
$status = $_POST['status'];
$pilih = count($_POST['pilih']);


if($status == "Tidak Setuju") {
	$alasan = $_POST['alasan'];
	$query = mysqli_query($conn, "UPDATE tb_permintaan SET status = '$status', alasan = '$alasan' WHERE id_permintaan = '$id'");
	$query = mysqli_query($conn, "UPDATE tb_permintaanbantu SET status = '$status' WHERE id_permintaan = '$id'");
}else {
	$alasan = "-";
	$query = mysqli_query($conn, "UPDATE tb_permintaan SET status = '$status', alasan = '$alasan' WHERE id_permintaan = '$id'");
	for ($i=0; $i < $pilih; $i++) { 
	$pilih_status = $_POST['pilih'][$i];
	$id_bantu = $_POST['id_bantu'][$i];
		if (isset($_POST['pilih'])){
			$query = mysqli_query($conn, "UPDATE tb_permintaanbantu SET status = '$status' WHERE id_bantu = '$id_bantu'");
		}
	}
	$query = mysqli_query($conn, "UPDATE tb_permintaanbantu SET status = 'Tidak Setuju' WHERE id_permintaan = '$id' AND status = 'Permintaan'");
}


if($query) {	
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>
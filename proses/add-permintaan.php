<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_permintaanbantu WHERE id_permintaan = '" . strtoupper($_POST['id_permintaan']) . "'"));
if($cek3 == 0) {
	echo json_encode(['message'=>'already in use', 'status'=>'2']);
}else {

	$query = mysqli_query($conn, "INSERT INTO tb_permintaan(id_permintaan,tanggal_permintaan,keterangan_permintaan,status,id_toko,nama_pegawai) VALUES('" . $_POST['id_permintaan'] . "','" . strtoupper($_POST['tanggal_permintaan']) . "','" . strtoupper($_POST['keterangan_permintaan']) . "','" . strtoupper($_POST['status']) . "','" . strtoupper($_POST['id_toko']) . "','" . ucwords($_POST['nama_pegawai']) . "')");

	$id = $_POST['id_permintaan'];
	$query = mysqli_query($conn, "UPDATE tb_permintaanbantu SET status = '" . ucwords($_POST['status']) . "' WHERE id_permintaan = '$id'");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
	}
?>
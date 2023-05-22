<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pemasok WHERE nama_pemasok = '" . $_POST['nama_pemasok'] . "'"));

if($cek3 > 0) {
	echo json_encode(['message'=>'Nomor Surat Sudah Ada', 'status'=>'2']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_pemasok(nama_pemasok,alamat_pemasok,nomor_pemasok) VALUES('" . ucwords($_POST['nama_pemasok']) . "','" . ucwords($_POST['alamat_pemasok']) . "','" . ucwords($_POST['nomor_pemasok']) . "')");
	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
}
?>
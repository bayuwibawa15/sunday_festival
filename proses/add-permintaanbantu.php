<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_permintaanbantu WHERE id_produk = '" . strtoupper($_POST['id_produk']) . "' AND id_permintaan = '" . strtoupper($_POST['id_permintaan']) . "'"));
if($cek3 > 0) {
	echo json_encode(['message'=>'already in use', 'status'=>'2']);
}elseif(str_replace(".", "", $_POST['jumlah_permintaan']) > $_POST['stok_produk']) {
	echo json_encode(['message'=>'lebih dari', 'status'=>'3']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_permintaanbantu(id_produk,jumlah_permintaan,id_permintaan) VALUES('" . strtoupper($_POST['id_produk']) . "','" . str_replace(".", "", $_POST['jumlah_permintaan']) . "','" . strtoupper($_POST['id_permintaan']) . "')");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
	}
?>
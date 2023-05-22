<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_penjualanbantu WHERE id_produk = '" . strtoupper($_POST['id_produk']) . "' AND id_penjualan = '" . strtoupper($_POST['id_penjualan']) . "'"));
if($cek3 > 0) {
	echo json_encode(['message'=>'already in use', 'status'=>'2']);
}elseif(str_replace(".", "", $_POST['jumlah_penjualan']) > $_POST['stok_produk']) {
	echo json_encode(['message'=>'lebih dari', 'status'=>'3']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_penjualanbantu(id_produk,harga_penjualan,jumlah_penjualan,id_penjualan,id_toko) VALUES('" . strtoupper($_POST['id_produk']) . "','" . str_replace(".", "", $_POST['harga_penjualan']) . "','" . str_replace(".", "", $_POST['jumlah_penjualan']) . "','" . strtoupper($_POST['id_penjualan']) . "','" . strtoupper($_POST['id_toko']) . "')");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
	}
?>
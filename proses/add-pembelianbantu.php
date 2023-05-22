<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pembelianbantu WHERE id_produk = '" . strtoupper($_POST['id_produk']) . "' AND id_pembelian = '" . strtoupper($_POST['id_pembelian']) . "'"));
if($cek3 > 0) {
	echo json_encode(['message'=>'already in use', 'status'=>'2']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_pembelianbantu(id_produk,harga_pembelian,jumlah_pembelian,id_pembelian) VALUES('" . strtoupper($_POST['id_produk']) . "','" . str_replace(".", "", $_POST['harga_pembelian']) . "','" . str_replace(".", "", $_POST['jumlah_pembelian']) . "','" . strtoupper($_POST['id_pembelian']) . "')");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
	}
?>
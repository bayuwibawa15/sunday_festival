<?php
include '../koneksi.php';

// $cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pembelian WHERE id_produk = '" . ucwords($_POST['id_produk']) . "'"));
// if($cek3 > 0) {
// 	echo json_encode(['message'=>'already in use', 'status'=>'2']);
// }else {

	$query = mysqli_query($conn, "INSERT INTO tb_pembelian(id_pembelian,tanggal_pembelian,keterangan_pembelian,id_pemasok) VALUES('" . $_POST['id_pembelian'] . "','" . ucwords($_POST['tanggal_pembelian']) . "','" . ucwords($_POST['keterangan_pembelian']) . "','" . ucwords($_POST['id_pemasok']) . "')");

	mysqli_query($conn, "UPDATE tb_pembelianbantu SET id_pembelian = '" . $_POST['id_pembelian'] . "' WHERE id_pembelian = '" . $_POST['id_pembelian'] . "'");



	// $query = mysqli_query($conn, "INSERT INTO tb_pembelianbantu (id_produk,jumlah_bantu,harga,id_pembelian) SELECT id_produk,jumlah_bantu,harga,'" . $kode . "' FROM tb_bantu");
	// $hapus = mysqli_query($conn, "TRUNCATE TABLE tb_bantu");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
	// }
?>
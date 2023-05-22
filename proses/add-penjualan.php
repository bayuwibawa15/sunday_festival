<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_penjualanbantu WHERE id_penjualan = '" . strtoupper($_POST['id_penjualan']) . "'"));
if($cek3 == 0) {
	echo json_encode(['message'=>'already in use', 'status'=>'2']);
}else {

	$query = mysqli_query($conn, "INSERT INTO tb_penjualan(id_penjualan,tanggal_penjualan,keterangan_penjualan,id_toko,status,nama_pegawai) VALUES('" . $_POST['id_penjualan'] . "','" . strtoupper($_POST['tanggal_penjualan']) . "','" . strtoupper($_POST['keterangan_penjualan']) . "','" . strtoupper($_POST['id_toko']) . "','" . ucwords($_POST['status']) . "','" . ucwords($_POST['nama_pegawai']) . "')");

	mysqli_query($conn, "UPDATE tb_penjualanbantu SET status_penjualan = '1' WHERE id_penjualan = '" . $_POST['id_penjualan'] . "'");



	// $query = mysqli_query($conn, "INSERT INTO tb_penjualanbantu (id_produk,jumlah_bantu,harga,id_penjualan) SELECT id_produk,jumlah_bantu,harga,'" . $kode . "' FROM tb_bantu");
	// $hapus = mysqli_query($conn, "TRUNCATE TABLE tb_bantu");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
	}
?>
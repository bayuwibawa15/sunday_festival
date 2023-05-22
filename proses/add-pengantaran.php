<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pengantaran WHERE id_penjualan = '" . $_POST['id_penjualan'] . "'"));

if($cek3 > 0) {
	echo json_encode(['message'=>'Nomor Surat Sudah Ada', 'status'=>'2']);
}else {

	$query = mysqli_query($conn, "INSERT INTO tb_pengantaran(id_penjualan,tanggal_pengantaran,keterangan_pengantaran,id_pegawai) VALUES('" . $_POST['id_penjualan'] . "','" . ucwords($_POST['tanggal_pengantaran']) . "','" . ucwords($_POST['keterangan_pengantaran']) . "','" . ucwords($_POST['id_pegawai']) . "')");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
	}
?>
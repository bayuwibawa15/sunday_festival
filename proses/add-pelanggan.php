<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE nama_pelanggan = '" . $_POST['nama_pelanggan'] . "'"));

if($cek3 > 0) {
	echo json_encode(['message'=>'Nomor Surat Sudah Ada', 'status'=>'2']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_pelanggan(nama_pelanggan,alamat_pelanggan,nomor_pelanggan) VALUES('" . ucwords($_POST['nama_pelanggan']) . "','" . ucwords($_POST['alamat_pelanggan']) . "','" . ucwords($_POST['nomor_pelanggan']) . "')");
	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
}
?>
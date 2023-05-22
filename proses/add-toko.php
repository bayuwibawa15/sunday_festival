<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_toko WHERE nama_toko = '" . $_POST['nama_toko'] . "'"));

if($cek3 > 0) {
	echo json_encode(['message'=>'Nama Toko Sudah Ada', 'status'=>'2']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_toko(nama_toko,alamat_toko,nomor_toko) VALUES('" . ucwords($_POST['nama_toko']) . "','" . ucwords($_POST['alamat_toko']) . "','" . ucwords($_POST['nomor_toko']) . "')");

	// $query = mysqli_query($conn, "INSERT INTO tb_pengguna(nama_lengkap,username,password,level) VALUES('" . ucwords($_POST['nama_toko']) . "','" . $_POST['username'] . "','" . $_POST['username'] . "','Toko')");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
}
?>
<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE username = '" . $_POST['username'] . "'"));

if($cek3 > 0) {
	echo json_encode(['message'=>'Nomor Surat Sudah Ada', 'status'=>'2']);
}else {
	$query = mysqli_query($conn, "INSERT INTO tb_pegawai(nama_pegawai,alamat_pegawai,nomor_pegawai,username,id_toko) VALUES('" . ucwords($_POST['nama_pegawai']) . "','" . ucwords($_POST['alamat_pegawai']) . "','" . ucwords($_POST['nomor_pegawai']) . "','" . ucwords($_POST['username']) . "','" . ucwords($_POST['id_toko']) . "')");

	$query = mysqli_query($conn, "INSERT INTO tb_pengguna(nama_lengkap,username,password,level) VALUES('" . ucwords($_POST['nama_pegawai']) . "','" . $_POST['username'] . "','" . $_POST['username'] . "','Toko')");

	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
}
?>
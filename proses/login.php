<?php
include '../koneksi.php';

$username = mysqli_escape_string($conn, $_POST['username']);
$password = mysqli_escape_string($conn, $_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE BINARY username = '$username' AND BINARY password = '$password'");
$cek = mysqli_num_rows($query);

if($cek > 0) {
	$row = mysqli_fetch_array($query);	
	// $_SESSION['id_pegawai'] = $_POST['id_pegawai'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['userid'] = $row['id_pengguna'];
	$_SESSION['nama'] = $row['nama_lengkap'];
	$_SESSION['level'] = $row['level'];
	echo json_encode(['message'=>'successfully logged in as admin', 'status'=>'1', 'nama'=>$row['nama_lengkap'], 'username'=>$row['username']]);
}else {
	echo json_encode(['message'=>'login failed, account not found', 'status'=>'0']);
}
?>
<?php
include '../koneksi.php';

$id = $_POST['id'];
$query = mysqli_query($conn, "UPDATE tb_pegawai SET nama_pegawai = '" . ucwords($_POST['nama_pegawai']) . "',alamat_pegawai = '" . ucwords($_POST['alamat_pegawai']) . "',nomor_pegawai = '" . ucwords($_POST['nomor_pegawai']) . "' WHERE id_pegawai = '$id'");

if($query) {	
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	$string = mysqli_error($conn);
	$pieces = explode(' ', $string);
	$last_word = array_pop($pieces);
	$remove = str_replace("'", "", $last_word);
	echo json_encode(['message'=>mysqli_error($conn), 'status'=>'0', 'type'=>$remove]);
}
?>
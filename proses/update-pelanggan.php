<?php
include '../koneksi.php';

$id = $_POST['id'];
$query = mysqli_query($conn, "UPDATE tb_pelanggan SET nama_pelanggan = '" . ucwords($_POST['nama_pelanggan']) . "',alamat_pelanggan = '" . ucwords($_POST['alamat_pelanggan']) . "',nomor_pelanggan = '" . ucwords($_POST['nomor_pelanggan']) . "' WHERE id_pelanggan = '$id'");

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
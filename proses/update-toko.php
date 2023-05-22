<?php
include '../koneksi.php';

$id = $_POST['id'];
$query = mysqli_query($conn, "UPDATE tb_toko SET nama_toko = '" . ucwords($_POST['nama_toko']) . "',alamat_toko = '" . ucwords($_POST['alamat_toko']) . "',nomor_toko = '" . ucwords($_POST['nomor_toko']) . "' WHERE id_toko = '$id'");

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
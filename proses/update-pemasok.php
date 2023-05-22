<?php
include '../koneksi.php';

$id = $_POST['id'];
$query = mysqli_query($conn, "UPDATE tb_pemasok SET nama_pemasok = '" . ucwords($_POST['nama_pemasok']) . "',alamat_pemasok = '" . ucwords($_POST['alamat_pemasok']) . "',nomor_pemasok = '" . ucwords($_POST['nomor_pemasok']) . "' WHERE id_pemasok = '$id'");

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
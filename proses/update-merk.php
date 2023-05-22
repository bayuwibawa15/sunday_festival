<?php
include '../koneksi.php';

$id = $_POST['id'];
$query = mysqli_query($conn, "UPDATE tb_merk SET nama_merk = '" . ucwords($_POST['nama_merk']) . "' WHERE id_merk = '$id'");

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
<?php
include '../koneksi.php';

$id = $_POST['id'];
	$query = mysqli_query($conn, "UPDATE tb_modal SET keterangan_modal = '" . ucwords($_POST['keterangan_modal']) . "',jumlah_modal = '" . str_replace(".", "", $_POST['jumlah_modal']) . "' WHERE id_modal = '$id'");

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
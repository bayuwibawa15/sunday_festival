<?php
include '../koneksi.php';

$id = $_POST['id'];

	$query = mysqli_query($conn, "UPDATE tb_pengantaran SET tanggal_pengantaran = '" . ucwords($_POST['tanggal_pengantaran']) . "',keterangan_pengantaran = '" . $_POST['keterangan_pengantaran'] . "',status_pengantaran = '" . $_POST['status_pengantaran'] . "' WHERE id_pengantaran = '$id'");

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
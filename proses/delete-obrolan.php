<?php
include '../koneksi.php';
$id_pengirim = $_POST['id'];
$id_penerima = "admin";

$gabunganPertama = $id_pengirim.$id_penerima;
$gabunganKedua = $id_penerima.$id_pengirim;


$query = mysqli_query($conn, "DELETE FROM chat WHERE kode = '$gabunganPertama'");
$query = mysqli_query($conn, "DELETE FROM chat WHERE kode = '$gabunganKedua'");
if($query) {
	echo json_encode(['message'=>'successfully deleted data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to delete data', 'status'=>'0']);
}
?>
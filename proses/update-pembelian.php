<?php
include '../koneksi.php';

$id = $_POST['id'];

	$query = mysqli_query($conn, "UPDATE tb_pembelian SET tanggal_pembelian = '" . ucwords($_POST['tanggal_pembelian']) . "',harga_pembelian = '" . str_replace(".", "", $_POST['harga_pembelian']) . "',jumlah_pembelian = '" . $_POST['jumlah_pembelian'] . "',keterangan_pembelian = '" . $_POST['keterangan_pembelian'] . "',id_solar = '" . $_POST['id_solar'] . "',id_pemasok = '" . $_POST['id_pemasok'] . "',jumlah_revisi = '" . $_POST['jumlah_revisi'] . "' WHERE id_pembelian = '$id'");

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
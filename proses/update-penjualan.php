<?php
include '../koneksi.php';

$id = $_POST['id'];
$status = $_POST['status'];

	if (isset($_POST['status'])){
		if($status == "Tidak Setuju") {
			$alasan = $_POST['alasan'];
			$query = mysqli_query($conn, "UPDATE tb_penjualan SET tanggal_penjualan = '" . ucwords($_POST['tanggal_penjualan']) . "',harga_penjualan = '" . str_replace(".", "", $_POST['harga_penjualan']) . "',jumlah_penjualan = '" . $_POST['jumlah_penjualan'] . "',keterangan_penjualan = '" . $_POST['keterangan_penjualan'] . "',id_solar = '" . $_POST['id_solar'] . "',id_pelanggan = '" . $_POST['id_pelanggan'] . "',jumlah_revisi = '" . $_POST['jumlah_revisi'] . "',status = '" . $_POST['status'] . "',alasan = '" . ucwords($_POST['alasan']) . "' WHERE id_penjualan = '$id'");
		}else {
			$query = mysqli_query($conn, "UPDATE tb_penjualan SET tanggal_penjualan = '" . ucwords($_POST['tanggal_penjualan']) . "',harga_penjualan = '" . str_replace(".", "", $_POST['harga_penjualan']) . "',jumlah_penjualan = '" . $_POST['jumlah_penjualan'] . "',keterangan_penjualan = '" . $_POST['keterangan_penjualan'] . "',id_solar = '" . $_POST['id_solar'] . "',id_pelanggan = '" . $_POST['id_pelanggan'] . "',jumlah_revisi = '" . $_POST['jumlah_revisi'] . "',status = '" . $_POST['status'] . "' WHERE id_penjualan = '$id'");
		}
	}else{
		$query = mysqli_query($conn, "UPDATE tb_penjualan SET tanggal_penjualan = '" . ucwords($_POST['tanggal_penjualan']) . "',harga_penjualan = '" . str_replace(".", "", $_POST['harga_penjualan']) . "',jumlah_penjualan = '" . $_POST['jumlah_penjualan'] . "',keterangan_penjualan = '" . $_POST['keterangan_penjualan'] . "',id_solar = '" . $_POST['id_solar'] . "',id_pelanggan = '" . $_POST['id_pelanggan'] . "',jumlah_revisi = '" . $_POST['jumlah_revisi'] . "' WHERE id_penjualan = '$id'");
	}

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
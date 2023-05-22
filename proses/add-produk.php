<?php
include '../koneksi.php';

$cek3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_produk WHERE nama_produk = '" . $_POST['nama_produk'] . "'"));

if($cek3 > 0) {
	echo json_encode(['message'=>'Nomor Surat Sudah Ada', 'status'=>'2']);
}else {
	$uploadDir = '../assets/images/berkas';
	$tipe = $_FILES['file1']['name'];
	$tipe = pathinfo($tipe, PATHINFO_EXTENSION);
	$file1nama = round(microtime(true) * 1000).".".$tipe;
	$tmpFile = $_FILES['file1']['tmp_name'];
	$filename = $uploadDir.'/'.$file1nama;
	move_uploaded_file($tmpFile,$filename);

	$query = mysqli_query($conn, "INSERT INTO tb_produk(nama_produk,harga_pembelian,harga_penjualan,stok_produk,file1) VALUES('" . ucwords($_POST['nama_produk']) . "', '" . str_replace(".", "", $_POST['harga_pembelian']) . "', '" . str_replace(".", "", $_POST['harga_penjualan']) . "','" . ucwords($_POST['stok_produk']) . "','" . $file1nama . "')");
	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
}
?>
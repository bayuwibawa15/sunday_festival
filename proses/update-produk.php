<?php
include '../koneksi.php';

$id = $_POST['id'];
if(!empty($_FILES['file1']["name"]))   //jika gambar kosong atau tidak di ganti
{
	$sql = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = '$id'");
$data = mysqli_fetch_array($sql);
$file1 = $data['file1'];
unlink('../assets/images/berkas/'.$file1);
$uploadDir = '../assets/images/berkas';
$tipe = $_FILES['file1']['name'];
$tipe = pathinfo($tipe, PATHINFO_EXTENSION);
$file1nama = round(microtime(true) * 1000).".".$tipe;
$tmpFile = $_FILES['file1']['tmp_name'];
$filename = $uploadDir.'/'.$file1nama;
move_uploaded_file($tmpFile,$filename);
$query = mysqli_query($conn, "UPDATE tb_produk SET nama_produk = '" . ucwords($_POST['nama_produk']) . "',harga_pembelian = '" . str_replace(".", "", $_POST['harga_pembelian']) . "',harga_penjualan = '" . str_replace(".", "", $_POST['harga_penjualan']) . "', file1 = '" . $file1nama . "' WHERE id_produk = '$id'");
}else{
	$query = mysqli_query($conn, "UPDATE tb_produk SET nama_produk = '" . ucwords($_POST['nama_produk']) . "',harga_pembelian = '" . str_replace(".", "", $_POST['harga_pembelian']) . "',harga_penjualan = '" . str_replace(".", "", $_POST['harga_penjualan']) . "' WHERE id_produk = '$id'");
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
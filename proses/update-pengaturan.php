<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama_pengaturan = ucwords($_POST['nama_pengaturan']);
$uploadDir = '../assets/images/berkas';
	$g1 = $_POST['g1'];
if(!empty($_FILES['ttd']["name"]))   //jika gambar kosong atau tidak di ganti
{
	unlink('../assets/images/berkas/'.$g1);
	$tipe = $_FILES['ttd']['name'];
	$tipe = pathinfo($tipe, PATHINFO_EXTENSION);
	$ttdnama = round(microtime(true) * 1000)."ttd.".$tipe;
	$tmpttd = $_FILES['ttd']['tmp_name'];
	$filename1 = $uploadDir.'/'.$ttdnama;
	move_uploaded_file($tmpttd,$filename1);
$query = mysqli_query($conn, "UPDATE tb_pengaturan SET nama_pengaturan = '$nama_pengaturan', ttd = '$ttdnama' WHERE id_pengaturan = '$id'");
}else{
$query = mysqli_query($conn, "UPDATE tb_pengaturan SET nama_pengaturan = '$nama_pengaturan' WHERE id_pengaturan = '$id'");
}
if($query) {	
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>mysqli_error($conn), 'status'=>'0']);
}
?>
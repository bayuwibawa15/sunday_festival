<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="author" content="SUNDAY FESTIVAL">
<meta name="description" content="SUNDAY FESTIVAL">
<meta name="keywords" content="SUNDAY FESTIVAL, jafar, rizkikarianata">
<title>SUNDAY FESTIVAL </title>
<?php 
$nama_apps='SUNDAY FESTIVAL';
?>
<link rel="stylesheet" href="assets/plugins/myplugins/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/myplugins/fontawesome/css/all.css">
<link rel="stylesheet" href="assets/plugins/jqvmap/dist/jqvmap.min.css">
<link rel="stylesheet" href="assets/plugins/weathericons/css/weather-icons.min.css">
<link rel="stylesheet" href="assets/plugins/weathericons/css/weather-icons-wind.min.css">
<link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
<link rel="stylesheet" href="assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="assets/plugins/summernote/dist/summernote-bs4.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="assets/plugins/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="assets/plugins/selectric/public/selectric.css">
<link rel="stylesheet" href="assets/plugins/chocolat/dist/css/chocolat.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/dropzone/dist/min/dropzone.min.css">
<link rel="stylesheet" href="assets/dist/css/style.css">
<link rel="stylesheet" href="assets/dist/css/components.css">
<?php
if(isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	// $id_pegawai = $_SESSION['id_pegawai'];
	$syntax = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE id_pengguna = '$userid'");
	$online = mysqli_fetch_array($syntax);
	
	if($_SESSION['level'] == "Toko") {
		// $query_toko = mysqli_query($conn, "SELECT * FROM tb_toko WHERE username = '$username'");
		// $tampil_toko = mysqli_fetch_array($query_toko);
		// $id_toko = $tampil_toko['id_toko'];
		$query_toko = mysqli_query($conn, "SELECT * FROM tb_pegawai,tb_toko WHERE tb_pegawai.id_toko=tb_toko.id_toko AND username = '$username'");
		$tampil_toko = mysqli_fetch_array($query_toko);
		$id_toko = $tampil_toko['id_toko'];
		$nama_pegawai = $tampil_toko['nama_pegawai'];
	}
	// if($id_pegawai<>'Admin'){
	// $query_pegawai = mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE id_pegawai = '$id_pegawai'");
	// $tampil_pegawai = mysqli_fetch_array($query_pegawai);
	// $nama_pegawai = $tampil_pegawai['nama_pegawai'];
	// }else{
	// $nama_pegawai = 'Admin';
	// }
	
}else {
	echo "<script>window.location.href='index'</script>";
}
?>
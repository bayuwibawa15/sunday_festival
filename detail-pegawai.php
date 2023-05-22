<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_pegawai WHERE id_pegawai = '$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
</head>
<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<?php include 'menu/navbar.php'; ?>
			</nav>
			<div class="main-sidebar">
				<aside id="sidebar-wrapper">
					<?php include 'menu/aside.php'; ?>
				</aside>
			</div>
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Detail Data Pegawai</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pegawai">Data Pegawai</a></div>
							<div class="breadcrumb-item">Detail Data Pegawai</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="nama_pegawai">Nama Pegawai</label>
														<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" required="" autocomplete="off"  value="<?php echo $row['nama_pegawai'];?>" placeholder="Nama Pegawai" autofocus>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="alamat_pegawai">Alamat Pegawai</label>
														<input type="text" name="alamat_pegawai" id="alamat_pegawai" class="form-control" required="" autocomplete="off"  value="<?php echo $row['alamat_pegawai'];?>" placeholder="Alamat Pegawai" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="nomor_pegawai">Nomor Telpon</label>
														<input type="text" name="nomor_pegawai" id="nomor_pegawai" class="form-control" required="" autocomplete="off"  value="<?php echo $row['nomor_pegawai'];?>" placeholder="Nomor Telpon" >
													</div>
												</div>
											</div>


											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%">Ubah</button>
													<a href="pegawai" class="btn btn-warning" style="width:40%">Kembali</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<?php include 'menu/footer.php'; ?>
			</footer>
		</div>
	</div>
	<?php include 'menu/script.php'; ?>
	<script src="assets/dist/js/bs-custom-file-input.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			bsCustomFileInput.init();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-pegawai.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "1") {
							swal({
								title: "Pemberitahuan",
								text: "Berhasil mengubah data",
								icon: "success"
							}).then(function() {
								window.location = "pegawai";
							});
						}else {
							if(dataresponse.type == "nomor_pegawai") {
								swal('Peringatan', 'Data Sudah Di Masukan', 'error');
							}else {
								swal('Peringatan', 'Maaf, gagal mengubah data', 'error');
							}
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>
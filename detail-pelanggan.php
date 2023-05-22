<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE id_pelanggan = '$id'");
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
						<h1>Detail Data Pelanggan</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pelanggan">Data Pelanggan</a></div>
							<div class="breadcrumb-item">Detail Data Pelanggan</div>
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
														<label for="nama_pelanggan">Nama Pelanggan</label>
														<input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required="" autocomplete="off"  value="<?php echo $row['nama_pelanggan'];?>" placeholder="Nama Pelanggan" autofocus>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="alamat_pelanggan">Alamat Pelanggan</label>
														<input type="text" name="alamat_pelanggan" id="alamat_pelanggan" class="form-control" autocomplete="off"  value="<?php echo $row['alamat_pelanggan'];?>" placeholder="Alamat Pelanggan" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="nomor_pelanggan">Nomor Telpon</label>
														<input type="text" name="nomor_pelanggan" id="nomor_pelanggan" class="form-control" autocomplete="off"  value="<?php echo $row['nomor_pelanggan'];?>" placeholder="Nomor Telpon" >
													</div>
												</div>
											</div>


											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%">Ubah</button>
													<a href="pelanggan" class="btn btn-warning" style="width:40%">Kembali</a>
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
					url: "proses/update-pelanggan.php",
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
								window.location = "pelanggan";
							});
						}else {
							if(dataresponse.type == "nomor_pelanggan") {
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
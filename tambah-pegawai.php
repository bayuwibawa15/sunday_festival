<?php include 'koneksi.php'; ?>
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
						<h1>Tambah Data Pegawai</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pegawai">Data Pegawai</a></div>
							<div class="breadcrumb-item">Tambah Data Pegawai</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<div class="row">
											<div class="col-md-6">
													<div class="form-group">
														<label for="id_toko">Data Toko</label>
															<?php
														$sql =  "SELECT * FROM tb_toko ORDER BY nama_toko ASC";
														?>
														<select class="form-control select2" name="id_toko" id="id_toko" required="" style="width: 100%;">
															<option value="">Pilih Data Toko</option>
															<?php
															$result = mysqli_query($conn, $sql);
															while ($data1 = mysqli_fetch_array($result)){
																echo '<option value="' . $data1['id_toko'] . '">' . $data1['nama_toko'] . '</option>';   
															}  
															?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="nama_pegawai">Nama Pegawai</label>
														<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" required="" autocomplete="off" placeholder="Nama Pegawai" autofocus>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="alamat_pegawai">Alamat Pegawai</label>
														<input type="text" name="alamat_pegawai" id="alamat_pegawai" class="form-control" required="" autocomplete="off" placeholder="Alamat Pegawai" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="nomor_pegawai">Nomor Telpon</label>
														<input type="text" name="nomor_pegawai" id="nomor_pegawai" class="form-control" required="" autocomplete="off" placeholder="Nomor Telpon" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="username">Username</label>
														<input type="text" name="username" id="username" class="form-control" required="" autocomplete="off" placeholder="Username" >
													</div>
												</div>
											</div>

											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%">Simpan</button>
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
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/add-pegawai.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "0") {
							swal('Peringatan', 'Maaf, gagal menambah data', 'error');
						}else if(dataresponse.status == "1") {
							swal({
								title: "Pemberitahuan",
								text: "Berhasil menambah data ",
								icon: "success"
							}).then(function() {
								window.location = "pegawai";
							});
						}else if(dataresponse.status == "2") {
							swal('Peringatan', 'Maaf, Data sudah digunakan', 'error');
						}else {
							swal('Peringatan', 'Maaf, gagal menambah data', 'error');
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>
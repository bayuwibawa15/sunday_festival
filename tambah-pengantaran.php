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
						<h1>Tambah Data Pengantaran</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="penjualan">Data Pengantaran</a></div>
							<div class="breadcrumb-item">Tambah Data Pengantaran</div>
						</div>
					</div>

					<div class="row">
					<div class="col-md-12">
					<div class="section-body">
						<div class="row">
					<div class="col-md-12">
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
									<h4>Isi Data Pengantaran</h4>
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form2">
											<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal_pengantaran">Tanggal Pengantaran</label>
										<input type="date" name="tanggal_pengantaran" id="tanggal_pengantaran" class="form-control" required="" autocomplete="off" placeholder="Tanggal Penjualan" autofocus="" value="<?php echo date('Y-m-d'); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="id_penjualan">Data Pelanggan</label>
											<?php
										$sql =  "SELECT * FROM tb_penjualan,tb_pelanggan WHERE tb_pelanggan.id_pelanggan=tb_penjualan.id_pelanggan AND status='Setuju' AND tb_penjualan.id_toko='$id_toko' ORDER BY nama_pelanggan ASC";
										?>
										<select class="form-control select2" name="id_penjualan" id="id_penjualan" required="" style="width: 100%;">
											<option value="">Pilih Data Pelanggan</option>
											<?php
											$result = mysqli_query($conn, $sql);
											while ($data1 = mysqli_fetch_array($result)){
												echo '<option value="' . $data1['id_penjualan'] . '">' . $data1['id_penjualan'] . ' | ' . $data1['nama_pelanggan'] . '</option>';   
											}  
											?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="id_pegawai">Data Pegawai</label>
											<?php
										$sql =  "SELECT * FROM tb_pegawai WHERE status='Kosong' AND id_toko='$id_toko' ORDER BY nama_pegawai ASC";
										?>
										<select class="form-control select2" name="id_pegawai" id="id_pegawai" required="" style="width: 100%;">
											<option value="">Pilih Data Pegawai</option>
											<?php
											$result = mysqli_query($conn, $sql);
											while ($data1 = mysqli_fetch_array($result)){
												echo '<option value="' . $data1['id_pegawai'] . '">' . $data1['nama_pegawai'] . '</option>';   
											}  
											?>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan_pengantaran">Keterangan</label>
										<input type="text" name="keterangan_pengantaran" id="keterangan_pengantaran" class="form-control" required="" autocomplete="off" placeholder="Keterangan" minlength="1" maxlength="100">
									</div>
								</div>
								</div>
								<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%">Simpan</button>
													<a href="pengantaran" class="btn btn-warning" style="width:40%">Kembali</a>
												</div>
											</div>
										</form>
									</div>
								</div>
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
    $(document).ready(function(){
        $("#id_penjualan").change(function(){
        var id_penjualan = $("#id_penjualan").val();
            $.ajax({
                type: 'GET',
                url: "get-penjualan.php",
                data: {id_penjualan: id_penjualan},
                cache: false,
                success: function(msg){
                   var json = msg,
                    obj = JSON.parse(json);
                    $('#harga_penjualan').val(obj.harga_penjualan);
                    $('#jumlah_penjualan').val(obj.jumlah_penjualan);
                    $('#nama_solar').val(obj.nama_solar);
                    $('#total').val(obj.total);
                }
            });
        });

     });
 </script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#data-form2").submit(function(e) {
					e.preventDefault();
					var data = new FormData(this);
					$.ajax({
						type: "POST",
						url: "proses/add-pengantaran.php",
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
									window.location = "pengantaran";
								});
							}else if(dataresponse.status == "2") {
								swal('Peringatan', 'Maaf, data sudah di proses', 'error');
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
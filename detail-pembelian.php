<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_pembelian,tb_pemasok WHERE tb_pemasok.id_pemasok=tb_pembelian.id_pemasok AND id_pembelian = '$id'");
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
						<h1>Detail Data Pembelian</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pembelian">Data Pembelian</a></div>
							<div class="breadcrumb-item">Detail Data Pembelian</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<h5><u>Informasi Data Pembelian</u></h5>
										<div class="table-responsive">
											<table class="table">
												<tbody>
													<tr>
														<th style="width: 100px;">Tanggal</th>
														<th style="width: 10px;">:</th>
														<th><?php echo tglIndonesia(date('d F Y', strtotime($row['tanggal_pembelian'])));?></th>
													</tr>
													<tr>
														<th>Nama Pemasok</th>
														<th>:</th>
														<th><?php echo $row['nama_pemasok'];?></th>
													</tr>
													<tr>
														<th>Keterangan</th>
														<th>:</th>
														<th><?php echo $row['keterangan_pembelian'];?></th>
													</tr>
												</tbody>
											</table>
										</div>
										<h5><u>List Data Produk</u></h5>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-striped" id="table-1">
													<thead>
														<tr>
													<th>Nomor</th>
													<th>Nama Produk</th>
													<th>Harga Produk</th>
													<th>Jumlah Pembelian</th>
													<th>Total</th>
														</tr>
													</thead>
													<tbody>
												<?php
												$no = 1;
												$kueri = mysqli_query($conn, "SELECT * FROM tb_pembelianbantu,tb_produk WHERE tb_pembelianbantu.id_produk=tb_produk.id_produk AND id_pembelian='$id'");
												while($tampil = mysqli_fetch_array($kueri)) {
													?>
													<tr>
														<td><?php echo $no++;?></td>
														<td><?php echo $tampil['nama_produk'];?></td>
														<td><?php echo number_format($tampil['harga_pembelian'],0,",",".");?></td>
														<td><?php echo $tampil['jumlah_pembelian'];?></td>
														<td><?php echo number_format($tampil['harga_pembelian']*$tampil['jumlah_pembelian'],0,",",".");?></td>
													</tr>
												<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<a href="pembelian" class="btn btn-danger" style="width: 100%">Kembali</a>
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
	<script type="text/javascript">
		$('#status').on('change', function() {
			var valstatus = $(this).val();
			if(valstatus == "Tolak") {
				document.getElementById('ala').style.display = 'block';
				document.getElementById('alasan').setAttribute("required", "");
			}else {
				document.getElementById('ala').style.display = 'none';
				document.getElementById('alasan').removeAttribute("required");
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-kebocoran.php",
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
								window.location = "kebocoran";
							});
						}else {
							swal('Peringatan', 'Kesalahan dalam sebuah query', 'error');
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>
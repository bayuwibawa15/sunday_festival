<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_permintaan, tb_toko WHERE tb_toko.id_toko=tb_permintaan.id_toko AND id_permintaan = '$id'");
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
						<h1>Detail Data Permintaan</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="permintaan">Data Permintaan</a></div>
							<div class="breadcrumb-item">Detail Data Permintaan</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<h5><u>Informasi Data Permintaan</u></h5>
										<div class="table-responsive">
											<table class="table">
												<tbody>
													<tr>
														<th style="width: 180px;">Tanggal</th>
														<th style="width: 10px;">:</th>
														<th><?php echo tglIndonesia(date('d F Y', strtotime($row['tanggal_permintaan'])));?></th>
													</tr>
													<tr>
														<th>Nama Toko</th>
														<th>:</th>
														<th><?php echo $row['nama_toko'];?></th>
													</tr>
													<tr>
														<th>Keterangan</th>
														<th>:</th>
														<th><?php echo $row['keterangan_permintaan'];?></th>
													</tr>
													<tr>
														<th>Status</th>
														<th>:</th>
														<th><?php echo $row['status'];?></th>
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
													<th>Ketersediaan</th>
													<th>Nama Produk</th>
													<th>Harga Permintaan</th>
													<th>Jumlah Permintaan</th>
													<th>Total</th>
														</tr>
													</thead>
													<tbody>
												<?php
												$no = 1;
												$kueri = mysqli_query($conn, "SELECT * FROM tb_permintaanbantu,tb_produk WHERE tb_permintaanbantu.id_produk=tb_produk.id_produk AND id_permintaan = '$id'");
												while($tampil = mysqli_fetch_array($kueri)) {
													?>
													<tr>
														<td><?php echo $no++;?></td>
														<?php if($_SESSION['level'] == "Admin") { ?>
														<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
														<td>
														<input type="hidden" name="id_bantu[]" id="id_bantu" value="<?php echo $tampil['id_bantu'];?>">
														<input type="checkbox" name="pilih[]" value="Setuju"  <?php if(($tampil['status']=='Permintaan') || $tampil['status']=='Setuju' || $tampil['status']=='Di Terima'){ echo 'checked'; }?>   <?php if(($row['status']=='Tidak Setuju') || $row['status']=='Setuju' || $row['status']=='Di Terima'){ echo 'disabled'; }?>> Tersedia
														</td>
														<?php }else{ ?>
														<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
														<td>
														<input type="hidden" name="id_bantu[]" id="id_bantu" value="<?php echo $tampil['id_bantu'];?>">
														<input type="checkbox" name="pilih[]" value="Setuju" <?php if(($tampil['status']=='Permintaan') || $tampil['status']=='Setuju' || $tampil['status']=='Di Terima'){ echo 'checked'; }?> onclick="return false;"> Tersedia
														</td>
														<?php } ?>
														<td><?php echo $tampil['nama_produk'];?></td>
														<td><?php echo number_format($tampil['harga_penjualan'],0,",",".");?></td>
														<td><?php echo $tampil['jumlah_permintaan'];?></td>
														<td><?php echo number_format($tampil['harga_penjualan']*$tampil['jumlah_permintaan'],0,",",".");?></td>
													</tr>
												<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<?php if($_SESSION['level'] == "Admin") { ?>
										<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label for="status">Status</label>
															<select class="form-control select2" name="status" id="status" required="" style="width: 100%;">
																<?php if($row['status'] == "Setuju" || $row['status'] == "Tidak Setuju") { ?>
																	<option value="<?php echo $row['status'];?>" selected=""><?php echo $row['status'];?></option>
																<?php }else if($row['status'] == "Permintaan") { ?>
																	<option value="">Pilih Status</option>
																	<option value="Setuju">Setuju</option>
																	<option value="Tidak Setuju">Tidak Setuju</option>
																<?php }else { ?>
																	<option value="">Pilih Status</option>
																	<option value="Tidak Setuju">Tidak Setuju</option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											<?php if($row['status'] == "Tidak Setuju") { ?>
												<div class="row" id="ala">
													<div class="col-md-12">
														<div class="form-group">
															<label for="alasan">Alasan</label>
															<textarea class="form-control" name="alasan" required="" id="alasan" placeholder="Tulis Alasan" autocomplete="off" rows="4" style="height: 125px;"><?php echo $row['alasan'];?></textarea>
														</div>
													</div>
												</div>
											<?php }else { ?>
												<div class="row" id="ala" style="display: none;">
													<div class="col-md-12">
														<div class="form-group">
															<label for="alasan">Alasan</label>
															<textarea class="form-control" name="alasan" id="alasan" placeholder="Tulis Alasan" autocomplete="off" rows="4" style="height: 125px;"></textarea>
														</div>
													</div>
												</div>
											<?php } ?>
										<div class="row">
												<div class="col-md-12" align="center">
													<button type="submit" class="btn btn-primary" style="width: 40%;" <?php if(($row['status']=='Setuju') || $row['status']=='Tidak Setuju'){ echo 'disabled'; }?>>Proses</button>
													<a href="permintaan" class="btn btn-danger"  style="width: 40%;" >Kembali</a>
												</div>
											</div>
										</form>
										<?php }else{ ?>
											<?php if(($row['status']=='Setuju')){ ?>
										<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label for="status">Status</label>
															<select class="form-control select2" name="status"required="" style="width: 100%;">
																<?php if($row['status'] == "Setuju") { ?>
																	<option value="">Pilih Status</option>
																	<option value="Di Terima">Di Terima</option>
																<?php }else { ?>
																	<option value="">Di Terima</option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12" align="center">
														<button type="submit" class="btn btn-primary" style="width: 40%;" <?php if(($row['status']=='Di Terima')){ echo 'disabled'; }?>>Proses</button>
														<a href="permintaan" class="btn btn-danger"  style="width: 40%;" >Kembali</a>
													</div>
												</div>
											</form>
										<?php }else{ ?>
										<div class="row">
											<div class="col-md-12">
												<a href="permintaan" class="btn btn-danger" style="width: 100%">Kembali</a>
											</div>
										</div>
										<?php }} ?>
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
			if(valstatus == "Tidak Setuju") {
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
					url: "proses/update-permintaan.php",
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
								window.location = "permintaan";
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
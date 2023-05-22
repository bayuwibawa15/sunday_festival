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
						<h1>Data Permintaan Stok</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Data Permintaan Stok</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
									<?php if($_SESSION['level'] == "Toko") { ?>
										<a href="tambah-permintaan" class="btn btn-primary" style="border-radius: 4px;"><i class="fas fa-plus"></i></a>
										<?php } ?>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th>Nomor</th>
														<th>Tanggal Permintaan Stok</th>
														<th>Nama Toko</th>
														<th>Nama Pegawai</th>
														<th>Keterangan</th>
														<th>Status</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													$kueri = mysqli_query($conn, "SELECT * FROM tb_permintaan, tb_toko WHERE tb_toko.id_toko=tb_permintaan.id_toko ORDER BY date(tanggal_permintaan) DESC");
													while($tampil = mysqli_fetch_array($kueri)) {
														if ($tampil['status']=='Setuju'){
															$warna ='style="background: #a7e896;color:#000;"';
														}elseif ($tampil['status']=='Permintaan'){
															$warna ='style="background: #e8e596;color:#000;"';
														}elseif ($tampil['status']=='Di Terima'){
															$warna ='style="background: #fffede;color:#000;"';
														}else{
															$warna ='style="background: #e89696;color:#000;"';
														}
														?>
														<tr <?php echo $warna; ?>>
															<td><?php echo $no++;?></td>
															<td><?php echo tglIndonesia(date('d F Y', strtotime($tampil['tanggal_permintaan'])));?></td>
															<td><?php echo $tampil['nama_toko'];?></td>
															<td><?php echo $tampil['nama_pegawai'];?></td>
															<td><?php echo $tampil['keterangan_permintaan'];?></td>
															<td><?php echo $tampil['status'];?></td>
															<td style="white-space: nowrap;">
																<a href="detail-permintaan?id=<?php echo $tampil['id_permintaan'];?>" class="btn btn-warning"><i class="fas fa-info-circle"></i></a>
																<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_permintaan'];?>"><i class="fas fa-trash-alt"></i></a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
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
		"use strict";
		$("#table-1").dataTable();
	</script>
	<script type="text/javascript">
		$(document).on('click','#delete-data', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			swal({
				title: 'Apakah Anda yakin?',
				text: 'Setelah dihapus, Anda tidak dapat memulihkan data ini !',
				icon: 'warning',
				buttons: {
					cancel: {
						text: "Jangan",
						value: false,
						visible: true,
						className: "",
						closeModal: true,
					},
					confirm: {
						text: "Ya, hapus saja!",
						value: true,
						visible: true,
						className: "",
						closeModal: true
					},
				},
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: "POST",
						url: "proses/delete-permintaan.php",
						data: {'id':id},
						success: function(response) {
							var dataresponse = JSON.parse(response);
							console.log(dataresponse);
							if(dataresponse.status == "1") {
								swal({
									title: "Pemberitahuan",
									text: "Berhasil menghapus data",
									icon: "success"
								}).then(function() {
									window.location = "permintaan";
								});
							}else {
								swal('Peringatan', 'Kesalahan dalam sebuah query', 'error');
							}
						}
					});
				}
			});
		});
	</script>
</body>
</html>
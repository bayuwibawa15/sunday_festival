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
						<h1>Data Produk</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Data Produk</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
									<?php if($_SESSION['level'] == "Admin") { ?>
										<a href="tambah-produk" class="btn btn-primary" style="border-radius: 4px;"><i class="fas fa-plus"></i></a>
									<?php } ?>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th>Nomor</th>
														<th>Nama Produk</th>
														<?php if($_SESSION['level'] == "Admin") { ?>
														<th>Harga Pembelian</th>
														<?php } ?>
														<th>Harga Penjualan</th>
														<th>Gambar</th>
														<th>Stok Produk</th>
														<?php if($_SESSION['level'] == "Admin") { ?>
														<th>Aksi</th>
														<?php } ?>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													$kueri = mysqli_query($conn, "SELECT * FROM tb_produk ORDER BY date(nama_produk) DESC");
													while($tampil = mysqli_fetch_array($kueri)) {
														if($_SESSION['level'] == "Toko") {
														$kueri_permintaan = mysqli_query($conn, "SELECT *,SUM(jumlah_permintaan) AS total_permintaan FROM tb_permintaanbantu, tb_permintaan WHERE tb_permintaanbantu.id_permintaan=tb_permintaan.id_permintaan AND id_toko='$id_toko' AND tb_permintaanbantu.id_produk='$tampil[id_produk]' AND (tb_permintaanbantu.status='Di Terima')");
														$tampil_permintaan = mysqli_fetch_array($kueri_permintaan);

														$kueri_penjualan = mysqli_query($conn, "SELECT *,SUM(jumlah_penjualan) AS total_penjualan FROM tb_penjualanbantu WHERE  id_toko='$id_toko' AND tb_penjualanbantu.id_produk='$tampil[id_produk]' AND status_penjualan='1'");
														$tampil_penjualan = mysqli_fetch_array($kueri_penjualan);
														}

														?>
														<tr>
															<td><?php echo $no++;?></td>
															<td><?php echo $tampil['nama_produk'];?></td>
															<?php if($_SESSION['level'] == "Admin") { ?>
															<td><?php echo number_format($tampil['harga_pembelian'],0,",",".");?></td>
															<?php } ?>
															<td><?php echo number_format($tampil['harga_penjualan'],0,",",".");?></td>
															<td><a target="_blank" href="assets/images/berkas/<?php echo $tampil['file1']; ?>"><strong>Lihat</strong></a></td>
															<?php if($_SESSION['level'] == "Admin") { ?>
															<td><?php echo number_format($tampil['stok_produk'],0,",",".");?></td>
															<?php }else{ ?>
																<td><?php echo number_format($tampil_permintaan['total_permintaan']-$tampil_penjualan['total_penjualan'],0,",",".");?></td>
															<?php } ?>
															<?php if($_SESSION['level'] == "Admin") { ?>
															<td style="white-space: nowrap;">
																<a href="detail-produk?id=<?php echo $tampil['id_produk'];?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
																<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_produk'];?>"><i class="fas fa-trash-alt"></i></a>
															</td>
															<?php } ?>
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
						url: "proses/delete-produk.php",
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
									window.location = "produk";
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
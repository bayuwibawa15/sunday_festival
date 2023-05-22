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
						<h1>Grafik Penjualan</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Grafik Penjualan</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="perbulan-tab" data-toggle="tab"
													href="#perbulan" role="tab" aria-controls="perbulan"
													aria-selected="true">Perbulan</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="pertahun-tab" data-toggle="tab"
													href="#pertahun" role="tab" aria-controls="pertahun"
													aria-selected="false">Pertahun</a>
											</li>
											<!-- <li class="nav-item">
												<a class="nav-link" id="pertanggal-tab" data-toggle="tab"
													href="#pertanggal" role="tab" aria-controls="pertanggal"
													aria-selected="false">Pertanggal</a>
											</li> -->
										</ul>
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="perbulan" role="tabpanel"
												aria-labelledby="perbulan-tab">
												<div class="row">
													<div class="col-md-12">
														<form action="tampil-penjualan" method="POST"
															id="form_tambah">
															<input type="hidden" name="kode" id="kode" value="perbulan">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="bulan">Bulan</label>
																		<select class="form-control select2"
																			name="bulan" id="bulan" required="">
																			<option value="">Pilih Bulan</option>
																			<option value="01">Januari</option>
																			<option value="02">Februari</option>
																			<option value="03">Maret</option>
																			<option value="04">April</option>
																			<option value="05">Mei</option>
																			<option value="06">Juni</option>
																			<option value="07">Juli</option>
																			<option value="08">Agustus</option>
																			<option value="09">September</option>
																			<option value="10">Oktober</option>
																			<option value="11">November</option>
																			<option value="12">Desember</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="tahun">Tahun</label>
																		<select class="form-control select2"
																			name="tahun" id="tahun" required="">
																			<option value="">Pilih Tahun</option>
																			<?php
																			$mulai= date('Y') - 50;
																			for($i = $mulai;$i<$mulai + 100;$i++){
																				$sel = $i == date('Y') ? ' selected="selected"' : '';
																				echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
																			}
																			?>
																		</select>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<input type="submit" name="submit"
																			value="Tampilkan Grafik"
																			class="btn btn-primary float-right">
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="pertahun" role="tabpanel"
												aria-labelledby="pertahun-tab">
												<div class="row">
													<div class="col-md-12">
														<form action="tampil-penjualan" method="POST"
															id="form_tambah">
															<input type="hidden" name="kode" id="kode"
																value="pertahun">
															<div class="row">
															<div class="col-md-6">
																	<div class="form-group">
																		<label for="tahun1">Tahun</label>
																		<select class="form-control select2"
																			name="tahun" id="tahun1" required="" style="width: 100%;">
																			<option value="">Pilih Tahun</option>
																			<?php
																			$mulai= date('Y') - 50;
																			for($i = $mulai;$i<$mulai + 100;$i++){
																				$sel = $i == date('Y') ? ' selected="selected"' : '';
																				echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
																			}
																			?>
																		</select>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<input type="submit" name="submit"
																			value="Tampilkan Grafik"
																			class="btn btn-primary float-right">
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="pertanggal" role="tabpanel"
												aria-labelledby="pertanggal-tab">
												<div class="row">
													<div class="col-md-12">
														<form action="tampil-penjualan" method="POST"
															id="form_tambah">
															<input type="hidden" name="kode" id="kode"
																value="pertanggal">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="from">Dari Tanggal</label>
																		<input type="date" name="from" id="from"
																			required="" class="form-control">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="to">Sampai Tanggal</label>
																		<input type="date" name="to" id="to" required=""
																			class="form-control">
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<input type="submit" name="submit"
																			value="Cetak Grafik"
																			class="btn btn-primary float-right">
																	</div>
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

</body>

</html>
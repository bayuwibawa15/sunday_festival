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
						<h1>Laporan Permintaan Stok</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Laporan Permintaan Stok</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<!-- <li class="nav-item">
												<a class="nav-link active" id="perhari-tab" data-toggle="tab"
													href="#perhari" role="tab" aria-controls="perhari"
													aria-selected="true">Perhari</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="perminggu-tab" data-toggle="tab"
													href="#perminggu" role="tab" aria-controls="perminggu"
													aria-selected="true">Perminggu</a>
											</li> -->
											<li class="nav-item active">
												<a class="nav-link" id="perbulan-tab" data-toggle="tab"
													href="#perbulan" role="tab" aria-controls="perbulan"
													aria-selected="true">Perbulan</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="pertahun-tab" data-toggle="tab"
													href="#pertahun" role="tab" aria-controls="pertahun"
													aria-selected="true">Pertahun</a>
											</li>
											<!-- <li class="nav-item">
												<a class="nav-link" id="pertanggal-tab" data-toggle="tab"
													href="#pertanggal" role="tab" aria-controls="pertanggal"
													aria-selected="false">Pertanggal</a>
											</li> -->
										</ul>
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade" id="perhari" role="tabpanel"
												aria-labelledby="perhari-tab">
												<div class="row">
													<div class="col-md-12">
														<form target="_blank" action="cetak-permintaan" method="POST"
															id="form_tambah">
															<input type="hidden" name="kode" id="kode" value="perhari">
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="hari">Hari</label>
																		<select style="width:100%" class="form-control select2"
																			name="hari" id="hari1" required="">
																			<option value="">Pilih Hari</option>
																			<option value="01">1</option>
																			<option value="02">2</option>
																			<option value="03">3</option>
																			<option value="04">4</option>
																			<option value="05">5</option>
																			<option value="06">6</option>
																			<option value="07">7</option>
																			<option value="08">8</option>
																			<option value="09">9</option>
																			<option value="10">10</option>
																			<option value="11">11</option>
																			<option value="12">12</option>
																			<option value="13">13</option>
																			<option value="14">14</option>
																			<option value="15">15</option>
																			<option value="16">16</option>
																			<option value="17">17</option>
																			<option value="18">18</option>
																			<option value="19">19</option>
																			<option value="20">20</option>
																			<option value="21">21</option>
																			<option value="22">22</option>
																			<option value="23">23</option>
																			<option value="24">24</option>
																			<option value="25">25</option>
																			<option value="26">26</option>
																			<option value="27">27</option>
																			<option value="28">28</option>
																			<option value="29">29</option>
																			<option value="30">30</option>
																			<option value="31">31</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="bulan">Bulan</label>
																		<select style="width:100%" class="form-control select2"
																			name="bulan" id="bulan1" required="">
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
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="tahun">Tahun</label>
																		<select style="width:100%" class="form-control select2"
																			name="tahun" id="tahun1" required="">
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
																			value="Cetak Laporan"
																			class="btn btn-primary float-right">
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="perminggu" role="tabpanel"
												aria-labelledby="perminggu-tab">
												<div class="row">
													<div class="col-md-12">
														<form target="_blank" action="cetak-permintaan" method="POST"
															id="form_tambah">
															<input type="hidden" name="kode" id="kode"
																value="perminggu">
															<div class="row">
															<div class="col-md-4">
																	<div class="form-group">
																		<label for="hari">Hari</label>
																		<select style="width:100%" class="form-control select2"
																			name="hari" id="hari2" required="">
																			<option value="">Pilih Hari</option>
																			<option value="01-07">1-7</option>
																			<option value="08-14">8-14</option>
																			<option value="15-21">15-21</option>
																			<option value="22-31">22-31</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="bulan">Bulan</label>
																		<select style="width:100%" class="form-control select2"
																			name="bulan" id="bulan2" required="">
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
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="tahun">Tahun</label>
																		<select style="width:100%" class="form-control select2"
																			name="tahun" id="tahun2" required="">
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
																			value="Cetak Laporan"
																			class="btn btn-primary float-right">
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="tab-pane fade show active" id="perbulan" role="tabpanel"
												aria-labelledby="perbulan-tab">
												<div class="row">
													<div class="col-md-12">
														<form target="_blank" action="cetak-permintaan" method="POST"
															id="form_tambah">
															<input type="hidden" name="kode" id="kode"
																value="perbulan">
															<div class="row">
												<?php if($_SESSION['level'] == "Admin") { ?>
												<div class="col-md-6">
													<div class="form-group">
														<label for="nama_toko2">Data Toko</label>
															<?php
														$sql =  "SELECT * FROM tb_toko ORDER BY nama_toko ASC";
														?>
														<select class="form-control select2" name="nama_toko" id="nama_toko2" required="" style="width: 100%;">
															<option value="">Pilih Data Toko</option>															<option value="Semua Toko">Semua Toko</option>
															<?php
															$result = mysqli_query($conn, $sql);
															while ($data1 = mysqli_fetch_array($result)){
																echo '<option value="' . $data1['nama_toko'] . '">' . $data1['nama_toko'] . '</option>';   
															}  
															?>
														</select>
													</div>
												</div>
												<?php }else{ ?>
														<input type="hidden" name="nama_toko" id="nama_toko" class="form-control" required="" autocomplete="off" value="<?php echo $tampil_toko['nama_toko']; ?>">
												<?php } ?>
															<div class="col-md-6">
																	<div class="form-group">
																		<label for="bulan">Bulan</label>
																		<select style="width:100%" class="form-control select2"
																			name="bulan" id="bulan3" required="">
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
																		<select style="width:100%" class="form-control select2"
																			name="tahun" id="tahun3" required="">
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
																			value="Cetak Laporan"
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
														<form target="_blank" action="cetak-permintaan" method="POST"
															id="form_tambah">
															<input type="hidden" name="kode" id="kode"
																value="pertahun">
															<div class="row">
												<?php if($_SESSION['level'] == "Admin") { ?>
												<div class="col-md-6">
													<div class="form-group">
														<label for="nama_toko2">Data Toko</label>
															<?php
														$sql =  "SELECT * FROM tb_toko ORDER BY nama_toko ASC";
														?>
														<select class="form-control select2" name="nama_toko" id="nama_toko2" required="" style="width: 100%;">
															<option value="">Pilih Data Toko</option>															<option value="Semua Toko">Semua Toko</option>
															<?php
															$result = mysqli_query($conn, $sql);
															while ($data1 = mysqli_fetch_array($result)){
																echo '<option value="' . $data1['nama_toko'] . '">' . $data1['nama_toko'] . '</option>';   
															}  
															?>
														</select>
													</div>
												</div>
												<?php }else{ ?>
														<input type="hidden" name="nama_toko" id="nama_toko" class="form-control" required="" autocomplete="off" value="<?php echo $tampil_toko['nama_toko']; ?>">
												<?php } ?>
													<div class="col-md-6">
																	<div class="form-group">
																		<label for="tahun">Tahun</label>
																		<select style="width:100%" class="form-control select2"
																			name="tahun" id="tahun4" required="">
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
																			value="Cetak Laporan"
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
														<form target="_blank" action="cetak-permintaan" method="POST"
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
																			value="Cetak Laporan"
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
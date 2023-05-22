<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
<!-- penjumlahan -->
<script>

function sum() {
      var txtFirstNumberValue = document.getElementById('harga_permintaan').value;
      var txtFirstNumberValue = txtFirstNumberValue.split('.').join("");
      var txtSecondNumberValue = document.getElementById('jumlah_permintaan').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
        var number_string = result.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);
                
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        // var result = (result).toLocaleString('hi-IN');
         document.getElementById('total').value = rupiah;
      }else{
         document.getElementById('total').value = '';
      }
}
</script>
<!-- akhiran permintaan -->
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
						<h1>Tambah Data Permintaan Stok</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="permintaan">Data Permintaan Stok</a></div>
							<div class="breadcrumb-item">Tambah Data Permintaan Stok</div>
						</div>
					</div>

					<div class="row">
					<div class="col-md-6">
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
									<h4>Pilih Produk</h4>
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<?php
											$hasil = mysqli_query($conn, "SELECT max(id_permintaan) as maxKode FROM tb_permintaan");
											$data = mysqli_fetch_array($hasil);
											$kode = $data['maxKode'];
											$noUrut = (int) substr($kode, 4, 4);
											$noUrut++;
											$char = "MIN-";
											$kode = $char . sprintf("%04s", $noUrut);
											?>
											<input class="form-control" type="hidden" name="id_permintaan" value="<?php echo $kode;?>" readonly>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="id_produk">Pilih Produk</label>
														<?php
														$sql =  "SELECT * FROM tb_produk ORDER BY nama_produk ASC";
														?>
														<select class="form-control select2" name="id_produk" id="id_produk" required="" style="width: 100%;">
															<option value="">Pilih Produk</option>
															<?php
															$result = mysqli_query($conn, $sql);
															while ($data1 = mysqli_fetch_array($result)){
																echo '<option value="' . $data1['id_produk'] . '">' . $data1['nama_produk'] . '</option>';   
															}  
															?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="stok_produk">Stok Produk</label>
														<input type="text" name="stok_produk" id="stok_produk" class="form-control" required="" autocomplete="off" placeholder="Stok Produk" minlength="1" maxlength="100" readonly="">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="jumlah_permintaan">Jumlah Permintaan Stok</label>
														<input type="number" name="jumlah_permintaan" id="jumlah_permintaan" class="form-control" required="" autocomplete="off" placeholder="Jumlah Permintaan Stok" onkeyup="sum();">
													</div>
												</div>
											</div>

											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%">Simpan</button>
													<a href="permintaan" class="btn btn-warning" style="width:40%">Kembali</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>

					<div class="col-md-6">
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
									<h4>Isi Data Permintaan Stok</h4>
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form2">
											<input class="form-control" type="hidden" name="id_permintaan" value="<?php echo $kode;?>" readonly>
											<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal_permintaan">Tanggal Permintaan Stok</label>
										<input type="date" name="tanggal_permintaan" id="tanggal_permintaan" class="form-control" required="" autocomplete="off" placeholder="Tanggal Permintaan Stok" autofocus="" value="<?php echo date('Y-m-d'); ?>">
									</div>
								</div>
												<?php if($_SESSION['level'] == "Admin") { ?>
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
												<input type="hidden" name="status" id="status" class="form-control" required="" autocomplete="off" value="Setuju">
												<?php }else{ ?>
														<input type="hidden" name="id_toko" id="id_toko" class="form-control" required="" autocomplete="off" value="<?php echo $id_toko; ?>">
												<input type="hidden" name="status" id="status" class="form-control" required="" autocomplete="off" value="Permintaan">
												<div class="col-md-6">
													<div class="form-group">
														<label for="nama_pegawai">Nama Pegawai</label>
														<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" required="" autocomplete="off"  value="<?php echo $nama_pegawai;?>" placeholder="Nama Pegawai" readonly>
													</div>
												</div>
												<?php } ?>
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan_permintaan">Keterangan</label>
										<input type="text" name="keterangan_permintaan" id="keterangan_permintaan" class="form-control" required="" autocomplete="off" placeholder="Keterangan" minlength="1" maxlength="100">
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped" id="table-1">
											<thead>
												<tr>
													<th>Nomor</th>
													<th>Nama Produk</th>
													<th>Jumlah Permintaan Stok</th>
													<th>Hapus</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												$kueri = mysqli_query($conn, "SELECT * FROM tb_permintaanbantu,tb_produk WHERE tb_permintaanbantu.id_produk=tb_produk.id_produk AND id_permintaan='$kode'");
												while($tampil = mysqli_fetch_array($kueri)) {
													?>
													<tr>
														<td><?php echo $no++;?></td>
														<td><?php echo $tampil['nama_produk'];?></td>
														<td><?php echo $tampil['jumlah_permintaan'];?></td>
														<td style="white-space: nowrap;">
															<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_bantu'];?>"><i class="fas fa-trash-alt"></i></a>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
											</div>

											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:80%">Selesai</button>
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
        $("#id_produk").change(function(){
        var id_produk = $("#id_produk").val();
            $.ajax({
                type: 'GET',
                url: "get-produk.php",
                data: {id_produk: id_produk},
                cache: false,
                success: function(msg){
                   var json = msg,
                    obj = JSON.parse(json);
                    $('#harga_permintaan').val(obj.harga_permintaan);
                    $('#stok_produk').val(obj.stok_produk);
                }
            });
        });

     });
 </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/add-permintaanbantu.php",
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
								window.location = "tambah-permintaan";
							});
						}else if(dataresponse.status == "2") {
							swal('Peringatan', 'Maaf, Data sudah digunakan', 'error');
						}else if(dataresponse.status == "3") {
							swal('Peringatan', 'Maaf, Stok Tidak Mencukupi', 'error');
						}else {
							swal('Peringatan', 'Maaf, gagal menambah data', 'error');
						}
					}
				});
				return false;
			});
		});
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
						url: "proses/delete-permintaanbantu.php",
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
									window.location = "tambah-permintaan";
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


		<script type="text/javascript">
			$(document).ready(function() {
				$("#data-form2").submit(function(e) {
					e.preventDefault();
					var data = new FormData(this);
					$.ajax({
						type: "POST",
						url: "proses/add-permintaan.php",
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
									window.location = "permintaan";
								});
							}else if(dataresponse.status == "2") {
								swal('Peringatan', 'Pilih produk permintaan terlebih dahulu', 'error');
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
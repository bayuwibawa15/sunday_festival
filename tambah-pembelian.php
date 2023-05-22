<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
<!-- penjumlahan -->
<script>

function sum() {
      var txtFirstNumberValue = document.getElementById('harga_pembelian').value;
      var txtFirstNumberValue = txtFirstNumberValue.split('.').join("");
      var txtSecondNumberValue = document.getElementById('jumlah_pembelian').value;
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
<!-- akhiran pembelian -->
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
						<h1>Tambah Data Pembelian</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pembelian">Data Pembelian</a></div>
							<div class="breadcrumb-item">Tambah Data Pembelian</div>
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
											$hasil = mysqli_query($conn, "SELECT max(id_pembelian) as maxKode FROM tb_pembelian");
											$data = mysqli_fetch_array($hasil);
											$kode = $data['maxKode'];
											$noUrut = (int) substr($kode, 4, 4);
											$noUrut++;
											$char = "PEM-";
											$kode = $char . sprintf("%04s", $noUrut);
											?>
											<input class="form-control" type="hidden" name="id_pembelian" value="<?php echo $kode;?>" readonly>
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
														<label for="harga_pembelian">Harga Pembelian</label>
														<input type="text" name="harga_pembelian" id="harga_pembelian" class="form-control" required="" autocomplete="off" placeholder="Harga Pembelian" minlength="1" maxlength="100" readonly="" onkeyup="sum();">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="jumlah_pembelian">Jumlah Pembelian</label>
														<input type="number" name="jumlah_pembelian" id="jumlah_pembelian" class="form-control" required="" autocomplete="off" placeholder="Jumlah Pembelian" onkeyup="sum();">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="total">Total Harga</label>
														<input type="text" name="total" id="total" class="form-control" required="" autocomplete="off" placeholder="Total Harga" minlength="1" maxlength="100" readonly="">
													</div>
												</div>
											</div>

											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%">Simpan</button>
													<a href="pembelian" class="btn btn-warning" style="width:40%">Kembali</a>
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
									<h4>Isi Data Pembelian</h4>
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form2">
											<input class="form-control" type="hidden" name="id_pembelian" value="<?php echo $kode;?>" readonly>
											<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal_pembelian">Tanggal Pembelian</label>
										<input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" required="" autocomplete="off" placeholder="Tanggal Pembelian" autofocus="" value="<?php echo date('Y-m-d'); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="id_pemasok">Data Data Pemasok</label>
											<?php
										$sql =  "SELECT * FROM tb_pemasok ORDER BY nama_pemasok ASC";
										?>
										<select class="form-control select2" name="id_pemasok" id="id_pemasok" required="" style="width: 100%;">
											<option value="">Pilih Data Pemasok</option>
											<?php
											$result = mysqli_query($conn, $sql);
											while ($data1 = mysqli_fetch_array($result)){
												echo '<option value="' . $data1['id_pemasok'] . '">' . $data1['nama_pemasok'] . '</option>';   
											}  
											?>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan_pembelian">Keterangan</label>
										<input type="text" name="keterangan_pembelian" id="keterangan_pembelian" class="form-control" required="" autocomplete="off" placeholder="Keterangan" minlength="1" maxlength="100">
									</div>
								</div>
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
													<th>Hapus</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												$kueri = mysqli_query($conn, "SELECT * FROM tb_pembelianbantu,tb_produk WHERE tb_pembelianbantu.id_produk=tb_produk.id_produk AND id_pembelian='$kode'");
												while($tampil = mysqli_fetch_array($kueri)) {
													?>
													<tr>
														<td><?php echo $no++;?></td>
														<td><?php echo $tampil['nama_produk'];?></td>
														<td><?php echo number_format($tampil['harga_pembelian'],0,",",".");?></td>
														<td><?php echo $tampil['jumlah_pembelian'];?></td>
														<td><?php echo number_format($tampil['harga_pembelian']*$tampil['jumlah_pembelian'],0,",",".");?></td>
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
                    $('#harga_pembelian').val(obj.harga_pembelian);
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
					url: "proses/add-pembelianbantu.php",
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
								window.location = "tambah-pembelian";
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
						url: "proses/delete-pembelianbantu.php",
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
									window.location = "tambah-pembelian";
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
						url: "proses/add-pembelian.php",
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
									window.location = "pembelian";
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
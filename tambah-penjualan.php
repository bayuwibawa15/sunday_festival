<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
<!-- penjumlahan -->
<script>

function sum() {
      var txtFirstNumberValue = document.getElementById('harga_penjualan').value;
      var txtFirstNumberValue = txtFirstNumberValue.split('.').join("");
      var txtSecondNumberValue = document.getElementById('jumlah_penjualan').value;
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
<!-- akhiran penjualan -->
<style type="text/css">
.dtHorizontalExampleWrapper {
max-width: 600px;
margin: 0 auto;
}
#dtHorizontalExample th, td {
white-space: nowrap;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}
    </style>
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
						<h1>Tambah Data Penjualan</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="penjualan">Data Penjualan</a></div>
							<div class="breadcrumb-item">Tambah Data Penjualan</div>
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
											$hasil = mysqli_query($conn, "SELECT max(id_penjualan) as maxKode FROM tb_penjualan");
											$data = mysqli_fetch_array($hasil);
											$kode = $data['maxKode'];
											$noUrut = (int) substr($kode, 4, 4);
											$noUrut++;
											$char = "PEN-";
											$kode = $char . sprintf("%04s", $noUrut);
											?>
											<input class="form-control" type="hidden" name="id_penjualan" value="<?php echo $kode;?>" readonly>
											<input type="hidden" name="id_toko" id="id_toko" class="form-control" required="" autocomplete="off" value="<?php echo $id_toko; ?>">

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
														<label for="harga_penjualan">Harga Penjualan</label>
														<input type="text" name="harga_penjualan" id="harga_penjualan" class="form-control" required="" autocomplete="off" placeholder="Harga Produk" minlength="1" maxlength="100" readonly="" onkeyup="sum();">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="jumlah_penjualan">Jumlah Penjualan</label>
														<input type="number" name="jumlah_penjualan" id="jumlah_penjualan" class="form-control" required="" autocomplete="off" placeholder="Jumlah Penjualan" onkeyup="sum();">
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
													<a href="penjualan" class="btn btn-warning" style="width:40%">Kembali</a>
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
									<h4>Isi Data Penjualan</h4>
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form2">
											<input class="form-control" type="hidden" name="id_penjualan" value="<?php echo $kode;?>" readonly>
											<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal_penjualan">Tanggal Penjualan</label>
										<input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control" required="" autocomplete="off" placeholder="Tanggal Penjualan" autofocus="" value="<?php echo date('Y-m-d'); ?>">
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
												<?php }else{ ?>
														<input type="hidden" name="id_toko" id="id_toko" class="form-control" required="" autocomplete="off" value="<?php echo $id_toko; ?>">
												<input type="hidden" name="status" id="status" class="form-control" required="" autocomplete="off" value="Selesai">
												<div class="col-md-6">
													<div class="form-group">
														<label for="nama_pegawai">Nama Pegawai</label>
														<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" required="" autocomplete="off"  value="<?php echo $nama_pegawai;?>" placeholder="Nama Pegawai" readonly>
													</div>
												</div>
												<?php } ?>
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan_penjualan">Keterangan</label>
										<input type="text" name="keterangan_penjualan" id="keterangan_penjualan" class="form-control" required="" autocomplete="off" placeholder="Keterangan" minlength="1" maxlength="100">
									</div>
								</div>
								<div class="col-md-12">
									<div class="table-responsive">
									<table id="dtHorizontalExample" class="table table-bordered table-bordered table-sm" cellspacing="0" width="100%" border="3px">
											<thead>
												<tr>
													<th>Nomor</th>
													<th>Nama Produk</th>
													<th>Harga Produk</th>
													<th>Jumlah Penjualan</th>
													<th>Total</th>
													<th>Hapus</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												$total = 0;
												$kueri = mysqli_query($conn, "SELECT * FROM tb_penjualanbantu,tb_produk WHERE tb_penjualanbantu.id_produk=tb_produk.id_produk AND id_penjualan='$kode' AND status_penjualan='0'");
												while($tampil = mysqli_fetch_array($kueri)) {
													$total += $tampil['harga_penjualan']*$tampil['jumlah_penjualan'];
													?>
													<tr>
														<td><?php echo $no++;?></td>
														<td><?php echo $tampil['nama_produk'];?></td>
														<td><?php echo number_format($tampil['harga_penjualan'],0,",",".");?></td>
														<td><?php echo $tampil['jumlah_penjualan'];?></td>
														<td><?php echo number_format($tampil['harga_penjualan']*$tampil['jumlah_penjualan'],0,",",".");?></td>
														<td style="white-space: nowrap;">
															<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_bantu'];?>"><i class="fas fa-trash-alt"></i></a>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="total">Total</label>
										<input type="text" name="total" id="total" class="form-control" readonly value="<?php echo number_format($total,0,",",".");?>">
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
        var id_toko = <?php echo $id_toko; ?>;
            $.ajax({
                type: 'GET',
                url: "get-produktoko.php",
                data: {id_produk: id_produk, id_toko: id_toko},
                cache: false,
                success: function(msg){
                   var json = msg,
                    obj = JSON.parse(json);
                    $('#harga_penjualan').val(obj.harga_penjualan);
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
					url: "proses/add-penjualanbantu.php",
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
								window.location = "tambah-penjualan";
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
						url: "proses/delete-penjualanbantu.php",
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
									window.location = "tambah-penjualan";
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
						url: "proses/add-penjualan.php",
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
									window.location = "penjualan";
								});
							}else if(dataresponse.status == "2") {
								swal('Peringatan', 'Pilih produk penjualan terlebih dahulu', 'error');
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
		$(document).ready(function () {
		$('#dtHorizontalExample').DataTable({
		"scrollX": true
		});
		$('.dataTables_length').addClass('bs-select');
		});
	</script>
	</body>
	</html>
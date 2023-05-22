<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_penjualan,tb_pelanggan,tb_pegawai,tb_pengantaran WHERE tb_pelanggan.id_pelanggan=tb_penjualan.id_pelanggan AND tb_pegawai.id_pegawai=tb_pengantaran.id_pegawai AND tb_pengantaran.id_penjualan=tb_penjualan.id_penjualan AND id_pengantaran = '$id'");
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
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
						<h1>Detail Data Pengantaran</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="penjualan">Data Penjualan</a></div>
							<div class="breadcrumb-item">Detail Data Pengantaran</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											<input type="hidden" name="status_ubah" id="status_ubah" value="Antar">
											<div class="row">
											<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal_pengantaran">Tanggal Pengantaran</label>
										<input type="date" name="tanggal_pengantaran" id="tanggal_pengantaran" class="form-control" required="" autocomplete="off" placeholder="Tanggal Pengantaran" autofocus="" value="<?php echo $row['tanggal_pengantaran']; ?>">
									</div>
								</div>
								
												<div class="col-md-6">
													<div class="form-group">
														<label for="id_pegawai">Data Pegawai</label>
															<?php
														$sql =  "SELECT * FROM tb_pegawai WHERE id_toko='$id_toko' ORDER BY nama_pegawai ASC";
														?>
														<select class="form-control select2" name="id_pegawai" id="id_pegawai" required="" style="width: 100%;">
															<option value="">Pilih Pegawai</option>
															<?php
															$result = mysqli_query($conn, $sql);
															while ($data1 = mysqli_fetch_array($result)){
															?>
															<option value="<?php echo $data1['id_pegawai']; ?>" <?php if($row['id_pegawai'] == $data1['id_pegawai']) {echo "selected=''";} ?>><?php echo $data1['nama_pegawai']; ?></option>';
															<?php
															}
															?>
														</select>
													</div>
												</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="keterangan_pengantaran">Keterangan</label>
										<input type="text" name="keterangan_pengantaran" id="keterangan_pengantaran" class="form-control" required="" autocomplete="off" placeholder="Keterangan" minlength="1" maxlength="100" value="<?php echo $row['keterangan_pengantaran']; ?>">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="status">Status</label>
										<select class="form-control select2" name="status_pengantaran" id="status_pengantaran" required="" style="width: 100%;">
											<?php if($row['status_pengantaran'] == "Selesai") { ?>
												<option value="<?php echo $row['status_pengantaran'];?>" selected=""><?php echo $row['status_pengantaran'];?></option>
											<?php }else if($row['status_pengantaran'] == "Pengantaran") { ?>
												<option value="">Pilih Status</option>
												<option value="Selesai">Selesai</option>
											<?php } ?>
										</select>
									</div>
								</div>
								</div>

											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%" <?php if($row['status_pengantaran']=='Selesai'){ echo 'disabled'; }?>>Ubah</button>
													<a href="pengantaran" class="btn btn-warning" style="width:40%">Kembali</a>
												</div>
											</div>
										</form>
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
	$(document).ready(function() {
		bsCustomFileInput.init();
	});
	</script>
	<script type="text/javascript">
	function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("file1").files[0]);
		oFReader.onload = function(oFREvent) {
			document.getElementById("uploadPreview").src = oFREvent.target.result;
		}
	}
	</script>
	<script src="assets/dist/js/bs-custom-file-input.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			bsCustomFileInput.init();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-pengantaran.php",
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
								window.location = "pengantaran";
							});
						}else {
							if(dataresponse.type == "nomor_penjualan") {
								swal('Peringatan', 'Data Sudah Di Masukan', 'error');
							}else {
								swal('Peringatan', 'Maaf, gagal mengubah data', 'error');
							}
						}
					}
				});
				return false;
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
					url: "proses/update-penjualan.php",
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
        
        var rupiah1 = document.getElementById('harga_penjualan');
        rupiah1.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah1.value = formatRupiah(this.value, 'Rp. ');
        });
 
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah1          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah1 += separator + ribuan.join('.');
            }
 
            rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
            return prefix == undefined ? rupiah1 : (rupiah1 ? rupiah1 : '');
        }
    </script>

<script type="text/javascript">
        
        var rupiah2 = document.getElementById('harga_penjualan');
        rupiah2.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah2.value = formatRupiah(this.value, 'Rp. ');
        });
 
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            rupiah2          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah2 += separator + ribuan.join('.');
            }
 
            rupiah2 = split[1] != undefined ? rupiah2 + ',' + split[1] : rupiah2;
            return prefix == undefined ? rupiah2 : (rupiah2 ? rupiah2 : '');
        }
    </script>
</body>
</html>
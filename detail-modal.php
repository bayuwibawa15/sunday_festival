<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_modal WHERE id_modal = '$id'");
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
						<h1>Detail Data Modal</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="modal">Data Modal</a></div>
							<div class="breadcrumb-item">Detail Data Modal</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="keterangan_modal">Keterangan</label>
														<input type="text" name="keterangan_modal" id="keterangan_modal" class="form-control" required="" autocomplete="off" value="<?php echo $row['keterangan_modal'];?>" placeholder="Keterangan" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="jumlah_modal">Jumlah</label>
														<input type="text" name="jumlah_modal" id="jumlah_modal" class="form-control" required="" autocomplete="off" value="<?php echo number_format($row['jumlah_modal'],0,",",".");?>" placeholder="Harga Modal">
													</div>
												</div>
											</div>


											<div class="row" align="center">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary" style="width:40%">Ubah</button>
													<a href="modal" class="btn btn-warning" style="width:40%">Kembali</a>
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
					url: "proses/update-modal.php",
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
								window.location = "modal";
							});
						}else {
							if(dataresponse.type == "nomor_modal") {
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
					url: "proses/update-modal.php",
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
								window.location = "modal";
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
        
        var rupiah1 = document.getElementById('jumlah_modal');
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
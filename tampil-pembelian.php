<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
	<?php 
	include 'menu/head.php'; 
	if($_POST['kode'] == "perbulan") {
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
if($_POST['bulan'] == "01") {
$bulan='Januari';
}elseif($_POST['bulan'] == "02") {
$bulan='Febuari';
}elseif($_POST['bulan'] == "03") {
$bulan='Maret';
}elseif($_POST['bulan'] == "04") {
$bulan='April';
}elseif($_POST['bulan'] == "05") {
$bulan='Mei';
}elseif($_POST['bulan'] == "06") {
$bulan='Juni';
}elseif($_POST['bulan'] == "07") {
$bulan='Juli';
}elseif($_POST['bulan'] == "08") {
$bulan='Agustus';
}elseif($_POST['bulan'] == "09") {
$bulan='September';
}elseif($_POST['bulan'] == "10") {
$bulan='Oktober';
}elseif($_POST['bulan'] == "11") {
$bulan='November';
}elseif($_POST['bulan'] == "12") {
$bulan='Desember';
}
$filter=$bulan.' '.$tahun;
}elseif($_POST['kode'] == "pertahun") {
	$tahun = $_POST['tahun'];
	$filter=$tahun;
	}else{
		$from = $_POST['from'];
		$to = $_POST['to'];
$filter=date('d-m-Y',strtotime($from)).' - '.date('d-m-Y',strtotime($to));
}
	?>
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
						<h1>Grafik Pembelian <?php echo $filter; ?></h1>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
									<form action="" method="GET">
											<div class="row">
																<div class="col-12 col-md-12 col-lg-12">
																<div class="card">
																	<div class="card-header">
																		<!-- <h4>Grafik Tabungan Sampah Terbanyak Per Kategori <?php echo date('Y'); ?></h4> -->
																	</div>
																	<div class="card-body">
																		<canvas id="myChart1"></canvas>
																	</div>
																</div>
																</div>
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
	<script type="text/javascript">
		"use strict";
		<?php
		$column1 = array();
		$column2 = array();
		$column3 = array();
		$column4 = array();
		// $tahun = date('Y');
		// $bulan = '07';

		// $query2 = mysqli_query($conn, "SELECT * FROM tb_penjualanbantu,tb_produk, tb_penjualan, tb_pelanggan WHERE tb_pelanggan.id_pelanggan=tb_penjualan.id_pelanggan AND tb_penjualan.id_penjualan=tb_penjualanbantu.id_penjualan AND tb_penjualanbantu.id_produk=tb_produk.id_produk AND tanggal_penjualan LIKE '$tahun-$bulan%' GROUP BY nama_produk ORDER BY tanggal_penjualan ASC");
		// while($row2 = mysqli_fetch_array($query2)) {
	if($_POST['kode'] == "perbulan") {
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
				for($x=1;$x<=date('t', strtotime($bulan));$x++){
				if($x < 10) {
				$filter_hari='0'.$x;
				}else{
				$filter_hari=$x;
				}
			$ket = 'Tanggal';

		// $sql_komen = "SELECT COUNT(*) AS komen FROM tb_bantukomentar,tb_bantu WHERE tb_bantu.kode=tb_bantukomentar.kode AND tanggal_komentar LIKE '$_POST[tahun]%' AND id_dinas='$row2[id_dinas]' AND jenis='$row2[jenis]'";
		$sql_penjualan = mysqli_query($conn, "SELECT *, SUM(tb_pembelianbantu.harga_pembelian*jumlah_pembelian) AS jumlah FROM tb_pembelianbantu,tb_produk, tb_pembelian WHERE tb_pembelian.id_pembelian=tb_pembelianbantu.id_pembelian AND tb_pembelianbantu.id_produk=tb_produk.id_produk AND tanggal_pembelian LIKE '$tahun-$bulan-$filter_hari' GROUP BY nama_produk ORDER BY date(tanggal_pembelian) DESC");
		$total_penjualan = mysqli_fetch_array($sql_penjualan);

		// $sql_pembelian = mysqli_query($conn, "SELECT SUM(harga_pembelian*jumlah_pembelian) AS total FROM tb_pembelian, tb_pembelianbantu WHERE tb_pembelianbantu.id_pembelian=tb_pembelian.id_pembelian AND tanggal_pembelian LIKE '$tahun-$bulan-$filter_hari'");
		// $total_pembelian = mysqli_fetch_array($sql_pembelian);


			$column1[] = "'".$x."'";
			$column2[] = $total_penjualan['jumlah'];
			// $column3[] = $total_pembelian['total'];
			// $column3[] = $total_komen['komen'];
		}
	}elseif($_POST['kode'] == "pertahun") {
		$tahun = $_POST['tahun'];
		for($x=1;$x<=12;$x++){
			if($x == "1") {
			$bulan='Januari';
			$filter_bulan='01';
			}elseif($x == "2") {
			$bulan='Febuari';
			$filter_bulan='02';
			}elseif($x == "3") {
			$bulan='Maret';
			$filter_bulan='03';
			}elseif($x == "4") {
			$bulan='April';
			$filter_bulan='04';
			}elseif($x == "5") {
			$bulan='Mei';
			$filter_bulan='05';
			}elseif($x == "6") {
			$bulan='Juni';
			$filter_bulan='06';
			}elseif($x == "7") {
			$bulan='Juli';
			$filter_bulan='07';
			}elseif($x == "8") {
			$bulan='Agustus';
			$filter_bulan='08';
			}elseif($x == "9") {
			$bulan='September';
			$filter_bulan='09';
			}elseif($x == "10") {
			$bulan='Oktober';
			$filter_bulan='10';
			}elseif($x == "11") {
			$bulan='November';
			$filter_bulan='11';
			}elseif($x == "12") {
			$bulan='Desember';
			$filter_bulan='12';
			}
			$ket = 'Bulan';
		// $sql_komen = "SELECT COUNT(*) AS komen FROM tb_bantukomentar,tb_bantu WHERE tb_bantu.kode=tb_bantukomentar.kode AND tanggal_komentar LIKE '$_POST[tahun]%' AND id_dinas='$row2[id_dinas]' AND jenis='$row2[jenis]'";
		$sql_penjualan = mysqli_query($conn, "SELECT *, SUM(tb_pembelianbantu.harga_pembelian*jumlah_pembelian) AS jumlah FROM tb_pembelianbantu,tb_produk, tb_pembelian WHERE tb_pembelian.id_pembelian=tb_pembelianbantu.id_pembelian AND tb_pembelianbantu.id_produk=tb_produk.id_produk AND tanggal_pembelian LIKE '$tahun-$filter_bulan%' GROUP BY nama_produk ORDER BY date(tanggal_pembelian) DESC");
		$total_penjualan = mysqli_fetch_array($sql_penjualan);

		// $sql_pembelian = mysqli_query($conn, "SELECT SUM(harga_pembelian*jumlah_pembelian) AS total FROM tb_pembelian, tb_pembelianbantu WHERE tb_pembelianbantu.id_pembelian=tb_pembelian.id_pembelian AND tanggal_pembelian LIKE '$tahun-$bulan-$filter_hari'");
		// $total_pembelian = mysqli_fetch_array($sql_pembelian);


			$column1[] = "'".$bulan."'";
			$column2[] = $total_penjualan['jumlah'];
			// $column3[] = $total_pembelian['total'];
			// $column3[] = $total_komen['komen'];
				}
	}
		$datas1 = implode (", ", $column1);
		$datas2 = implode (", ", $column2);
		// $datas3 = implode (", ", $column3);
		// $datas3 = implode (", ", $column3);
		?>
		var ctx = document.getElementById("myChart1").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [<?php echo $datas1;?>],
				datasets: [
				{
					label: 'Jumlah Pembelian',
					data: [<?php echo $datas2;?>],
					backgroundColor: '#6777ef',
					borderColor: '#6777ef',
					borderWidth: 2.5,
					pointBackgroundColor: '#ffffff',
					pointRadius: 4
				},
				],
			},
			options: {
tooltips: {
					callbacks: {
						label: function(tooltipItem, data) {
							var value = data.datasets[0].data[tooltipItem.index];
							value = value.toString();
							value = value.split(/(?=(?:...)*$)/);
							value = value.join(',');
							return value;
						}
					}
				},
				scales: {
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Total Pembelian'
						},
						ticks: {
							beginAtZero:true,
							userCallback: function(value, index, values) {
							value = value.toString();
							value = value.split(/(?=(?:...)*$)/);
							value = value.join(',');
							return value;
						}
					}
				}],
				xAxes: [{
					scaleLabel: {
							display: true,
							labelString: '<?php echo $ket; ?>'
						},
					ticks: {
					}
				}]
			}
			}
		});
	</script>
</body>
</html>
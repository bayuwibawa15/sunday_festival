<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
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
						<h1>Beranda</h1>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
										<h3>Data Penjualan Toko Bulan Ini</h3>
										</div>
										<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th>Nomor</th>
														<th>Bulan</th>
														<th>Nama Toko</th>
														<th>Jumlah Penjualan</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													$bulan = date('m');
													$tahun = date('Y');
													$kueri = mysqli_query($conn, "SELECT *,SUM(jumlah_penjualan*harga_penjualan) AS total FROM tb_penjualanbantu, tb_toko, tb_penjualan WHERE tb_penjualan.id_penjualan=tb_penjualanbantu.id_penjualan AND tb_toko.id_toko=tb_penjualanbantu.id_toko AND tanggal_penjualan LIKE '$tahun-$bulan%' GROUP BY nama_toko ORDER BY nama_toko ASC");
													while($tampil = mysqli_fetch_array($kueri)) {
														?>
														<tr>
															<td><?php echo $no++;?></td>
															<td><?php echo tglIndonesia(date('F'));?></td>
															<td><?php echo $tampil['nama_toko'];?></td>
															<td><?php echo 'Rp. '; echo number_format($tampil['total'],0,",",".");?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
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

<script type="text/javascript">

function getRandomColor() {

	var letters = '0123456789ABCDEF'.split('');

	var color = '#';

	for (var i = 0; i < 6; i++ ) {

		color += letters[Math.floor(Math.random() * 16)];

	}

	return color;

}



"use strict";

<?php

$tahun = date('Y');

$bulan = date('m');

$column1 = array();

$column2 = array();

$column3 = array();

$column4 = array();

if(($_SESSION['level'] == "Admin") || ($_SESSION['level'] == 'Petugas')) {
$query1 = mysqli_query($conn, "SELECT *, COUNT(*) AS total FROM tb_distribusi, tb_pelanggan, tb_tugas,tb_pengguna WHERE tb_pelanggan.id_pelanggan=tb_tugas.id_pelanggan AND tb_tugas.id_tugas=tb_distribusi.id_tugas AND tb_tugas.id_pengguna=tb_pengguna.id_pengguna AND  tanggal_distribusi LIKE '$tahun-$bulan%' GROUP BY tb_pengguna.id_pengguna");
}else{
$query1 = mysqli_query($conn, "SELECT *, COUNT(*) AS total FROM tb_distribusi, tb_pelanggan, tb_tugas,tb_pengguna WHERE tb_pelanggan.id_pelanggan=tb_tugas.id_pelanggan AND tb_tugas.id_tugas=tb_distribusi.id_tugas AND tb_tugas.id_pengguna=tb_pengguna.id_pengguna AND tb_pengguna.id_pengguna='$_SESSION[userid]' AND  tanggal_distribusi LIKE '$tahun-$bulan%' GROUP BY tb_pengguna.id_pengguna");
}

while($row1 = mysqli_fetch_array($query1)) {



	$column1[] = "'".$row1['nama_lengkap']."'";

	$column2[] = $row1['total'];

// $column3[] = $total_komen['komen'];

}

$datas1 = implode (", ", $column1);

$datas2 = implode (", ", $column2);



$periode_tanggal = [];

$arrLengkap = [];

$arrData = [];



$tanggal_start = strtotime(date('Y')."-01-01");

$tanggal_end = strtotime(date('Y')."-12-31");



$awal = date('Y-m-d', $tanggal_start);

$akhir = date('Y-m-d', $tanggal_end + 86400);



$start = new DateTime($awal);

$end = new DateTime($akhir);





$interval = DateInterval::createFromDateString('1 month');

$periode   = new DatePeriod($start, $interval, $end);



foreach ($periode as $dt) {

	$periode_tanggal[$dt->format("Y-m")] = tglIndonesia(date('F', strtotime($dt->format("Y-m-d"))));

}


if(($_SESSION['level'] == "Admin") || ($_SESSION['level'] == 'Petugas')) {
	$getLengkap = mysqli_query($conn, "SELECT tb_pengguna.nama_lengkap, tb_pengguna.id_pengguna FROM tb_distribusi, tb_pelanggan, tb_tugas,tb_pengguna WHERE tb_pelanggan.id_pelanggan=tb_tugas.id_pelanggan AND tb_tugas.id_tugas=tb_distribusi.id_tugas AND tb_tugas.id_pengguna=tb_pengguna.id_pengguna AND tb_distribusi.tanggal_distribusi LIKE '$tahun%' GROUP BY tb_pengguna.id_pengguna");
}else{
	$getLengkap = mysqli_query($conn, "SELECT tb_pengguna.nama_lengkap, tb_pengguna.id_pengguna FROM tb_distribusi, tb_pelanggan, tb_tugas,tb_pengguna WHERE tb_pelanggan.id_pelanggan=tb_tugas.id_pelanggan AND tb_tugas.id_tugas=tb_distribusi.id_tugas AND tb_tugas.id_pengguna=tb_pengguna.id_pengguna AND tb_pengguna.id_pengguna='$_SESSION[userid]' AND tb_distribusi.tanggal_distribusi LIKE '$tahun%' GROUP BY tb_pengguna.id_pengguna");
}

while($rowLengkap = mysqli_fetch_array($getLengkap)) {

	$arrLengkap[$rowLengkap['id_pengguna']] = $rowLengkap['nama_lengkap'];

}



$key = 0;

if(($_SESSION['level'] == "Admin") || ($_SESSION['level'] == 'Petugas')) {
	$getData = mysqli_query($conn, "SELECT COUNT(*) AS total, tb_pengguna.id_pengguna, DATE_FORMAT(tb_distribusi.tanggal_distribusi, '%Y-%m') AS tanggal FROM tb_distribusi JOIN tb_tugas ON tb_distribusi.id_tugas = tb_tugas.id_tugas JOIN tb_pengguna ON tb_tugas.id_pengguna = tb_pengguna.id_pengguna WHERE tb_distribusi.tanggal_distribusi LIKE '$tahun%' GROUP BY tb_pengguna.id_pengguna, DATE_FORMAT(tb_distribusi.tanggal_distribusi, '%Y-%m') ORDER BY DATE_FORMAT(tb_distribusi.tanggal_distribusi, '%Y-%m')");
}else{
	$getData = mysqli_query($conn, "SELECT COUNT(*) AS total, tb_pengguna.id_pengguna, DATE_FORMAT(tb_distribusi.tanggal_distribusi, '%Y-%m') AS tanggal FROM tb_distribusi JOIN tb_tugas ON tb_distribusi.id_tugas = tb_tugas.id_tugas JOIN tb_pengguna ON tb_tugas.id_pengguna = tb_pengguna.id_pengguna WHERE tb_distribusi.tanggal_distribusi LIKE '$tahun%' GROUP BY tb_pengguna.id_pengguna, DATE_FORMAT(tb_distribusi.tanggal_distribusi, '%Y-%m') ORDER BY DATE_FORMAT(tb_distribusi.tanggal_distribusi, '%Y-%m')");
}

while($rowData = mysqli_fetch_array($getData)) {

	$arrData[$key]['id_pengguna'] = $rowData['id_pengguna'];

	$arrData[$key]['tanggal_distribusi'] = $rowData['tanggal_distribusi'];

	$arrData[$key]['total'] = $rowData['total'];

	$key++;

}



$arrCampuran = [];

$i = 0;

foreach ($arrLengkap as $key1 => $value1) {

	$arrCampuran[$i]['label'] = $value1;

	$arrCampuran[$i]['borderWidth'] = 2;

	$arrCampuran[$i]['backgroundColor'] = 'rgba(254, 86, 83, .7)';

	$arrCampuran[$i]['borderColor'] = 'transparent';

	$arrCampuran[$i]['borderWidth'] = 2;

	$arrCampuran[$i]['pointBackgroundColor'] = '#ffffff';

	$arrCampuran[$i]['pointRadius'] = 4;

	foreach ($periode_tanggal as $key2 => $value2) {

		$total = 0;

		foreach ($arrData as $key3 => $value3) {

			if($value3['id_pengguna'] == $key1 && $value3['tanggal_distribusi'] == $key2) {

				$total += $value3['total'];

			}

		}

		$arrCampuran[$i]['data'][] = $total;

	}

	$i++;

}

foreach ($periode_tanggal as $key => $value) {

	$arrTanggal[] = "'".$value."'";

}

$arrTanggal = implode(", ", $arrTanggal);

$a = 0;

foreach ($arrCampuran as $key => $value) {

	$arrCampuran[$a]['data_implode'] = implode(", ", array_map('intval', $value['data']));

	$a++;

}

?>



var myArray = <?php echo json_encode($arrCampuran);?>;



var a = [];

for(var i = 0; i < myArray.length; i++) {

	var digits = myArray[i].data.toString().split(",");

	var realDigits = digits.map(Number)

	var dataFirst = {

		label: myArray[i].label,

		data: realDigits,

		backgroundColor: getRandomColor(),

		borderColor: 'transparent',

		borderWidth: 2.5,

		pointBackgroundColor: '#ffffff',

		pointRadius: 4

	}

	a.push(dataFirst);

}





var ctx = document.getElementById("myChart2").getContext('2d');

var myChart = new Chart(ctx, {

	type: 'bar',

	data: {

		labels: [<?php echo $arrTanggal;?>],

		datasets: a,

	},

	options: {

		tooltips: {

			callbacks: {

				label: function(tooltipItem, data) {

					return data.datasets[tooltipItem.datasetIndex].label + ": " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {

						return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;

					});

				}

			}

		},

		scales: {

			yAxes: [{

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

				ticks: {

				}

			}]

		}

	}

});

</script>
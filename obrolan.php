<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
	<?php include 'menu/head.php'; ?>


	<style type="text/css">
		.direct-chat .card-body {
			overflow-x: hidden;
			padding: 0;
			position: relative
		}

		.direct-chat.chat-pane-open .direct-chat-contacts {
			-webkit-transform: translate(0, 0);
			transform: translate(0, 0)
		}

		.direct-chat.timestamp-light .direct-chat-timestamp {
			color: #30465f
		}

		.direct-chat.timestamp-dark .direct-chat-timestamp {
			color: #ccc
		}

		.direct-chat-messages {
			-webkit-transform: translate(0, 0);
			transform: translate(0, 0);
			height: 250px;
			overflow: auto;
			padding: 10px
		}

		.direct-chat-msg,
		.direct-chat-text {
			display: block
		}

		.direct-chat-msg {
			margin-bottom: 10px
		}

		.direct-chat-msg::after {
			display: block;
			clear: both;
			content: ""
		}

		.direct-chat-contacts,
		.direct-chat-messages {
			transition: -webkit-transform .5s ease-in-out;
			transition: transform .5s ease-in-out;
			transition: transform .5s ease-in-out, -webkit-transform .5s ease-in-out
		}

		.direct-chat-text {
			border-radius: .3rem;
			background: #d2d6de;
			border: 1px solid #d2d6de;
			color: #444;
			margin: 5px 0 0 50px;
			padding: 5px 10px;
			position: relative
		}

		.direct-chat-text::after,
		.direct-chat-text::before {
			border: solid transparent;
			border-right-color: #d2d6de;
			content: ' ';
			height: 0;
			pointer-events: none;
			position: absolute;
			right: 100%;
			top: 15px;
			width: 0
		}

		.direct-chat-text::after {
			border-width: 5px;
			margin-top: -5px
		}

		.direct-chat-text::before {
			border-width: 6px;
			margin-top: -6px
		}

		.right .direct-chat-text {
			margin-left: 0;
			margin-right: 50px
		}

		.right .direct-chat-text::after,
		.right .direct-chat-text::before {
			border-left-color: #d2d6de;
			border-right-color: transparent;
			left: 100%;
			right: auto
		}

		.direct-chat-img {
			border-radius: 50%;
			float: left;
			height: 40px;
			width: 40px
		}

		.right .direct-chat-img {
			float: right
		}

		.direct-chat-infos {
			display: block;
			font-size: .875rem;
			margin-bottom: 2px
		}

		.direct-chat-name {
			font-weight: 600
		}

		.direct-chat-timestamp {
			color: #697582
		}

		.direct-chat-contacts-open .direct-chat-contacts {
			-webkit-transform: translate(0, 0);
			transform: translate(0, 0)
		}

		.direct-chat-contacts {
			-webkit-transform: translate(101%, 0);
			transform: translate(101%, 0);
			background: #343a40;
			bottom: 0;
			color: #fff;
			height: 250px;
			overflow: auto;
			position: absolute;
			top: 0;
			width: 100%
		}

		.direct-chat-contacts-light {
			background: #f8f9fa
		}

		.direct-chat-contacts-light .contacts-list-name {
			color: #495057
		}

		.direct-chat-contacts-light .contacts-list-date {
			color: #6c757d
		}

		.direct-chat-contacts-light .contacts-list-msg {
			color: #545b62
		}

		.contacts-list {
			padding-left: 0;
			list-style: none
		}

		.contacts-list>li {
			border-bottom: 1px solid rgba(0, 0, 0, .2);
			margin: 0;
			padding: 10px
		}

		.contacts-list>li::after {
			display: block;
			clear: both;
			content: ""
		}

		.contacts-list>li:last-of-type {
			border-bottom: 0
		}

		.contacts-list-img {
			border-radius: 50%;
			float: left;
			width: 40px
		}

		.contacts-list-info {
			color: #fff;
			margin-left: 45px
		}

		.contacts-list-name,
		.contacts-list-status {
			display: block
		}

		.contacts-list-name {
			font-weight: 600
		}

		.contacts-list-status {
			font-size: .875rem
		}

		.contacts-list-date {
			color: #ced4da;
			font-weight: 400
		}

		.contacts-list-msg {
			color: #b1bbc4
		}

		.direct-chat-primary .right>.direct-chat-text {
			background: #007bff;
			border-color: #007bff;
			color: #fff
		}

		.direct-chat-primary .right>.direct-chat-text::after,
		.direct-chat-primary .right>.direct-chat-text::before {
			border-left-color: #007bff
		}

		.direct-chat-secondary .right>.direct-chat-text {
			background: #6c757d;
			border-color: #6c757d;
			color: #fff
		}

		.direct-chat-secondary .right>.direct-chat-text::after,
		.direct-chat-secondary .right>.direct-chat-text::before {
			border-left-color: #6c757d
		}

		.direct-chat-success .right>.direct-chat-text {
			background: #28a745;
			border-color: #28a745;
			color: #fff
		}

		.direct-chat-success .right>.direct-chat-text::after,
		.direct-chat-success .right>.direct-chat-text::before {
			border-left-color: #28a745
		}

		.direct-chat-info .right>.direct-chat-text {
			background: #17a2b8;
			border-color: #17a2b8;
			color: #fff
		}

		.direct-chat-info .right>.direct-chat-text::after,
		.direct-chat-info .right>.direct-chat-text::before {
			border-left-color: #17a2b8
		}

		.direct-chat-warning .right>.direct-chat-text {
			background: #ffc107;
			border-color: #ffc107;
			color: #1f2d3d
		}

		.direct-chat-warning .right>.direct-chat-text::after,
		.direct-chat-warning .right>.direct-chat-text::before {
			border-left-color: #ffc107
		}

		.direct-chat-danger .right>.direct-chat-text {
			background: #dc3545;
			border-color: #dc3545;
			color: #fff
		}

		.direct-chat-danger .right>.direct-chat-text::after,
		.direct-chat-danger .right>.direct-chat-text::before {
			border-left-color: #dc3545
		}

		.direct-chat-light .right>.direct-chat-text {
			background: #f8f9fa;
			border-color: #f8f9fa;
			color: #1f2d3d
		}

		.direct-chat-light .right>.direct-chat-text::after,
		.direct-chat-light .right>.direct-chat-text::before {
			border-left-color: #f8f9fa
		}

		.direct-chat-dark .right>.direct-chat-text {
			background: #343a40;
			border-color: #343a40;
			color: #fff
		}

		.direct-chat-dark .right>.direct-chat-text::after,
		.direct-chat-dark .right>.direct-chat-text::before {
			border-left-color: #343a40
		}

		.direct-chat-lightblue .right>.direct-chat-text {
			background: #3c8dbc;
			border-color: #3c8dbc;
			color: #fff
		}

		.direct-chat-lightblue .right>.direct-chat-text::after,
		.direct-chat-lightblue .right>.direct-chat-text::before {
			border-left-color: #3c8dbc
		}

		.direct-chat-navy .right>.direct-chat-text {
			background: #001f3f;
			border-color: #001f3f;
			color: #fff
		}

		.direct-chat-navy .right>.direct-chat-text::after,
		.direct-chat-navy .right>.direct-chat-text::before {
			border-left-color: #001f3f
		}

		.direct-chat-olive .right>.direct-chat-text {
			background: #3d9970;
			border-color: #3d9970;
			color: #fff
		}

		.direct-chat-olive .right>.direct-chat-text::after,
		.direct-chat-olive .right>.direct-chat-text::before {
			border-left-color: #3d9970
		}

		.direct-chat-lime .right>.direct-chat-text {
			background: #01ff70;
			border-color: #01ff70;
			color: #1f2d3d
		}

		.direct-chat-lime .right>.direct-chat-text::after,
		.direct-chat-lime .right>.direct-chat-text::before {
			border-left-color: #01ff70
		}

		.direct-chat-fuchsia .right>.direct-chat-text {
			background: #f012be;
			border-color: #f012be;
			color: #fff
		}

		.direct-chat-fuchsia .right>.direct-chat-text::after,
		.direct-chat-fuchsia .right>.direct-chat-text::before {
			border-left-color: #f012be
		}

		.direct-chat-maroon .right>.direct-chat-text {
			background: #d81b60;
			border-color: #d81b60;
			color: #fff
		}

		.direct-chat-maroon .right>.direct-chat-text::after,
		.direct-chat-maroon .right>.direct-chat-text::before {
			border-left-color: #d81b60
		}

		.direct-chat-blue .right>.direct-chat-text {
			background: #007bff;
			border-color: #007bff;
			color: #fff
		}

		.direct-chat-blue .right>.direct-chat-text::after,
		.direct-chat-blue .right>.direct-chat-text::before {
			border-left-color: #007bff
		}

		.direct-chat-indigo .right>.direct-chat-text {
			background: #6610f2;
			border-color: #6610f2;
			color: #fff
		}

		.direct-chat-indigo .right>.direct-chat-text::after,
		.direct-chat-indigo .right>.direct-chat-text::before {
			border-left-color: #6610f2
		}

		.direct-chat-purple .right>.direct-chat-text {
			background: #6f42c1;
			border-color: #6f42c1;
			color: #fff
		}

		.direct-chat-purple .right>.direct-chat-text::after,
		.direct-chat-purple .right>.direct-chat-text::before {
			border-left-color: #6f42c1
		}

		.direct-chat-pink .right>.direct-chat-text {
			background: #e83e8c;
			border-color: #e83e8c;
			color: #fff
		}

		.direct-chat-pink .right>.direct-chat-text::after,
		.direct-chat-pink .right>.direct-chat-text::before {
			border-left-color: #e83e8c
		}

		.direct-chat-red .right>.direct-chat-text {
			background: #dc3545;
			border-color: #dc3545;
			color: #fff
		}

		.direct-chat-red .right>.direct-chat-text::after,
		.direct-chat-red .right>.direct-chat-text::before {
			border-left-color: #dc3545
		}

		.direct-chat-orange .right>.direct-chat-text {
			background: #fd7e14;
			border-color: #fd7e14;
			color: #1f2d3d
		}

		.direct-chat-orange .right>.direct-chat-text::after,
		.direct-chat-orange .right>.direct-chat-text::before {
			border-left-color: #fd7e14
		}

		.direct-chat-yellow .right>.direct-chat-text {
			background: #ffc107;
			border-color: #ffc107;
			color: #1f2d3d
		}

		.direct-chat-yellow .right>.direct-chat-text::after,
		.direct-chat-yellow .right>.direct-chat-text::before {
			border-left-color: #ffc107
		}

		.direct-chat-green .right>.direct-chat-text {
			background: #28a745;
			border-color: #28a745;
			color: #fff
		}

		.direct-chat-green .right>.direct-chat-text::after,
		.direct-chat-green .right>.direct-chat-text::before {
			border-left-color: #28a745
		}

		.direct-chat-teal .right>.direct-chat-text {
			background: #20c997;
			border-color: #20c997;
			color: #fff
		}

		.direct-chat-teal .right>.direct-chat-text::after,
		.direct-chat-teal .right>.direct-chat-text::before {
			border-left-color: #20c997
		}

		.direct-chat-cyan .right>.direct-chat-text {
			background: #17a2b8;
			border-color: #17a2b8;
			color: #fff
		}

		.direct-chat-cyan .right>.direct-chat-text::after,
		.direct-chat-cyan .right>.direct-chat-text::before {
			border-left-color: #17a2b8
		}

		.direct-chat-white .right>.direct-chat-text {
			background: #fff;
			border-color: #fff;
			color: #1f2d3d
		}

		.direct-chat-white .right>.direct-chat-text::after,
		.direct-chat-white .right>.direct-chat-text::before {
			border-left-color: #fff
		}

		.direct-chat-gray .right>.direct-chat-text {
			background: #6c757d;
			border-color: #6c757d;
			color: #fff
		}

		.direct-chat-gray .right>.direct-chat-text::after,
		.direct-chat-gray .right>.direct-chat-text::before {
			border-left-color: #6c757d
		}

		.direct-chat-gray-dark .right>.direct-chat-text {
			background: #343a40;
			border-color: #343a40;
			color: #fff
		}

		.direct-chat-gray-dark .right>.direct-chat-text::after,
		.direct-chat-gray-dark .right>.direct-chat-text::before {
			border-left-color: #343a40
		}
	</style>
	<script type="text/javascript">
		function ajax() {
			var kodePenerima = $('#penerimakode').val();
			var kodePengirim = $('#pengirimkode').val();

			var data = { 'kodePenerima': kodePenerima, 'kodePengirim': kodePengirim};

			if(window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			}else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("tampil-obrolan").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("POST","proses/get-obrolan.php", true);
			xmlhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
			xmlhttp.send(JSON.stringify(data));
			setTimeout("ajax()", 1000);
		}
	</script>
</head>
<body <?php if($_SESSION['level'] == "Admin") { ?> onload="ajax()" <?php } ?>>
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
							<h1>Live Chat</h1>
					</div>
					<?php if($_SESSION['level'] == "Admin") { ?>
						<div class="section-body">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-striped" id="table-1">
													<thead>
														<tr>
															<th>No</th>
															<th>Tanggal</th>
															<th>Nama Toko</th>
															<th>Aksi</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$no = 1;
														$kodeid = 'admin';
														$kueri = mysqli_query($conn, "SELECT c.*, s.* FROM tb_chat c INNER JOIN tb_toko s ON c.id_pengirim = s.id_toko WHERE c.id_penerima = '$kodeid' AND c.id_pengirim != '$kodeid' GROUP BY c.id_pengirim ORDER BY c.created DESC");
														while($tampil = mysqli_fetch_array($kueri)) {
															?>
															<tr>
																<td><?php echo $no++;?></td>
																<!-- <td><?php echo $tampil['nis'];?></td> -->
																<td><?php echo tglIndonesia(date('d F Y', strtotime($tampil['created'])));?></td>
																<td><?php echo $tampil['nama_toko'];?></td>
																<td style="white-space: nowrap;">
																	<a href="" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $tampil['kode'];?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
																	<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_pengirim'];?>"><i class="fas fa-trash-alt"></i></a>
																</td>
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
					<?php } ?>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
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
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Detail Obrolan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="direct-chat direct-chat-primary">
						<div class="direct-chat-messages">
							<div id="tampil-obrolan"></div>
						</div>
					</div>
					<form method="POST" class="form-user">
						<div class="input-group">
							<?php if($_SESSION['level'] == "Admin") { ?>
								<input type="hidden" name="penerimakode" id="penerimakode">
								<input type="hidden" name="pengirimkode" id="pengirimkode" value="admin">
							<?php }else {  ?>
								<input type="hidden" name="penerimakode" id="penerimakode" value="admin">
								<input type="hidden" name="pengirimkode" id="pengirimkode">
							<?php } ?>
							<input type="text" name="isi" id="isi" placeholder="Tulis Pesan" autocomplete="off" class="form-control pesan-obrolan" required="">
							<span class="input-group-append">
								<button type="submit" class="btn btn-primary">Kirim</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#exampleModal').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('id');
				$.ajax({
					type : 'post',
					url : 'proses/get-pengirim.php',
					data :  'rowid='+ rowid,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						<?php if($_SESSION['level'] == 'Admin') { ?>
							$('#penerimakode').val(dataresponse.pengirim)
						<?php }else { ?>
							$('#pengirimkode').val(dataresponse.pengirim)
						<?php } ?>
					}
				});
			});
		});
	</script>
	<script type="text/javascript">
		"use strict";
		$("#table-1").dataTable();
	</script>
	<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$(".form-user").submit(function(e) {
				e.preventDefault();
				var data = $(this).serialize();
				$.ajax({
					type: 'POST',
					url: "proses/add-obrolan.php",
					data: data,
					success: function() {
						$('.direct-chat-messages').animate({
							scrollTop: $('.direct-chat-messages').get(0).scrollHeight
						}, 1500);
						$('.pesan-obrolan').val('');
					}
				});
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
						url: "proses/delete-obrolan.php",
						data: {'id':id},
						success: function(response) {
							var dataresponse = JSON.parse(response);
							console.log(dataresponse);
							if(dataresponse.status == "1") {
								window.location.href='obrolan'
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
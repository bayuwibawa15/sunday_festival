<script src="assets/plugins/myplugins/jquery-3.3.1.min.js"></script>
<script src="assets/plugins/myplugins/popper.min.js"></script>
<script src="assets/plugins/myplugins/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="assets/dist/js/stisla.js"></script>
<script src="assets/plugins/simpleweather/jquery.simpleWeather.min.js"></script>
<script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="assets/plugins/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="assets/plugins/chart.js/dist/Chart.min.js"></script>
<script src="assets/plugins/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="assets/plugins/summernote/dist/summernote-bs4.js"></script>
<script src="assets/plugins/cleave.js/dist/cleave.min.js"></script>
<script src="assets/plugins/cleave.js/dist/addons/cleave-phone.us.js"></script>
<script src="assets/plugins/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="assets/plugins/selectric/public/jquery.selectric.min.js"></script>
<script src="assets/plugins/dropzone/dist/min/dropzone.min.js"></script>
<script src="assets/plugins/sweetalert/docs/assets/sweetalert/sweetalert.min.js"></script>
<script src="assets/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
<script src="assets/plugins/chocolat/dist/js/jquery.chocolat.min.js"></script>
<script src="assets/dist/js/scripts.js"></script>
<script src="assets/dist/js/custom.js"></script>
<script type="text/javascript">
	function hanyahuruf(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32&&charCode > 57)
			return false;
		return true;
	}
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode > 57))
			return false;
		return true;
	}
</script>
<script type="text/javascript">
	$(document).on('click','#user-logout', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		swal({
			title: 'Apakah Anda yakin?',
			text: 'Jika keluar maka Anda harus masuk terlebih dahulu untuk bisa mengakses menu " <?php echo $nama_apps ?> "',
			icon: 'warning',
			buttons: {
				cancel: {
					text: "Tidak",
					value: false,
					visible: true,
					className: "",
					closeModal: true,
				},
				confirm: {
					text: "Ya, Keluar",
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
					url: "proses/logout.php",
					data: {'id':id},
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "1") {
							window.location.href='index'
						}
					}
				});
			}
		});
	});
</script>
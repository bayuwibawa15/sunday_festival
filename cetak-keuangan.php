<?php
include("koneksi.php");
error_reporting();
// session_start();
if(isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
	$syntax = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE id_pengguna = '$userid'");
	$online = mysqli_fetch_array($syntax);
}else {
	echo "<script>window.location.href='index'</script>";
}
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('assets/plugins/tcpdf/tcpdf.php');

// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf= new TCPDF('P','mm',array(230,280));

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jafar');
$pdf->SetTitle('Laporan Keuangan');
$pdf->SetSubject('Keuangan');
$pdf->SetKeywords('Laporan, PDF');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

/*####################################################### 
#					 		PAGE 1						#
#########################################################*/
   $cetak = 'Tanggal Di Cetak : '.tglIndonesia(date('d-F-Y'));
   $nama = 'Admin';
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
		$filter=$_POST['nama_produk'];
}
if($_POST['kode'] == "perbulan") {
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];

		$query = mysqli_query($conn, "SELECT * FROM tb_penjualanbantu,tb_produk, tb_penjualan WHERE tb_penjualan.id_penjualan=tb_penjualanbantu.id_penjualan AND tb_penjualanbantu.id_produk=tb_produk.id_produk AND tanggal_penjualan LIKE '$tahun-$bulan%' ORDER BY date(tanggal_penjualan) DESC");

		$kueri_modal = mysqli_query($conn, "SELECT SUM(jumlah_modal) AS jumlah_modal FROM tb_modal WHERE tanggal_modal LIKE '$tahun-$bulan%' ORDER BY date(tanggal_modal) DESC");
		$tampil_modal = mysqli_fetch_array($kueri_modal);

	}elseif($_POST['kode'] == "pertahun") {
		$tahun = $_POST['tahun'];

		$query = mysqli_query($conn, "SELECT * FROM tb_penjualanbantu,tb_produk, tb_penjualan WHERE tb_penjualan.id_penjualan=tb_penjualanbantu.id_penjualan AND tb_penjualanbantu.id_produk=tb_produk.id_produk AND tanggal_penjualan LIKE '$tahun%' ORDER BY date(tanggal_penjualan) DESC");

		$kueri_modal = mysqli_query($conn, "SELECT SUM(jumlah_modal) AS jumlah_modal FROM tb_modal WHERE tanggal_modal LIKE '$tahun%' ORDER BY date(tanggal_modal) DESC");
		$tampil_modal = mysqli_fetch_array($kueri_modal);
}
//cek, apakakah hasil query di atas mendapatkan hasil atau tidak (data kosong atau tidak)
  if(mysqli_num_rows($query) == 0){ //ini artinya jika data hasil query di atas kosong
   
   //jika data kosong, maka akan menampilkan row kosong
   echo '<script language="javascript">
              alert ("Data Tidak Ada");
              window.close();
              </script>';
              exit();
   
   }else{ //else ini artinya jika data hasil query ada (data diu database tidak kosong)


//------------------------------------------------------------
$pdf->AddPage();

$tbl2 = '<table border="0">
			<tr>
				<td colspan="2" style="text-align:center; border-bottom: 1px solid black;"><font size="7em">
				<div style="text-align: center;"><img src="assets/images/kop.png" style="width: 750px; height: 120px;"/></div>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</font></td>
			</tr>
			
		</table><br /><br />
		<table border="0">
			<tr>
				<td style="text-align:right;"><font size="10em">'.$cetak.'</font></td>
			</tr>
			<tr>
				<td style="text-align:left;" style="width:100px;"><font size="10em">Di Cetak</font></td>
				<td style="text-align:left;"><font size="10em">: '.$nama.'</font></td>
			</tr>
			<tr>
				<td style="text-align:left;" style="width:100px;"><font size="10em">Periode</font></td>
				<td style="text-align:left;"><font size="10em">: '.$filter.'</font></td>
			</tr>
		</table>
		<br><br><br>
		<table border="0" style="text-align:center;">
			<tr>
				<td colspan="2" style="text-align:center;"><font size="12em"><b>LAPORAN KEUANGAN</b></font></td>
			</tr>
		</table>
		<br><br>
		<table border="0" style="text-align:center;">
			<tr>
				<td colspan="2" style="text-align:center;"><font size="10em"><b>MODAL</b></font></td>
			</tr>
		</table>
		';
				$tbl2 = $tbl2.'<table border="1px" cellpadding="2" cellspacing="0">
					<tr style="text-align:center;vertical-align:middle;">
													<th style="width:450px;border: 1px solid #000;">TOTAL MODAL</th>
													<th style="width:300px;border: 1px solid #000;" align="right">'.number_format($tampil_modal['jumlah_modal'],0,",",".").'</th>
					</tr>
					</table><br><br>';

					$tbl2 = $tbl2.'
					<table border="0" style="text-align:center;">
						<tr>
							<td colspan="2" style="text-align:center;"><font size="10em"><b>PEMASUKAN</b></font></td>
						</tr>
					</table><table border="1px" cellpadding="2" cellspacing="0">
					';
					if($_POST['kode'] == "perbulan") {
						$bulan = $_POST['bulan'];
						$tahun = $_POST['tahun'];
						$kueri = mysqli_query($conn, "SELECT * FROM tb_penjualan,tb_penjualanbantu WHERE tb_penjualanbantu.id_penjualan=tb_penjualan.id_penjualan AND date(tanggal_penjualan) LIKE '$tahun-$bulan%'");
					}else{
					$tahun = $_POST['tahun'];
					$kueri = mysqli_query($conn, "SELECT * FROM tb_penjualan,tb_penjualanbantu WHERE tb_penjualanbantu.id_penjualan=tb_penjualan.id_penjualan AND date(tanggal_penjualan) LIKE '$tahun%'");
					}
					$tot_penjualan = 0;
					while($tampil = mysqli_fetch_array($kueri)) {
						$tot_penjualan +=$tampil['jumlah_penjualan']*$tampil['harga_penjualan'];
							$tbl2 = $tbl2.'
								<tr style="text-align:center;vertical-align:middle;">
																<th style="width:450px;border: 1px solid #000;">'.tglIndonesia(date('d F Y', strtotime($tampil['tanggal_penjualan']))).'</th>
																<th style="width:300px;border: 1px solid #000;" align="right">'.number_format($tampil['jumlah_penjualan']*$tampil['harga_penjualan'],0,",",".").'</th>
								</tr>';
					}
								$tbl2 = $tbl2.'
								</table><br><br><table ="0" style="text-align:center;">
								<tr>
									<td colspan="2" style="text-align:center;"><font size="10em"><b>PENGELUARAN</b></font></td>
								</tr>
							</table><table ="1px" cellpadding="2" cellspacing="0">';
							if($_POST['kode'] == "perbulan") {
								$bulan = $_POST['bulan'];
								$tahun = $_POST['tahun'];
								$kueri = mysqli_query($conn, "SELECT * FROM tb_pembelian,tb_pembelianbantu WHERE tb_pembelianbantu.id_pembelian=tb_pembelian.id_pembelian AND date(tanggal_pembelian) LIKE '$tahun-$bulan%'");
							}else{
							$tahun = $_POST['tahun'];
							$kueri = mysqli_query($conn, "SELECT * FROM tb_pembelian,tb_pembelianbantu WHERE tb_pembelianbantu.id_pembelian=tb_pembelian.id_pembelian AND date(tanggal_pembelian) LIKE '$tahun%'");
							}
							$tot_pembelian = 0;
							while($tampil = mysqli_fetch_array($kueri)) {
								$tot_pembelian +=$tampil['jumlah_pembelian']*$tampil['harga_pembelian'];
							$tbl2 = $tbl2.'
								<tr style="text-align:center;vertical-align:middle;">
												<th style="width:450px;border: 1px solid #000;">'.tglIndonesia(date('d F Y', strtotime($tampil['tanggal_pembelian']))).'</th>
												<th style="width:300px;border: 1px solid #000;" align="right">'.number_format($tampil['jumlah_pembelian']*$tampil['harga_pembelian'],0,",",".").'</th>
								</tr>';
							}

					$tbl2 = $tbl2.'
					<br><br>
					<table border="1px" cellpadding="2" cellspacing="0">
					<tr style="text-align:center;vertical-align:middle;">
													<th style="width:450px;border: 1px solid #000;">TOTAL PENDAPATAN</th>
													<th style="width:300px;border: 1px solid #000;" align="right">'.number_format($tot_penjualan-($tot_pembelian+$tampil_modal['jumlah_modal']),0,",",".").'</th>
					</tr>';
					$tbl2 = $tbl2.'
					</table>';

					$query = mysqli_query($conn, "SELECT * FROM tb_pengaturan WHERE status = 'pemilik'");
					$row3 = mysqli_fetch_array($query);
					$tbl2 = $tbl2.'<br><br><table ="0px" cellpadding="2" cellspacing="0" nobr="true">
					<tr style="text-align:center;">
						<td style="width:60%;"></td>
						<td style="width:40%;">Banjarbaru, '.tglIndonesia(date('d F Y')).'</td>
					</tr>
					<tr style="text-align:center;">
						<td style="width:60%;"></td>
						<td style="width:40%;"><img src="assets/images/berkas/'.$row3['ttd'].'" style="width: 130px; height: 110px;"/></td>
					</tr>
					<tr style="text-align:center;">
						<td style="width:60%;"></td>
						<td style="width:40%;"><u><b>'.$row3['nama_pengaturan'].'</b></u><br>Pemilik</td>
					</tr>
					</table>';
					
$tbl2 = $tbl2.'</table>';
$pdf->writeHTML($tbl2, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
ob_end_clean();
$pdf->Output('LAPORAN KEUANGAN.pdf', 'I');
}

//============================================================+
// END OF FILE
//============================================================+

<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$isi = $_POST['isi'];
$penerima = $_POST['penerimakode'];
$pengirim = $_POST['pengirimkode'];
$id_toko = $_POST['id_toko'];
$kode = $pengirim.$penerima;
$created = date("Y-m-d H:i:s");
$modified = date("Y-m-d H:i:s");

$query = mysqli_query($conn, "INSERT INTO tb_chat(id_penerima, id_pengirim, isi, kode, created, modified, id_toko) VALUES ('$penerima', '$pengirim', '$isi', '$kode', '$created', '$modified', '$id_toko')");
?>
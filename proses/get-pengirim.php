<?php
include '../koneksi.php';

$id = $_POST['rowid'];
$sql =  mysqli_query($conn, "SELECT * FROM tb_chat WHERE kode = '$id'");
$result = mysqli_fetch_array($sql);
echo json_encode(['message'=>'successfully saved data', 'status'=>'1', 'pengirim'=>$result['id_pengirim']]);
?>
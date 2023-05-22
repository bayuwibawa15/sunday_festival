<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$database = "db_sunday";

$conn = mysqli_connect($server, $username, $password, $database);
date_default_timezone_set('Asia/Jakarta');

include 'proses/function.php';
?>
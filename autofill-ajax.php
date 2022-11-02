<?php 
require 'function.php';
$id = $_GET['jenis_transaksi'];
$sql = mysqli_query($conn, "SELECT * FROM jenis_transaksi WHERE jenis_transaksi ='$id'");
$mhs = mysqli_fetch_array($sql);
$data = array(
    'laba' => $mhs['laba']

);
echo json_encode($data);

?>
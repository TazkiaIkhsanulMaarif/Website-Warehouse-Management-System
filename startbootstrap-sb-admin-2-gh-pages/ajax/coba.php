<?php
include "../../source/koneksi.php";
// Generate kode pengiriman
$id_pengiriman = mysqli_query($koneksi, "SELECT MAX(id_pengiriman) AS maxID FROM daftar_pengiriman");
$idpesanan = mysqli_fetch_array($id_pengiriman);
$pengiriman = $idpesanan['maxID'];
$pengiriman++;
$id_Pengiriman = sprintf("%03s", $pengiriman);

echo $id_Pengiriman;

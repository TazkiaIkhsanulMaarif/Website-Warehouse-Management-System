<?php
include "../../source/koneksi.php";

// Ambil semua kode pesanan dari tabel detail_pesanan menggunakan DISTINCT
$sql = "SELECT DISTINCT kodepesanan FROM detail_pesanan";
$result = $koneksi->query($sql);

$kodePesananList = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($kodePesananList, $row["kodepesanan"]);
    }
}

// Tutup koneksi
$koneksi->close();

// Mengembalikan data dalam format JSON
echo json_encode($kodePesananList);

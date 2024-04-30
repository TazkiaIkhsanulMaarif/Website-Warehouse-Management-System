<?php
include "../../source/koneksi.php";

// Mengambil kode pesanan dari tabel detail_pesanan
$sql = "SELECT DISTINCT kodepesanan FROM detail_pesanan";
$result = $koneksi->query($sql);

$kodePesanan = [];

if ($result->num_rows > 0) {
    // Menyimpan data kode pesanan dalam array
    while ($row = $result->fetch_assoc()) {
        $kodePesanan[] = $row['kodepesanan'];
    }
}

// Menutup koneksi ke database
$koneksi->close();

// Mengembalikan data kode pesanan sebagai respons JSON
header('Content-Type: application/json');
echo json_encode($kodePesanan);

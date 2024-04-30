<?php
include "../../source/koneksi.php";

// Ambil semua kode pesanan dari tabel detail_pesanan menggunakan DISTINCT
$sql = "SELECT namalengkap FROM user WHERE role = 'Staf'";
$result = $koneksi->query($sql);

$namalengkapList = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($namalengkapList, $row["namalengkap"]);
    }
}

// Tutup koneksi
$koneksi->close();

// Mengembalikan data dalam format JSON
echo json_encode($namalengkapList);

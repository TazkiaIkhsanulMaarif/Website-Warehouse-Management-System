<?php
// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
include "../../source/koneksi.php";

// Query untuk mengambil data pengguna dengan peran "Staf"
$sql = "SELECT * FROM user WHERE role = 'Staf'";
$result = $koneksi->query($sql);

$options = array();

// Loop melalui hasil query dan membangun array opsi
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $option = array(
            "value" => $row["iduser"],
            "label" => $row["namalengkap"]
        );

        array_push($options, $option);
    }
}

// Tutup koneksi database
$koneksi->close();

// Mengirimkan respons dalam format JSON
header("Content-Type: application/json");
echo json_encode($options);

<?php
session_start();
include "../../source/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui POST
    $kodePesanan = $_POST['kode_pesanan'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $idUser = $_POST['id_user'];
    $idStatus = $_POST['idstatus'];
    $idPengiriman = $_POST['id_pengiriman'];


    // Membagi data yang dikirim menjadi array berdasarkan koma
    $kodePesananArr = explode(",", $kodePesanan);
    $alamatArr = explode(",", $alamat);
    $tanggalArr = explode(",", $tanggal);
    $idUserArr = explode(",", $idUser);
    $idStatusArr = explode(",", $idStatus);

    // Prepare statement untuk melakukan insert ke tabel detail_pengiriman
    $stmtDetail = $koneksi->prepare("INSERT INTO detail_pengiriman (id_pengiriman, kodepesanan, iduser, idstatus) VALUES (?, ?, ?, ?)");
    // Bind parameter ke statement detail_pengiriman
    $stmtDetail->bind_param("ssss", $id_pengiriman, $kodePesanan, $idUser, $idStatus);

    // Lakukan multi-insert dengan menggunakan looping
    for ($i = 0; $i < count($kodePesananArr); $i++) {
        // Set nilai parameter sesuai dengan data pada iterasi saat ini
        $id_pengiriman = $idPengiriman;
        $kodePesanan = $kodePesananArr[$i];
        $idUser = $idUserArr[$i];
    }

    // Tutup statement detail_pengiriman
    $stmtDetail->close();
}

// Tutup koneksi
$koneksi->close();

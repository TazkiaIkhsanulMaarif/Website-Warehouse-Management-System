<?php
include "../../source/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari request AJAX
    $data = $_POST['formData'];

    // Melakukan multi-insert
    foreach ($data as $item) {
        $idPengiriman = $item['idPengiriman'];
        $namaLengkap = $item['namalengkap'];
        $kodePesanan = $item['kodePesanan'];
        $kodeTransaksi = $item['kodeTransaksi'];
        $status = $item['status'];
        $alamat = $item['alamat'];
        $tanggal = $item['tanggal'];

        // Melakukan prepared statement untuk insert data ke tabel detail_pengiriman
        $query = "INSERT INTO detail_pengiriman (id_pengiriman, kode_pesanan, idstatus, iduser) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $idPengiriman, $kodePesanan, $status, $namaLengkap);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Jika terjadi kesalahan saat insert, tangani kesalahan di sini
            echo "Failed to insert data into detail_pengiriman table";
            exit;
        }
    }

    // Menutup koneksi ke database
    mysqli_close($koneksi);
}

<?php
include "../../source/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate kode pengiriman
    $id_pengiriman = mysqli_query($koneksi, "SELECT MAX(id_pengiriman) AS maxID FROM daftar_pengiriman");
    $idpesanan = mysqli_fetch_array($id_pengiriman);
    $pengiriman = $idpesanan['maxID'];
    $pengiriman++;
    $id_Pengiriman = sprintf("%03s", $pengiriman);

    // Mendapatkan data dari request AJAX
    $data = $_POST['formData'];

    // Menyiapkan array untuk menyimpan id_pengiriman yang berhasil di-insert
    $insertedIds = array();

    // Melakukan multi-insert
    foreach ($data as $item) {
        $alamat = $item['alamat'];
        $kodetransaksi = $item['kodeTransaksi'];
        $tgl = $item['tanggal'];
        $status = $item['status'];
        $kodepesanan = $item['kodePesanan'];
        $namalengkap = $item['namalengkap'];

        // Melakukan prepared statement untuk insert data ke tabel daftar_pengiriman
        $query = "INSERT INTO daftar_pengiriman (id_pengiriman, alamat, tgl, kodetransaksi) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $id_Pengiriman, $alamat, $tgl, $kodetransaksi);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Jika insert berhasil, tambahkan id_pengiriman ke array insertedIds
            $insertedIds[] = $id_Pengiriman;

            // Increment id_pengiriman untuk data berikutnya
            $pengiriman++;
            $id_Pengiriman = sprintf("%03s", $pengiriman);
        }
    }

    // Mengembalikan id_pengiriman yang berhasil di-insert sebagai respons dalam format JSON yang valid
    $response = array('id_pengiriman' => $insertedIds);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

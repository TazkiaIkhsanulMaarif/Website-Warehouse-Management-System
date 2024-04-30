<?php
include "../../source/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menerima data selectedIds dari AJAX
    $selectedIds = $_POST['selectedIds'];

    // Hapus data dari tabel detail_pengiriman
    $queryDetail = "DELETE FROM detail_pengiriman WHERE id_pengiriman IN (" . implode(',', $selectedIds) . ")";
    $resultDetail = mysqli_query($koneksi, $queryDetail);

    if ($resultDetail) {
        // Mengembalikan respons sebagai berhasil menghapus data dari tabel detail_pengiriman
        $response = array('status' => 'success');
    } else {
        // Mengembalikan respons sebagai gagal menghapus data dari tabel detail_pengiriman
        $response = array('status' => 'error', 'message' => 'Failed to remove records from detail_pengiriman');
        echo json_encode($response);
        exit;
    }
}

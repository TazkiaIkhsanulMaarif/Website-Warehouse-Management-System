<?php
session_start();
include "../../source/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal']; // Menambahkan parameter tanggal yang diterima

    // Ubah format tanggal dari dd--mm-yyyy menjadi yyyy-mm-dd
    $tanggalFormatted = date("Y-m-d", strtotime(str_replace("--", "-", $tanggal)));

    // Menghitung selisih hari antara tanggal sekarang dan tanggal yang didapatkan
    $today = date('Y-m-d');
    $dateDiff = date_diff(date_create($tanggal), date_create($today))->days;

    // Menentukan status berdasarkan selisih hari
    $status = '';
    if ($dateDiff == 1 || $dateDiff == 2) {
        $status = 'Pending';
    } elseif ($dateDiff == 3 || $dateDiff == 4) {
        $status = 'Shiped';
    } elseif ($dateDiff >= 5) {
        $status = 'Delivered';
    }

    // Query untuk mengambil id_status berdasarkan status yang diberikan
    $sql = "SELECT id_status FROM daftar_status WHERE status = '$status'";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $statuses = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $statuses[] = $row['id_status']; // Mengambil id_status
        }

        // Mengembalikan id_status sebagai response
        echo implode(",", $statuses);
    } else {
        // Jika terjadi kesalahan saat menjalankan query, kembalikan pesan error
        echo "Error: Failed to fetch order statuses";
    }

    // Menutup koneksi ke database
    mysqli_close($koneksi);
}

<?php
session_start();
include "../../source/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pesanan = $_POST['id_pesanan'];

    // Memisahkan id_pesanan yang dipisahkan oleh koma menjadi array
    $id_pesanan_array = explode(",", $id_pesanan);

    // Query untuk mengambil kode pesanan berdasarkan id_pesanan
    $sql = "SELECT kodepesanan FROM detail_pesanan WHERE id_pesanan = ?";
    $stmt = mysqli_prepare($koneksi, $sql);

    // Inisialisasi array untuk menyimpan kode pesanan
    $kode_pesanan_array = array();

    // Loop melalui setiap id_pesanan
    foreach ($id_pesanan_array as $id) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Mengambil kode pesanan dari hasil query
        if ($row = mysqli_fetch_assoc($result)) {
            $kode_pesanan_array[] = $row['kodepesanan'];
        } else {
            // Jika tidak ada data yang ditemukan, kembalikan pesan error
            echo "Error: Order code not found";
            exit;
        }
    }

    // Mengembalikan kode pesanan sebagai response (dalam bentuk array)
    echo implode(",", $kode_pesanan_array);

    // Menutup koneksi ke database
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
}

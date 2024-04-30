<?php
include "../../source/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pesanan = $_POST['id_pesanan'];

    // Memisahkan id_pesanan yang dipisahkan oleh koma menjadi array
    $id_pesanan_array = explode(",", $id_pesanan);

    // Query untuk mengambil iduser secara acak dari tabel user dengan peran "Staf"
    $sql = "SELECT iduser FROM user WHERE role = 'Staf' ORDER BY RAND() LIMIT ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    $limit = count($id_pesanan_array);

    mysqli_stmt_bind_param($stmt, "s", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Inisialisasi array untuk menyimpan iduser
    $iduser_array = array();

    // Mengambil iduser dari hasil query
    while ($row = mysqli_fetch_assoc($result)) {
        $iduser_array[] = $row['iduser'];
    }

    // Jika jumlah iduser yang ditemukan kurang dari jumlah id_pesanan, kembalikan pesan error
    if (count($iduser_array) < $limit) {
        echo "Error: Insufficient Staf users";
        exit;
    }

    // Mengembalikan iduser secara acak sesuai dengan jumlah id_pesanan (dalam bentuk array)
    echo implode(",", $iduser_array);

    // Menutup koneksi ke database
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
}

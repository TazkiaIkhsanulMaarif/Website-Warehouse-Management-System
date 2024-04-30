<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include '../../source/koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai variabel dari Ajax
    $idbarang = mysqli_real_escape_string($koneksi, $_POST['idbarang']);
    $namaBarang = mysqli_real_escape_string($koneksi, $_POST['namaBarang']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $ukuran = mysqli_real_escape_string($koneksi, $_POST['ukuran']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $quantity = mysqli_real_escape_string($koneksi, $_POST['quantity']);
    $iduser = mysqli_real_escape_string($koneksi, $_POST['iduser']);


    // Generate kodepesanan dengan format "KDO001 (hidden iduser)"
    $hidden_iduser = '';

    // Fetch data user dari tabel user
    $user_query = mysqli_query($koneksi, "SELECT iduser FROM user WHERE iduser = '$iduser'");

    if ($user_query && mysqli_num_rows($user_query) > 0) {
        $user_data = mysqli_fetch_array($user_query);
        $hidden_iduser = $user_data['iduser'];

        // Cek apakah kode pesanan dengan iduser yang sama sudah ada sebelumnya
        $existing_pesanan = mysqli_query($koneksi, "SELECT kodepesanan FROM detail_pesanan WHERE iduser = '$iduser'");
        $existing_data = mysqli_fetch_all($existing_pesanan, MYSQLI_ASSOC);

        $existing_kodepesanan = array_column($existing_data, 'kodepesanan');

        // Generate kode pesanan dengan format "KDOXXX" berdasarkan data yang sudah ada
        if (!empty($existing_kodepesanan)) {
            // Jika sudah ada data pesanan dengan iduser yang sama
            $kode_pesanan = $existing_kodepesanan[0];
        } else {
            // Jika belum ada data pesanan dengan iduser yang sama
            // Query untuk mengambil nilai terbesar
            $query = "SELECT MAX(kodepesanan) AS nilai_terbesar FROM detail_pesanan";
            $result = $koneksi->query($query);

            // Memeriksa hasil query
            if ($result) {
                // Mengambil nilai terbesar
                $row = $result->fetch_assoc();
                $nilai_terbesar = $row['nilai_terbesar'];
                $next_number = intval(substr($nilai_terbesar, 3)) + 1;
                $kode_pesanan = 'KDO' . str_pad($next_number, 3, '0', STR_PAD_LEFT);
            }
        }
    }

    // Generate kode id_pesanan
    $id_pesanan = mysqli_query($koneksi, "SELECT MAX(id_pesanan) AS maxID FROM detail_pesanan");
    $idpesanan = mysqli_fetch_array($id_pesanan);

    $pesanan = $idpesanan['maxID'];
    $pesanan++;
    $kod_pesanan = sprintf("%02s", $pesanan);

    // Insert data ke tabel
    $query = "INSERT INTO detail_pesanan (id_pesanan, id_brang, kodepesanan, jumlah_pesanan, iduser) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssis", $kod_pesanan, $idbarang, $kode_pesanan, $quantity, $iduser);

    if (mysqli_stmt_execute($stmt)) {
        $new_stok = $stok - $quantity;
        $update_query = "UPDATE daftar_stok SET jumlah = ? WHERE id_brg = ?";
        $stmt_update = mysqli_prepare($koneksi, $update_query);
        mysqli_stmt_bind_param($stmt_update, "is", $new_stok, $idbarang);
        if (mysqli_stmt_execute($stmt_update)) {
            echo "Data inserted successfully";
        } else {
            echo "Error updating stok: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt_update);
    } else {
        echo "Error inserting data into detail_pesanan: " . mysqli_error($koneksi);
    }
    // Close statement
    mysqli_stmt_close($stmt);
}

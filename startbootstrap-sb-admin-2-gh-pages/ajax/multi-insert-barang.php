<?php
include "../../source/koneksi.php";

// Cek apakah ada data yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses data yang diterima
    $namaBarang = $_POST["namaBarang"];
    $gambar = $_FILES["gambar"];
    $kategori = $_POST["kategori"];
    $ukuran = $_POST["ukuran"];
    $harga = $_POST["harga"];
    $satuan = $_POST["satuan"];

    // Loop melalui setiap data yang diterima
    for ($i = 0; $i < count($namaBarang); $i++) {
        // Mendapatkan data untuk barang saat ini
        $nama = $namaBarang[$i];
        $gambarName = $gambar["name"][$i];
        $gambarTmpName = $gambar["tmp_name"][$i];
        $kategoriValue = $kategori[$i];

        // Ambil idkategori berdasarkan kategori
        $sqlSelectKategori = "SELECT idkategori FROM kategori WHERE kategori = '$kategoriValue'";
        $resultSelectKategori = mysqli_query($koneksi, $sqlSelectKategori);

        $idbrg = mysqli_query($koneksi, "SELECT MAX(id_barang) AS maxID FROM daftar_barang");
        $brg = mysqli_fetch_array($idbrg);

        $getbrg = $brg['maxID'];
        $getbrg++;
        $id_brg = sprintf("%02s", $getbrg);

        if ($resultSelectKategori && mysqli_num_rows($resultSelectKategori) > 0) {
            $row = mysqli_fetch_assoc($resultSelectKategori);
            $idkategori = $row["idkategori"];

            // Proses penyimpanan data ke database
            $gambarData = file_get_contents($gambarTmpName);
            $gambarData = mysqli_real_escape_string($koneksi, $gambarData);
            $ukuranValue = mysqli_real_escape_string($koneksi, $ukuran[$i]);
            $hargaValue = intval($harga[$i]);
            $satuanValue = mysqli_real_escape_string($koneksi, $satuan[$i]);
            $sql = "INSERT INTO daftar_barang (id_barang, nama_brg, gambar, idkategori, kategori, ukuran, harga, satuan) VALUES ('$id_brg', '$nama', '$gambarData', '$idkategori', '$kategoriValue', '$ukuranValue', $hargaValue, '$satuanValue')";

            if (mysqli_query($koneksi, $sql)) {
                // Proses upload gambar ke folder tujuan
                $targetDir = "../files/";
                $targetFile = $targetDir . basename($gambarName);

                if (move_uploaded_file($gambarTmpName, $targetFile)) {
                    // Gambar berhasil diupload
                    // Tambahkan kode lain yang diperlukan di sini
                } else {
                    // Gambar gagal diupload
                    echo "Terjadi kesalahan saat mengupload gambar.";
                }
            } else {
                // Terjadi kesalahan saat menyimpan data ke database
                echo "Terjadi kesalahan saat menyimpan data ke database.";
            }
        } else {
            // Kategori tidak ditemukan dalam database
            echo "Kategori tidak valid.";
        }
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}

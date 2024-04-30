<?php
include "../../source/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
    // Mendapatkan data yang dikirim melalui AJAX
    $data = json_decode(file_get_contents('php://input'), true);

    // Memeriksa apakah data berhasil di-decode
    if ($data === null) {
        // Gagal mendapatkan data JSON
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Invalid JSON data']);
        exit;
    }

    // Memeriksa apakah data kosong
    if (empty($data)) {
        http_response_code(400); // Bad Request
        echo json_encode(['message' => 'Data is empty']);
        exit;
    }

    // Menyimpan data ke tabel daftar_pengiriman
    $successCount = 0;

    foreach ($data as $row) {
        $alamat = $row['alamat'];
        $tanggal = DateTime::createFromFormat('d-m-Y', $row['tanggal'])->format('Y-m-d');
        $kodetransaksi = $row['kode_transaksi'];

        // Generate id_pengiriman dengan format DELXXX
        $id_pengiriman = generateIdPengiriman($koneksi);

        // Menyimpan data ke dalam database
        $query = "INSERT INTO daftar_pengiriman (id_pengiriman, alamat, tgl, kodetransaksi) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssss", $id_pengiriman, $alamat, $tanggal, $kodetransaksi);

        if ($stmt->execute()) {
            $successCount++;
        }
    }

    if ($successCount === count($data)) {
        http_response_code(200); // OK
        echo json_encode(['message' => 'Data inserted successfully']);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Failed to insert data']);
    }
} else {
    http_response_code(400); // Bad Request
    echo json_encode(['message' => 'Invalid request']);
    exit;
}

// Fungsi untuk generate id_pengiriman dengan format DELXXX
function generateIdPengiriman($koneksi)
{
    // Generate kode id_pengiriman
    $result = mysqli_query($koneksi, "SELECT MAX(id_pengiriman) AS maxID FROM daftar_pengiriman");
    $row = mysqli_fetch_array($result);
    $maxID = $row['maxID'];

    if ($maxID !== null) {
        $lastId = intval(substr($maxID, 3)); // Mengambil nomor id_pengiriman terakhir
    } else {
        $lastId = 0;
    }

    $nextId = $lastId + 1;
    $id_pengiriman = 'DEL' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
    return $id_pengiriman;
}

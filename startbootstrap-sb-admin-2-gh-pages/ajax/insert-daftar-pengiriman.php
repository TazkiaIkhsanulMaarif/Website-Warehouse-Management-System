<?php
include "../../source/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui POST
    $kodePesanan = $_POST['kode_pesanan'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $idUser = $_POST['id_user'];
    $idStatus = $_POST['idstatus'];

    // Membagi data yang dikirim menjadi array berdasarkan koma
    $kodePesananArr = explode(",", $kodePesanan);
    $alamatArr = explode(",", $alamat);
    $tanggalArr = explode(",", $tanggal);
    $idUserArr = explode(",", $idUser);
    $idStatusArr = explode(",", $idStatus);

    // Generate kode id_pengiriman
    $id_kirim = mysqli_query($koneksi, "SELECT MAX(id_pengiriman) AS maxID FROM daftar_pengiriman");
    $idpengiriman = mysqli_fetch_array($id_kirim);

    $kiriman = $idpengiriman['maxID'];
    $kiriman++;
    $id_pengiriman = sprintf("%02s", $kiriman);

    $kdtransaksi = mysqli_query($koneksi, "SELECT MAX(kodetransaksi) AS maxID FROM daftar_pengiriman");
    $kdtr = mysqli_fetch_array($kdtransaksi);

    $kdtrs = $kdtr['maxID'];
    $kdtrs++;
    $kodetransaksi = sprintf("%02s", $kdtrs);

    // Prepare statement untuk melakukan insert ke tabel daftar_pengiriman
    $stmt = $koneksi->prepare("INSERT INTO daftar_pengiriman (id_pengiriman, alamat, tgl, kodetransaksi) VALUES (?, ?, ?, ?)");

    // Bind parameter ke statement
    $stmt->bind_param("ssss", $id_pengiriman, $alamat, $tanggal, $kodetransaksi);

    $response = array(); // Array untuk menyimpan ID pengiriman baru

    // Lakukan multi-insert dengan menggunakan looping
    for ($i = 0; $i < count($kodePesananArr); $i++) {
        // Set nilai parameter sesuai dengan data pada iterasi saat ini
        $id_pengiriman = sprintf("%02s", $kiriman);
        $alamat = $alamatArr[$i];
        $tanggal = date('Y-m-d', strtotime($tanggalArr[$i]));
        $idStatus = $idStatusArr[$i];

        // Eksekusi statement
        if ($stmt->execute()) {
            // Tambahkan ID pengiriman baru ke dalam array response
            $response[] = $id_pengiriman;

            // Increment nilai id_pengiriman
            $kiriman++;
        }
    }

    // Mengembalikan ID pengiriman yang baru saja diinsert dalam bentuk array
    echo implode(",", $response);

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$koneksi->close();

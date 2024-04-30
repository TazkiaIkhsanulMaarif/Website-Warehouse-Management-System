<?php
// Include your database connection code
include '../../source/koneksi.php';


// Check if the request has an 'id_pesanan' parameter
if (isset($_POST['id_pesanan'])) {
    $idPesanan = $_POST['id_pesanan'];

    // Escape special characters and add quotes to the id_pesanan values
    $escapedIdPesanan = array_map(function ($value) use ($koneksi) {
        return "'" . mysqli_real_escape_string($koneksi, $value) . "'";
    }, $idPesanan);

    // Prepare the delete statement for detail_pesanan
    $deleteDetailSql = "DELETE FROM detail_pesanan WHERE id_pesanan LIKE 'PSN%' AND id_pesanan IN (" . implode(',', $escapedIdPesanan) . ")";

    // Execute the delete statement for detail_pesanan
    if (mysqli_query($koneksi, $deleteDetailSql)) {
        // If the deletion was successful, send a success response
        echo "success";
    } else {
        // If an error occurred during the deletion of detail_pesanan, send an error response
        echo "Error: " . mysqli_error($koneksi);
    }
}

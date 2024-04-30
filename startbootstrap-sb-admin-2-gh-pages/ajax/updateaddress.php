<?php
include "../../source/koneksi.php";

if (isset($_POST['newAddress']) && isset($_POST['id_pengiriman'])) {
    $newAddress = $_POST['newAddress'];
    $id_pengiriman = $_POST['id_pengiriman'];

    // Update the address in the database
    $query_update_address = "UPDATE daftar_pengiriman SET alamat = ? WHERE id_pengiriman = ?";
    $stmt_update_address = $koneksi->prepare($query_update_address);
    $stmt_update_address->bind_param("ss", $newAddress, $id_pengiriman);

    if ($stmt_update_address->execute()) {
        echo "Address has been updated successfully.";
    } else {
        echo "Error updating the address.";
    }
}

<?php
include "../../source/koneksi.php";

if (isset($_POST['id_pengiriman'])) {
    $id_pengiriman = $_POST['id_pengiriman'];

    // Query to fetch ordered items based on id_pengiriman
    $query_barang = "SELECT B.nama_brg
                    FROM detail_pengiriman DP
                    JOIN daftar_pengiriman P ON DP.id_pengiriman = P.id_pengiriman
                    JOIN detail_pesanan DS ON DP.kodepesanan = DS.kodepesanan
                    JOIN daftar_status S ON DP.idstatus = S.id_status
                    JOIN daftar_barang B ON DS.id_brang = B.id_barang
                    JOIN user U ON DP.iduser = U.iduser
                    WHERE DP.id_pengiriman = ?";
    $stmt_barang = $koneksi->prepare($query_barang);
    $stmt_barang->bind_param("s", $id_pengiriman);
    $stmt_barang->execute();
    $result_barang = $stmt_barang->get_result();

    if ($result_barang->num_rows > 0) {
        // Fetch and store the ordered items in an array
        $orderedItems = array();
        while ($row_barang = $result_barang->fetch_assoc()) {
            $orderedItems[] = $row_barang;
        }

        // Send the ordered items as JSON response
        header('Content-Type: application/json');
        echo json_encode($orderedItems);
    } else {
        echo json_encode([]);
    }
}

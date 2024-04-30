<?php

include "../../source/koneksi.php";

$query = "SELECT P.id_pengiriman, S.status, P.alamat, P.tgl, U.namalengkap, P.kodetransaksi
FROM detail_pengiriman DP
INNER JOIN daftar_pengiriman P ON DP.id_pengiriman = P.id_pengiriman
INNER JOIN daftar_status S ON DP.idstatus = S.id_status
INNER JOIN user U ON DP.iduser = U.iduser";

$result = mysqli_query($koneksi, $query);
if ($result) {
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);
}

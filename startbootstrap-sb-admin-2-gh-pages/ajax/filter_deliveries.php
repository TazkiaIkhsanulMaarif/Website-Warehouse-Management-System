<?php
include "../source/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST['selectedDate'];

    // Convert date format from dd-mm-yyyy to yyyy-mm-dd
    $dateObject = date_create_from_format('d-m-Y', $selectedDate);

    if ($dateObject) {
        $convertedDate = date_format($dateObject, 'Y-m-d');

        // Perform the SQL query to filter the deliveries by date
        $query_delivery = "SELECT P.id_pengiriman, S.status, P.alamat, P.tgl, U.namalengkap
        FROM detail_pengiriman DP
        INNER JOIN daftar_pengiriman P ON DP.id_pengiriman = P.id_pengiriman
        INNER JOIN daftar_status S ON DP.idstatus = S.id_status
        INNER JOIN user U ON DP.iduser = U.iduser
        WHERE P.tgl = '$convertedDate'";
        $result_delivery = $koneksi->query($query_delivery);

        $html = '';
        $no = 1;
        while ($row_delivery = $result_delivery->fetch_assoc()) {
            $id_pengiriman = $row_delivery['id_pengiriman'];
            $status = $row_delivery['status'];
            $alamat = $row_delivery['alamat'];
            $tanggal = $row_delivery['tgl'];

            // Build the HTML for each delivery row
            $html .= "<tr>";
            $html .= "<td>" . $no++ . "</td>";
            $html .= "<td><a href=\"#\" data-toggle=\"modal\" data-target=\"#barangModal\" data-id=\"$id_pengiriman\">$id_pengiriman</a></td>";
            $html .= "<td>$status</td>";
            $html .= "<td>$alamat";
            if ($updateAddressModal) {
                $html .= " <i class=\"fas fa-pencil-alt updateAddressBtn\" data-status=\"$status\"></i>";
            }
            $html .= "</td>";
            $html .= "<td>$tanggal</td>";
            $html .= "<td>
                <select class=\"form-control\">
                    <option value=\"remove\">Remove</option>
                    <option value=\"chat\">Chat with Seller</option>
                    <!-- Add other actions here -->
                </select>
            </td>";
            $html .= "</tr>";
        }

        // Send the HTML response back to the AJAX request
        echo $html;
    } else {
        // Handle case when date format is invalid
        echo "Invalid date format";
    }
} else {
    // No selectedDate sent, display all data from the database
    $query_all_delivery = "SELECT P.id_pengiriman, S.status, P.alamat, P.tgl, U.namalengkap
                            FROM detail_pengiriman DP
                            INNER JOIN daftar_pengiriman P ON DP.id_pengiriman = P.id_pengiriman
                            INNER JOIN daftar_status S ON DP.idstatus = S.id_status
                            INNER JOIN user U ON DP.iduser = U.iduser";
    $result_all_delivery = $koneksi->query($query_all_delivery);

    $html = '';
    $no = 1;
    while ($row_delivery = $result_all_delivery->fetch_assoc()) {
        $id_pengiriman = $row_delivery['id_pengiriman'];
        $status = $row_delivery['status'];
        $alamat = $row_delivery['alamat'];
        $tanggal = $row_delivery['tgl'];

        // Build the HTML for each delivery row
        $html .= "<tr>";
        $html .= "<td>" . $no++ . "</td>";
        $html .= "<td><a href=\"#\" data-toggle=\"modal\" data-target=\"#barangModal\" data-id=\"$id_pengiriman\">$id_pengiriman</a></td>";
        $html .= "<td>$status</td>";
        $html .= "<td>$alamat";
        if ($updateAddressModal) {
            $html .= " <i class=\"fas fa-pencil-alt updateAddressBtn\" data-status=\"$status\"></i>";
        }
        $html .= "</td>";
        $html .= "<td>$tanggal</td>";
        $html .= "<td>

        </td>";
        $html .= "</tr>";
    }

    // Send the HTML response back to the AJAX request
    echo $html;
}

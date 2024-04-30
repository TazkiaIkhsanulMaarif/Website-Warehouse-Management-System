<?php
include "../../source/koneksi.php";

if (isset($_POST['hidden_id'])) {
    $namalengkap = $_POST['namalengkap'];
    $kodetransaksi = $_POST['kodetransaksi'];
    $status = $_POST['status'];
    $alamat = $_POST['alamat'];
    $tgl = $_POST['tgl'];
    $id = $_POST['hidden_id'];

    echo "<h1>Data yang Terkirim</h1>";

    if (is_array($namalengkap)) {
        echo "<b>Nama Lengkap:</b><br>";
        foreach ($namalengkap as $nama) {
            echo $nama . "<br>";
        }
    } else {
        echo "Nama Lengkap: " . $namalengkap . "<br>";
    }

    if (is_array($kodetransaksi)) {
        echo "<b>Kode Transaksi:</b><br>";
        foreach ($kodetransaksi as $kode) {
            echo $kode . "<br>";
        }
    } else {
        echo "Kode Transaksi: " . $kodetransaksi . "<br>";
    }

    for ($count = 0; $count < count($id); $count++) {
        $namalengkap_val = mysqli_real_escape_string($koneksi, $namalengkap[$count]);
        $alamat_val = mysqli_real_escape_string($koneksi, $alamat[$count]);
        $tgl_val = mysqli_real_escape_string($koneksi, $tgl[$count]);
        $id_pengiriman_val = mysqli_real_escape_string($koneksi, $id[$count]);
        $kodetransaksi_val = mysqli_real_escape_string($koneksi, $kodetransaksi[$count]);

        $query = "
            UPDATE daftar_pengiriman
            SET kodetransaksi = '$kodetransaksi_val', alamat = '$alamat_val', tgl = '$tgl_val'
            WHERE id_pengiriman IN (
                SELECT id_pengiriman FROM detail_pengiriman WHERE detail_pengiriman.id_pengiriman = '$id_pengiriman_val'
            )
        ";

        if (mysqli_query($koneksi, $query)) {
            $userQuery = "
            UPDATE detail_pengiriman
            SET iduser = '$namalengkap_val'
            WHERE id_pengiriman = '$id_pengiriman_val'
            ";
            if (!mysqli_query($koneksi, $userQuery)) {
                $error = mysqli_error($koneksi);
                echo "Error updating user: " . $error;
                exit;
            }

            $statusQuery = "
            UPDATE detail_pengiriman
            SET idstatus = (
                SELECT id_status
                FROM daftar_status
                WHERE status = '$status[$count]'
            )
            WHERE id_pengiriman = '$id_pengiriman_val'
            ";
            if (!mysqli_query($koneksi, $statusQuery)) {
                $error = mysqli_error($koneksi);
                echo "Error updating status: " . $error;
                exit;
            }
        } else {
            $error = mysqli_error($koneksi);
            echo "Error updating detail_pengiriman: " . $error;
            exit;
        }
    }
}

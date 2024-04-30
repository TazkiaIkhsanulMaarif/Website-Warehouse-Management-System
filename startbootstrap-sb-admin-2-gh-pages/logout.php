<?php
session_start();
include "./source/koneksi.php";

// Hapus semua data sesi
session_unset();

// Hapus sesi cookie jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Akhiri sesi
session_destroy();

// Redirect ke halaman login
header("Location: ../source/index.php");
exit;

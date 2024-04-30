<?php

session_start();
include "koneksi.php";
$user = $_POST['username-login'];
$pwd = ($_POST['password-login']);

$op = $_GET['op'];

if ($op == "in") {
    $query_1 = "select * from user where username= '$user' and password='$pwd'";
    $h_1 = $koneksi->query($query_1);

    if (mysqli_num_rows($h_1) == 1) {
        $d_1 = $h_1->fetch_array();
        $_SESSION['iduser'] = $d_1['iduser'];
        $_SESSION['username'] = $d_1['username'];
        $_SESSION['role'] = $d_1['role'];
        $_SESSION['namalengkap'] = $d_1['namalengkap'];

        if ($d_1['role'] == "Admin") {
            header("location:../startbootstrap-sb-admin-2-gh-pages/dashboard.php");
        } else if ($d_1['role'] == "Suppliers") {
            header("location:../startbootstrap-sb-admin-2-gh-pages/dashboard.php");
        } else if ($d_1['role'] == "Staf") {
            header("location:../startbootstrap-sb-admin-2-gh-pages/dashboard.php");
        }
    } else {
?>
        <script language="JavaScript">
            alert('Oops! Login Failed. Username & password tidak sesuai ...');
            document.location = './';
        </script>
<?php
    }
} else if ($op == "out") {
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    header("location:index.php");
}

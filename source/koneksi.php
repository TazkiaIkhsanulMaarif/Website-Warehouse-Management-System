<?php
$db_host    = "localhost:3306";
$db_user    = "root";
$db_pass    = "";
$db_name    = "gudang";

$koneksi   = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
  if ($koneksi -> connect_errno) {
    echo "Failed to connect to MySQL: " . $koneksi -> connect_error;
    exit();
  }

?>
<?php
$host = "localhost";
$user = "root";       // sesuaikan jika username database beda
$pass = "tarikolot";           // sesuaikan jika ada password
$db   = "db_klinik";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_taman_bingkat";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
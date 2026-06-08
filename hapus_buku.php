<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data
$query = "DELETE FROM tb_buku WHERE id_buku = '$id'";

if (mysqli_query($conn, $query)) {
    header("Location: index.php?status=deleted");
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
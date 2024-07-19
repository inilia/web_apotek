<?php
include "connect.php";

$nama_obat = isset($_POST['nama_obat']) ? htmlentities($_POST['nama_obat']) : "";
$harga = isset($_POST['harga']) ? htmlentities($_POST['harga']) : "";
$stok = isset($_POST['stok']) ? htmlentities($_POST['stok']) : "";
$deskripsi = isset($_POST['deskripsi']) ? htmlentities($_POST['deskripsi']) : "";

$message = '';

if (isset($_POST['input_obat_validate'])) {
    $query = mysqli_query($conn, "INSERT INTO daftar_obat (nama_obat, harga, stok, deskripsi) 
                                VALUES ('$nama_obat', '$harga', '$stok', '$deskripsi')");
    if ($query) {
        $message = '<script>alert("Obat berhasil ditambahkan"); window.location="../gudang";</script>';
    } else {
        $message = '<script>alert("Obat gagal ditambahkan"); window.location="../gudang";</script>';
    }
} else {
    header("Location: ../gudang");
    exit();
}

echo $message;
?>
<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produk_id = $_POST['produk_id'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];

    $query = "SELECT harga FROM produk WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $produk_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produk = $result->fetch_assoc();
    $harga = $produk['harga'];

    $total_harga = $harga * $jumlah;

    $query = "INSERT INTO pesanan (produk_id, jumlah, total_harga) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $produk_id, $jumlah, $total_harga);

    if ($stmt->execute()) {
        header("Location: ../index.php?message=Pesanan berhasil ditambahkan");
    } else {
        header("Location: ../index.php?message=Gagal menambahkan pesanan");
    }
}
?>
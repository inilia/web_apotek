<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];

    if (empty($id_produk) || empty($jumlah) || empty($total_harga)) {
        echo "Data tidak lengkap!";
        exit;
    }

    $query = "INSERT INTO pesanan (id_produk, jumlah, total_harga) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $id_produk, $jumlah, $total_harga);

    if ($stmt->execute()) {
        header("Location: halaman_layanan.php?status=sukses");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
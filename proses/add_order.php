<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Mendapatkan harga produk dari database
    $query = $conn->prepare("SELECT harga FROM produk WHERE id = ?");
    $query->bind_param("i", $productId);
    $query->execute();
    $result = $query->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $price = $product['harga'];
        $totalPrice = $price * $quantity;

        // Menambahkan pesanan ke tabel pesanan
        $query = $conn->prepare("INSERT INTO pesanan (produk_id, jumlah, total_harga) VALUES (?, ?, ?)");
        $query->bind_param("iid", $productId, $quantity, $totalPrice);
        if ($query->execute()) {
            echo "Pesanan berhasil ditambahkan!";
        } else {
            echo "Gagal menambahkan pesanan.";
        }
    } else {
        echo "Produk tidak ditemukan.";
    }

    $query->close();
    $conn->close();
}
?>
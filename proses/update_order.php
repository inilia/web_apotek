<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['order_id'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $productQuery = mysqli_query($conn, "SELECT harga, nama_produk FROM produk WHERE id = $productId");
    $product = mysqli_fetch_assoc($productQuery);

    if ($product) {
        $price = $product['harga'];
        $totalPrice = $price * $quantity;

        $updateQuery = "UPDATE pesanan SET id_produk = '$productId', nama_produk = '{$product['nama_produk']}', harga = '$price', jumlah = '$quantity', total_harga = '$totalPrice' WHERE id = $orderId";
        if (mysqli_query($conn, $updateQuery)) {
            echo "Pesanan berhasil diperbarui";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>
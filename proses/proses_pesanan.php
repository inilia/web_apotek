<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $sql = "INSERT INTO pesanan (id_produk, jumlah) VALUES ('$id_produk', '$jumlah')";
    if ($conn->query($sql) === TRUE) {
        echo "Pesanan berhasil dibuat.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
header("Location: pelayanan.php");
exit();
?>
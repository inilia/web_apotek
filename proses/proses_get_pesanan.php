<?php
include 'proses/connect.php';

$response = ['id_produk' => '', 'total_harga' => ''];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT id_produk, jumlah, total_harga FROM pesanan WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $response = $result->fetch_assoc();

    echo json_encode($response);
}
?>
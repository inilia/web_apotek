<?php
include 'proses/connect.php';

$response = ['success' => false, 'message' => ''];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM pesanan WHERE id = ?");
    $stmt->bind_param("i", $id);

    $response['success'] = $stmt->execute();
    $response['message'] = $response['success'] ? "Pesanan berhasil dihapus." : "Error: " . $stmt->error;

    echo json_encode($response);
}
?>
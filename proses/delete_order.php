<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['order_id'];

    $deleteQuery = "DELETE FROM pesanan WHERE id = $orderId";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "Pesanan berhasil dihapus";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
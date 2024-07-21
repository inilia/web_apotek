<?php
include 'connect.php';

if (isset($_POST['confirm_payment'])) {
    $order_id = $_POST['order_id'];
    $customer_name = $_POST['customer_name'];
    $payment_amount = $_POST['payment_amount'];
    $total_payment = $_POST['total_payment'];
    $change = $_POST['change'];
    $stmt = $conn->prepare("INSERT INTO kasir (order_id, nama_pelanggan, total_pembayaran, jumlah_bayar, kembalian, tanggal, status_pembayaran) VALUES (?, ?, ?, ?, ?, NOW(), 'Belum Lunas')");
    $stmt->bind_param("ssdds", $order_id, $customer_name, $total_payment, $payment_amount, $change);

    if ($stmt->execute()) {
        echo "<script>alert('Pembayaran berhasil dikonfirmasi!'); window.location.href='../kasir.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan!'); window.location.href='../kasir.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
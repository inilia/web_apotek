<?php
include 'connect.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $customer_name = $_POST['customer_name'];
    $payment_amount = $_POST['payment_amount'];
    $total_payment = $_POST['total_payment'];
    $change = $_POST['change'];

    $stmt = $conn->prepare("UPDATE kasir SET nama_pelanggan = ?, jumlah_bayar = ?, total_pembayaran = ?, kembalian = ? WHERE id = ?");
    $stmt->bind_param("sddd", $customer_name, $payment_amount, $total_payment, $change, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='../kasir.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan!'); window.location.href='../kasir.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
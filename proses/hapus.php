<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM kasir WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='../kasir.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan!'); window.location.href='../kasir.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
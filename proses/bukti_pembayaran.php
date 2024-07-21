<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data dari database
    $stmt = $conn->prepare("SELECT * FROM kasir WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {

        echo "<h1>Bukti Pembayaran</h1>";
        echo "<p><strong>Nama Pelanggan:</strong> " . htmlspecialchars($data['nama_pelanggan']) . "</p>";
        echo "<p><strong>Total Pembayaran:</strong> " . number_format($data['total_pembayaran'], 2) . "</p>";
        echo "<p><strong>Jumlah Bayar:</strong> " . number_format($data['jumlah_bayar'], 2) . "</p>";
        echo "<p><strong>Kembalian:</strong> " . number_format($data['kembalian'], 2) . "</p>";
        echo "<p><strong>Tanggal:</strong> " . htmlspecialchars($data['tanggal']) . "</p>";
        echo "<p><strong>Status Pembayaran:</strong> " . htmlspecialchars($data['status_pembayaran']) . "</p>";
    } else {
        echo "Data tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
?>
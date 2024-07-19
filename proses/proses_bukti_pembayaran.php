<?php
include 'connect.php';

$last_id_query = "SELECT MAX(id) as last_id FROM bukti_pembayaran";
$result = mysqli_query($conn, $last_id_query);
$last_id = mysqli_fetch_assoc($result)['last_id'];


if ($last_id) {
    $bukti_query = "SELECT * FROM bukti_pembayaran WHERE id = $last_id";
    $bukti_result = mysqli_query($conn, $bukti_query);
    $bukti = mysqli_fetch_assoc($bukti_result);

    echo "<h1>Bukti Pembayaran</h1>";
    echo "<p><strong>ID:</strong> " . $bukti['id'] . "</p>";
    echo "<p><strong>Tanggal:</strong> " . $bukti['tanggal'] . "</p>";
    echo "<p><strong>Total Harga:</strong> " . number_format($bukti['total_harga'], 2) . "</p>";
} else {
    echo "Tidak ada bukti pembayaran.";
}

mysqli_close($conn);
?>
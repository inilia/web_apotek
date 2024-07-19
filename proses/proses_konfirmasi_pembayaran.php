<?php
include 'connect.php';
session_start();

$timestamp = date('Y-m-d H:i:s');

$insert_bukti = "INSERT INTO bukti_pembayaran (tanggal, total_harga) 
                 SELECT '$timestamp', SUM(jumlah * harga) 
                FROM pesanan";
if (mysqli_query($conn, $insert_bukti)) {
    $delete_pesanan = "DELETE FROM pesanan";
    if (mysqli_query($conn, $delete_pesanan)) {
        header('Location: ../kasir.php?status=sukses');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
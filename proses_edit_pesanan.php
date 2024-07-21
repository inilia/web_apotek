<?php
include 'connect.php'; // Ganti dengan nama file koneksi database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id = $_POST['id'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];

    // Validasi input
    if (empty($id) || empty($id_produk) || empty($jumlah) || empty($total_harga)) {
        echo "Data tidak lengkap!";
        exit;
    }

    // Pastikan ID pesanan valid dan ada dalam database
    $query_check = "SELECT * FROM pesanan WHERE id = ?";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        echo "Pesanan tidak ditemukan!";
        exit;
    }

    // Persiapkan dan jalankan query untuk memperbarui data pesanan
    $query = "UPDATE pesanan SET id_produk = ?, jumlah = ?, total_harga = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisi", $id_produk, $jumlah, $total_harga, $id);

    if ($stmt->execute()) {
        header("Location: halaman_layanan.php?status=sukses"); // Arahkan kembali ke halaman layanan
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
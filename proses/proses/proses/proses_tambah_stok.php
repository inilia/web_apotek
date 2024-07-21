<?php
include '../proses/connect.php';

if (isset($_POST['tambah_stok'])) {
    $produk_id = $_POST['produk'];
    $jumlah_tambah = $_POST['jumlah_tambah'];

    $query = mysqli_query($conn, "SELECT stok FROM produk WHERE id='$produk_id'");
    $produk = mysqli_fetch_assoc($query);

    if ($produk) {
        $stok_sekarang = $produk['stok'];
        $stok_baru = $stok_sekarang + $jumlah_tambah;

        $update = mysqli_query($conn, "UPDATE produk SET stok='$stok_baru' WHERE id='$produk_id'");

        if ($update) {
            echo "<script>alert('Stok berhasil ditambahkan.'); window.location.href='../gudang.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan.'); window.location.href='../gudang.php';</script>";
        }
    } else {
        echo "<script>alert('Produk tidak ditemukan.'); window.location.href='../gudang.php';</script>";
    }
}
?>
<?php
include '../proses/connect.php';

if (isset($_POST['kurangi_stok'])) {
    $produk_id = $_POST['produk_kurangi'];
    $jumlah_kurangi = $_POST['jumlah_kurangi'];

    $query = mysqli_query($conn, "SELECT stok FROM produk WHERE id='$produk_id'");
    $produk = mysqli_fetch_assoc($query);

    if ($produk) {
        $stok_sekarang = $produk['stok'];
        if ($jumlah_kurangi > $stok_sekarang) {
            echo "<script>alert('Jumlah kurangi melebihi stok yang ada.'); window.location.href='../gudang.php';</script>";
        } else {
            $stok_baru = $stok_sekarang - $jumlah_kurangi;

            $update = mysqli_query($conn, "UPDATE produk SET stok='$stok_baru' WHERE id='$id_produk'");

            if ($update) {
                echo "<script>alert('Stok berhasil dikurangi.'); window.location.href='../gudang.php';</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan.'); window.location.href='../gudang.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Produk tidak ditemukan.'); window.location.href='../gudang.php';</script>";
    }
}
?>
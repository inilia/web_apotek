<?php
include 'proses/connect.php';

$pesananData = "";

$query_pesanan = "SELECT pesanan.id, produk.nama, pesanan.jumlah, produk.harga, 
                          pesanan.jumlah * produk.harga AS total_harga, pesanan.status_pembayaran 
                FROM pesanan 
                JOIN produk ON pesanan.id_produk = produk.id";
$result_pesanan = mysqli_query($conn, $query_pesanan);
$no = 1;
while ($row = mysqli_fetch_assoc($result_pesanan)) {
    $pesananData .= "<tr>";
    $pesananData .= "<td>{$no}</td>";
    $pesananData .= "<td>{$row['nama']}</td>";
    $pesananData .= "<td>{$row['jumlah']}</td>";
    $pesananData .= "<td>{$row['harga']}</td>";
    $pesananData .= "<td>{$row['total_harga']}</td>";
    $pesananData .= "<td>{$row['status_pembayaran']}</td>";
    $pesananData .= "<td>
                        <button class='btn btn-warning btn-sm' onclick='editPesanan({$row['id']}, {$row['jumlah']})'>Edit</button>
                        <button class='btn btn-danger btn-sm' onclick='hapusPesanan({$row['id']})'>Hapus</button>
                    </td>";
    $pesananData .= "</tr>";
    $no++;
}

echo $pesananData;
?>
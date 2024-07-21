<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include 'proses/connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT pesanan.id, produk.nama, pesanan.jumlah, produk.harga, 
                                    pesanan.jumlah * produk.harga AS total_harga 
                             FROM pesanan 
                             JOIN produk ON pesanan.id_produk = produk.id 
                             WHERE pesanan.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pesanan = $result->fetch_assoc();

    if ($pesanan) {
        $html = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { width: 80%; margin: 0 auto; }
                .header, .footer { text-align: center; }
                .content { margin-top: 20px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #ddd; padding: 8px; }
                th { background-color: #f4f4f4; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Bukti Pembayaran</h1>
                </div>
                <div class='content'>
                    <p><strong>ID Pesanan:</strong> {$pesanan['id']}</p>
                    <p><strong>Nama Produk:</strong> {$pesanan['nama']}</p>
                    <p><strong>Jumlah:</strong> {$pesanan['jumlah']}</p>
                    <p><strong>Harga Satuan:</strong> Rp. " . number_format($pesanan['harga'], 2, ',', '.') . "</p>
                    <p><strong>Total Harga:</strong> Rp. " . number_format($pesanan['total_harga'], 2, ',', '.') . "</p>
                    <p><strong>Tanggal:</strong> " . date("d-m-Y") . "</p>
                </div>
                <div class='footer'>
                    <p>Terima kasih atas pembelian Anda.</p>
                </div>
            </div>
        </body>
        </html>";

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("bukti_pembayaran_{$id}.pdf", array("Attachment" => 1));
    } else {
        echo "Pesanan tidak ditemukan.";
    }
} else {
    echo "ID pesanan tidak tersedia.";
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $items = [
        ['nama' => 'Paracetamol', 'harga' => 15000],
        ['nama' => 'OBH', 'harga' => 20000],
        ['nama' => 'Betadine', 'harga' => 30000]
    ];

    $total = array_sum(array_column($items, 'harga'));

    if ($jumlah_bayar >= $total) {
        $kembalian = $jumlah_bayar - $total;
        echo "<h1>Pembayaran Berhasil</h1>";
        echo "<p>Terima kasih telah berbelanja.</p>";
        echo "<h3>Bukti Pembayaran</h3>";
        echo "<p>Item yang dibeli:</p>";
        foreach ($items as $item) {
            echo '<p>' . $item['nama'] . ' - Rp ' . number_format($item['harga'], 0, ',', '.') . '</p>';
        }
        echo '<p>Total: Rp ' . number_format($total, 0, ',', '.') . '</p>';
        echo '<p>Jumlah Bayar: Rp ' . number_format($jumlah_bayar, 0, ',', '.') . '</p>';
        echo '<p>Kembalian: Rp ' . number_format($kembalian, 0, ',', '.') . '</p>';
    } else {
        echo "<h1>Pembayaran Gagal</h1>";
        echo "<p>Jumlah bayar tidak mencukupi. Silakan coba lagi.</p>";
        echo '<a href="kasir.php" class="btn btn-primary">Kembali</a>';
    }
} else {
    echo "<h1>Metode pengiriman data tidak valid.</h1>";
}
?>
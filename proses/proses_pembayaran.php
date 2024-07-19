<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $jumlah_bayar = $_POST['jumlah_bayar'];

            ?>
        <div class="card mt-5">
            <div class="card-header">
                Bukti Pembayaran
            </div>
            <div class="card-body">
                <p>Terima kasih atas pembayaran Anda sebesar Rp <?php echo number_format($jumlah_bayar, 0, ',', '.'); ?>
                </p>
            </div>
        </div>
        <?php
        } else {
            header("Location: kasir.php");
            exit();
        }
        ?>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir - Sistem Informasi Manajemen Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: #28a745;
        }

        .navbar-brand,
        .nav-link,
        .offcanvas-title {
            color: #fff !important;
        }

        .card-header {
            background-color: #20c997;
        }

        .card-body {
            background-color: #ffffff;
        }

        .nav-pills .nav-link.active {
            background-color: #20c997;
            color: #fff !important;
        }

        .nav-pills .nav-link {
            color: #343a40 !important;
        }

        .nav-pills .nav-link:hover {
            background-color: #28a745 !important;
            color: #fff !important;
        }

        .card-title {
            color: #343a40;
        }

        .card-text {
            color: #6c757d;
        }

        .btn-close {
            color: #000;
        }

        .navbar-nav .dropdown-menu {
            background-color: #20c997;
        }

        .navbar-nav .dropdown-item {
            color: #fff;
        }

        .navbar-nav .dropdown-item:hover {
            background-color: #28a745;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'navbar.php'; ?>
    <!-- End Header -->

    <div class="container-lg">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <?php include 'sidebar.php'; ?>
            </div>
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="col-lg-9 mt-2">
                <div class="card">
                    <div class="card-header text-white">
                        <i class="bi bi-person-arms-up"></i> Kasir
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Halaman Kasir</h5>
                        <p class="card-text">Anda dapat mencatat transaksi penjualan dengan cepat dan mudah.</p>

                        <!-- Detail Pesanan -->
                        <div class="card">
                            <div class="card-header text-white">
                                <i class="bi bi-cart4"></i> Detail Pesanan
                            </div>
                            <div class="card-body">
                                <?php
                                // Contoh daftar barang yang dibeli
                                $items = [
                                    ['nama' => 'Paracetamol', 'harga' => 15000],
                                    ['nama' => 'OBH', 'harga' => 20000],
                                    ['nama' => 'Betadine', 'harga' => 30000]
                                ];

                                foreach ($items as $item) {
                                    echo '<p>' . $item['nama'] . ' - Rp ' . number_format($item['harga'], 0, ',', '.') . '</p>';
                                }

                                $total = array_sum(array_column($items, 'harga'));
                                echo '<hr>';
                                echo '<h5>Total: Rp ' . number_format($total, 0, ',', '.') . '</h5>';
                                ?>
                            </div>
                        </div>
                        <!-- End Detail Pesanan -->

                        <!-- Konfirmasi Pembayaran -->
                        <div class="card mt-3">
                            <div class="card-header text-white">
                                <i class="bi bi-cash-coin"></i> Konfirmasi Pembayaran
                            </div>
                            <div class="card-body">
                                <form action="proses_pembayaran.php" method="POST">
                                    <div class="mb-3">
                                        <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                                        <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                                </form>
                            </div>
                        </div>
                        <!-- End Konfirmasi Pembayaran -->

                    </div>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>
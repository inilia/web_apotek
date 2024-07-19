<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelayanan - Sistem Informasi Manajemen Apotek</title>
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
        color: #fff.
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
                        <i class="bi bi-person-circle"></i> Pelayanan
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Halaman Pelayanan</h5>
                        <p class="card-text">Anda dapat menyimpan dan mengelola data pelanggan dengan rapi dan aman.</p>

                        <!-- Daftar Produk -->
                        <?php
                        include 'connect.php';

                        // Query untuk mengambil data produk
                        $sql = "SELECT * FROM produk";
                        $result = $conn->query($sql);

                        // Tampilkan daftar produk
                        if ($result->num_rows > 0) {
                            echo "<h2>Daftar Produk</h2>";
                            echo "<ul>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<li>" . $row["nama_produk"] . " - Rp " . number_format($row["harga"], 0, ",", ".") . "</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "Tidak ada produk yang ditemukan.";
                        }
                        ?>

                        <!-- Form Membuat Pesanan -->
                        <form action="proses_pesanan.php" method="post">
                            <div class="mb-3">
                                <label for="id_produk" class="form-label">Pilih Produk</label>
                                <select class="form-select" id="id_produk" name="id_produk">
                                    <!-- Option produk diisi dari database atau static option -->
                                    <option value="1">Produk 1</option>
                                    <option value="2">Produk 2</option>
                                    <option value="3">Produk 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                        </form>

                        <!-- Tampilkan Total Harga Pesanan -->
                        <?php
                        // Anda dapat menambahkan logika untuk menghitung total harga pesanan di sini
                        ?>
                        <div class="mt-3">
                            <h5>Total Harga Pesanan:</h5>
                            <!-- Tampilkan total harga pesanan di sini -->
                        </div>
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
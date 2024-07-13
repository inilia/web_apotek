<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Manajemen Apotek</title>
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

    .offcanvas-body {
        background-color: #f5f5f5;
    }

    .offcanvas-header {
        background-color: #28a745;
    }

    .offcanvas-title {
        color: #fff;
    }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand navbar-dark">
        <div class="container-lg">
            <a class="navbar-brand" href="index.php"><i class="bi bi-hospital"></i> Apotek</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Username
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-bounding-box"></i> Profil</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-sliders2-vertical"></i> Setting</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header -->

    <div class="container-lg">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <nav class="navbar navbar-expand-lg bg-light rounded border mt-2">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                            aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="index.php"><i
                                                class="bi bi-house-heart"></i> Home </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="admin.php"><i class="bi bi-person-badge"></i> Admin
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="kasir.php"><i class="bi bi-person-arms-up"></i>
                                            Kasir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pelayanan.php"><i class="bi bi-people-fill"></i>
                                            Pelayanan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="gudang.php"><i class="bi bi-box-seam"></i> Gudang</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="col-lg-9 mt-2">
                <div class="card">
                    <div class="card-header text-white">
                        <i class="bi bi-house-heart"></i> Home
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Selamat Datang di Sistem Informasi Manajemen Apotek</h5>
                        <p class="card-text">Aplikasi ini memudahkan pengelolaan data apotek, termasuk manajemen stok,
                            penjualan, dan informasi pelanggan. Anda dapat mengakses fitur-fitur utama dengan mudah.</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="bi bi-box-seam display-4 text-success"></i>
                                        <h5 class="card-title">Manajemen Stok</h5>
                                        <p class="card-text">Kelola stok obat dengan mudah dan pantau ketersediaan
                                            secara real-time.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="bi bi-cart-check display-4 text-success"></i>
                                        <h5 class="card-title">Penjualan</h5>
                                        <p class="card-text">Catat transaksi penjualan dengan cepat dan mudah.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="bi bi-people-fill display-4 text-success"></i>
                                        <h5 class="card-title">Informasi Pelanggan</h5>
                                        <p class="card-text">Simpan dan kelola data pelanggan dengan rapi dan aman.</p>
                                    </div>
                                </div>
                            </div>
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
<?php
session_start();
if (empty($_SESSION['username_apotek'])) {
    header('location: login.php');
    exit;
}

include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '{$_SESSION['username_apotek']}'");
if ($query) {
    $hasil = mysqli_fetch_assoc($query);
    if ($hasil) {
        $username = $hasil['username'];
    } else {
        echo "Data user tidak ditemukan.";
    }
} else {
    echo "Gagal menjalankan query: " . mysqli_error($conn);
}
?>

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
    <?php include "navbar.php"; ?>
    <!-- End Header -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <?php include "sidebar.php"; ?>
            </div>
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="col-md-9">
                <?php
                $page = isset($_GET['x']) ? $_GET['x'] . '.php' : 'home.php';

                if (file_exists($page)) {
                    include $page;
                } else {
                    echo "Halaman tidak ditemukan.";
                }
                ?>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
<!DOCTYPE html>
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
                        <i class="bi bi-shop"></i> Menu Pelayanan
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col text-end">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                                    Tambah Pesanan
                                </button>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewProductsModal">
                                    Lihat Produk
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "proses/connect.php";
                                    $query = mysqli_query($conn, "SELECT * FROM pesanan");
                                    if (mysqli_num_rows($query) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $totalHarga = $row['jumlah'] * $row['harga'];
                                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++; ?></th>
                                        <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                                        <td><?php echo htmlspecialchars($row['harga']); ?></td>
                                        <td><?php echo htmlspecialchars($totalHarga); ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#viewOrderModal<?php echo $row['id']; ?>">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#editOrderModal<?php echo $row['id']; ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteOrderModal<?php echo $row['id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>Data pesanan tidak ada</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <!-- Modal Lihat Produk -->
    <div class="modal fade" id="viewProductsModal" tabindex="-1" aria-labelledby="viewProductsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewProductsModalLabel">Daftar Produk dan Harga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_products = mysqli_query($conn, "SELECT * FROM produk");
                                if (mysqli_num_rows($query_products) > 0) {
                                    $no = 1;
                                    while ($product = mysqli_fetch_assoc($query_products)) {
                                        ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo htmlspecialchars($product['nama_produk']); ?></td>
                                    <td><?php echo htmlspecialchars($product['harga']); ?></td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='text-center'>Data produk tidak ada</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Lihat Produk -->

    <!-- Modal Tambah Pesanan -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addOrderModalLabel">Tambah Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk tambah pesanan -->
                    <form class="needs-validation" novalidate action="proses/proses_tambah_pesanan.php" method="POST">
                        <div class="mb-3">
                            <label for="produkSelect" class="form-label">Pilih Produk</label>
                            <select class="form-select" id="produkSelect" name="id_produk" required>
                                <option value="" selected disabled>Pilih produk</option>
                                <?php
                                // Retrieve products for the select dropdown
                                $query_products = mysqli_query($conn, "SELECT * FROM produk");
                                while ($product = mysqli_fetch_assoc($query_products)) {
                                    ?>
                                <option value="<?php echo $product['id']; ?>">
                                    <?php echo htmlspecialchars($product['nama_produk'] . ' - ' . $product['harga']); ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Pilih produk untuk pesanan.</div>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            <div class="invalid-feedback">Masukkan jumlah pesanan.</div>
                        </div>
                        <div class="mb-3">
                            <label for="totalHarga" class="form-label">Total Harga</label>
                            <input type="text" class="form-control" id="totalHarga" name="total_harga" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Pesanan -->

    <!-- Modals untuk Edit dan Hapus Pesanan -->
    <?php
    $query = mysqli_query($conn, "SELECT * FROM pesanan");
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            ?>
    <!-- Modal Edit Pesanan -->
    <div class="modal fade" id="editOrderModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="editOrderModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editOrderModalLabel<?php echo $row['id']; ?>">Edit Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses/proses_edit_pesanan.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="mb-3">
                            <label for="editProdukSelect<?php echo $row['id']; ?>" class="form-label">Pilih
                                Produk</label>
                            <select class="form-select" id="editProdukSelect<?php echo $row['id']; ?>" name="id_produk"
                                required>
                                <?php
                                        $query_products = mysqli_query($conn, "SELECT * FROM produk");
                                        while ($product = mysqli_fetch_assoc($query_products)) {
                                            $selected = ($row['id_produk'] == $product['id']) ? 'selected' : '';
                                            ?>
                                <option value="<?php echo $product['id']; ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($product['nama_produk'] . ' - ' . $product['harga']); ?>
                                </option>
                                <?php
                                        }
                                        ?>
                            </select>
                            <div class="invalid-feedback">Pilih produk untuk pesanan.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editJumlah<?php echo $row['id']; ?>" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="editJumlah<?php echo $row['id']; ?>"
                                name="jumlah" value="<?php echo htmlspecialchars($row['jumlah']); ?>" required>
                            <div class="invalid-feedback">Masukkan jumlah pesanan.</div>
                        </div>
                        <div class="mb-3">
                            <label for="editTotalHarga<?php echo $row['id']; ?>" class="form-label">Total Harga</label>
                            <input type="text" class="form-control" id="editTotalHarga<?php echo $row['id']; ?>"
                                name="total_harga" value="<?php echo htmlspecialchars($row['total_harga']); ?>"
                                readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Edit Pesanan -->

    <!-- Modal Hapus Pesanan -->
    <div class="modal fade" id="deleteOrderModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="deleteOrderModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteOrderModalLabel<?php echo $row['id']; ?>">Hapus Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
                    <form action="proses/proses_hapus_pesanan.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Hapus Pesanan -->
    <?php
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFOuG7qW2Ptvw8iYSXkZZMo1V4SbZZ91x9J0RWPruS1gfBbeF9Hyn8" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-3g2HCEenCRzU1Aa0Oq8z4YOCTZKRl5K0eEr6lY3aH6/U2TcMOmDJt5/kAq35Upt6M" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update total price when quantity or product changes
        document.querySelector('#produkSelect').addEventListener('change', updateTotalPrice);
        document.querySelector('#jumlah').addEventListener('input', updateTotalPrice);

        function updateTotalPrice() {
            const produkSelect = document.querySelector('#produkSelect');
            const jumlahInput = document.querySelector('#jumlah');
            const totalHargaInput = document.querySelector('#totalHarga');

            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const harga = selectedOption ? parseFloat(selectedOption.textContent.split(' - ')[1]) : 0;
            const jumlah = parseInt(jumlahInput.value) || 0;

            totalHargaInput.value = (harga * jumlah).toFixed(2);
        }
    });
    </script>
</body>

</html>
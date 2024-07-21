<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gudang - Sistem Informasi Manajemen Apotek</title>
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

    .btn-custom {
        background-color: #20c997;
        color: #fff;
    }

    .btn-custom:hover {
        background-color: #17a2b8;
    }

    .footer {
        background-color: #28a745;
        color: #fff;
        padding: 20px;
        text-align: center;
        margin-top: auto;
    }

    .footer p {
        margin: 0;
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
                        <i class="bi bi-box"></i> Halaman Gudang
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['status'])): ?>
                        <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show"
                            role="alert">
                            <?php echo $_GET['status'] == 'success' ? 'Operasi berhasil dilakukan!' : 'Terjadi kesalahan, coba lagi.'; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        <div class="row mb-3">
                            <div class="col">
                                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                    Tambah Produk
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "proses/connect.php";
                                    $query = mysqli_query($conn, "SELECT * FROM produk");
                                    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    if (empty($result)) {
                                        echo "<tr><td colspan='6' class='text-center'>Data produk tidak ada</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($result as $row) {
                                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                        <td><?php echo number_format($row['harga'], 2); ?></td>
                                        <td><?php echo htmlspecialchars($row['stok']); ?></td>
                                        <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#editProductModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteProductModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
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

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addProductModalLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk tambah produk -->
                    <form class="needs-validation" novalidate action="proses/proses_input_produk.php" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="product_name" placeholder="Nama Produk"
                                        name="product_name" required>
                                    <label for="product_name">Nama Produk</label>
                                    <div class="invalid-feedback">Masukkan nama produk.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="price" placeholder="Harga"
                                        name="price" step="0.01" required>
                                    <label for="price">Harga</label>
                                    <div class="invalid-feedback">Masukkan harga produk.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="stock" placeholder="Stok" name="stock"
                                        required>
                                    <label for="stock">Stok</label>
                                    <div class="invalid-feedback">Masukkan stok produk.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="description" placeholder="Deskripsi"
                                        name="description">
                                    <label for="description">Deskripsi</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="input_product_validate">Tambah
                                Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Produk -->

    <!-- Modal Edit Produk -->
    <?php foreach ($result as $row) { ?>
    <div class="modal fade" id="editProductModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="editProductModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProductModalLabel<?php echo $row['id']; ?>">Edit Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk edit produk -->
                    <form class="needs-validation" novalidate action="proses/proses_edit_produk.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="product_name" placeholder="Nama Produk"
                                        name="product_name" value="<?php echo htmlspecialchars($row['nama_produk']); ?>"
                                        required>
                                    <label for="product_name">Nama Produk</label>
                                    <div class="invalid-feedback">Masukkan nama produk.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="price" placeholder="Harga"
                                        name="price" step="0.01" value="<?php echo htmlspecialchars($row['harga']); ?>"
                                        required>
                                    <label for="price">Harga</label>
                                    <div class="invalid-feedback">Masukkan harga produk.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="stock" placeholder="Stok" name="stock"
                                        value="<?php echo htmlspecialchars($row['stok']); ?>" required>
                                    <label for="stock">Stok</label>
                                    <div class="invalid-feedback">Masukkan stok produk.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="description" placeholder="Deskripsi"
                                        name="description" value="<?php echo htmlspecialchars($row['deskripsi']); ?>">
                                    <label for="description">Deskripsi</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="edit_product_validate">Perbarui
                                Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- End Modal Edit Produk -->

    <!-- Modal Hapus Produk -->
    <?php foreach ($result as $row) { ?>
    <div class="modal fade" id="deleteProductModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="deleteProductModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteProductModalLabel<?php echo $row['id']; ?>">Hapus Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus produk
                        <strong><?php echo htmlspecialchars($row['nama_produk']); ?></strong>?
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="proses/proses_hapus_produk.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger" name="delete_product_validate">Hapus
                            Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- End Modal Hapus Produk -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO3DuwiknF5IM4CpksM9cc9hA0vIK7JlcPwsKp16WV8IcUarNXu5" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-d7bCUrYoVDX2i0y/xa1BQvA8zsSz6prbV7E46o2B5puc6V0dM8Dh79YkWlS8Fgr1" crossorigin="anonymous">
    </script>
    <script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>

    <footer class="footer">
        <p>&copy; 2024 Sistem Informasi Manajemen Apotek.</p>
    </footer>
</body>

</html>
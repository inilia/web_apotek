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
                        <div class="row mb-3">
                            <div class="col text-end">
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addObatModal">Tambah Obat</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Obat</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "proses/connect.php";
                                    $query = mysqli_query($conn, "SELECT * FROM daftar_obat");
                                    $result = [];
                                    while ($record = mysqli_fetch_array($query)) {
                                        $result[] = $record;
                                    }
                                    if (empty($result)) {
                                        echo "<tr><td colspan='5' class='text-center'>Data obat tidak ada</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($result as $row) {
                                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td><?php echo $row['nama_obat']; ?></td>
                                        <td><?php echo $row['harga']; ?></td>
                                        <td><?php echo $row['stok']; ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#viewObatModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#editObatModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteObatModal<?php echo $row['id']; ?>"><i
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
    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="addObatModal" tabindex="-1" aria-labelledby="addObatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addObatModalLabel">Tambah Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk tambah obat -->
                    <form class="needs-validation" novalidate action="proses/proses_input_obat.php" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama_obat" placeholder="Nama Obat"
                                        name="nama_obat" required>
                                    <label for="nama_obat">Nama Obat</label>
                                    <div class="invalid-feedback">Masukkan nama obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="harga" placeholder="Harga"
                                        name="harga" required>
                                    <label for="harga">Harga</label>
                                    <div class="invalid-feedback">Masukkan harga obat.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="stok" placeholder="Stok" name="stok"
                                        required>
                                    <label for="stok">Stok</label>
                                    <div class="invalid-feedback">Masukkan stok obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="deskripsi" placeholder="Deskripsi"
                                        style="height: 100px;" name="deskripsi"></textarea>
                                    <label for="deskripsi">Deskripsi</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="input_obat_validate">Tambah
                                Obat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Obat -->


    <!-- Modal View Obat -->
    <?php
    foreach ($result as $row) {
        ?>
    <div class="modal fade" id="viewObatModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="viewObatModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewObatModalLabel<?php echo $row['id']; ?>">Detail Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Obat:</strong> <?php echo $row['nama_obat']; ?></p>
                    <p><strong>Harga:</strong> <?php echo $row['harga']; ?></p>
                    <p><strong>Stok:</strong> <?php echo $row['stok']; ?></p>
                    <p><strong>Deskripsi:</strong> <?php echo $row['deskripsi']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!-- End Modal View Obat -->

    <!-- Modal Edit Obat -->
    <?php
    foreach ($result as $row) {
        ?>
    <div class="modal fade" id="editObatModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="editObatModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editObatModalLabel<?php echo $row['id']; ?>">Edit Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="proses/proses_edit_obat.php" method="POST">
                        <input type="hidden" name="id_obat" value="<?php echo $row['id']; ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="edit_nama_obat<?php echo $row['id']; ?>"
                                        value="<?php echo $row['nama_obat']; ?>" name="nama_obat" required>
                                    <label for="edit_nama_obat<?php echo $row['id']; ?>">Nama Obat</label>
                                    <div class="invalid-feedback">Masukkan nama obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="edit_harga<?php echo $row['id']; ?>"
                                        value="<?php echo $row['harga']; ?>" name="harga" required>
                                    <label for="edit_harga<?php echo $row['id']; ?>">Harga</label>
                                    <div class="invalid-feedback">Masukkan harga obat.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="edit_stok<?php echo $row['id']; ?>"
                                        value="<?php echo $row['stok']; ?>" name="stok" required>
                                    <label for="edit_stok<?php echo $row['id']; ?>">Stok</label>
                                    <div class="invalid-feedback">Masukkan stok obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="edit_deskripsi<?php echo $row['id']; ?>"
                                        style="height: 100px;"
                                        name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
                                    <label for="edit_deskripsi<?php echo $row['id']; ?>">Deskripsi</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edit_obat_validate">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!-- End Modal Edit Obat -->

    <!-- Modal Hapus Obat -->
    <?php
    foreach ($result as $row) {
        ?>
    <div class="modal fade" id="deleteObatModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="deleteObatModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteObatModalLabel<?php echo $row['id']; ?>">Hapus Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus obat <strong><?php echo $row['nama_obat']; ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form action="proses/proses_hapus_obat.php" method="POST">
                        <input type="hidden" name="id_obat" value="<?php echo $row['id']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" name="hapus_obat_validate">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!-- End Modal Hapus Obat -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9e6qjIG4FzWAs+1f2M1n84u5ZZTDCJeGRFJzFhml44tiA2Er" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-4O83kvwW3qZwHtnmYLkztpEZV3bOXjYZq8QECj0wD39SxJ83Y6StEYtVfkk3buT1" crossorigin="anonymous">
    </script>
    <script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form) {
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
</body>

</html>
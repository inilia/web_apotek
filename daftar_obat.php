<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Sistem Informasi Manajemen Apotek</title>
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
                        <i class="bi bi-capsule"></i> Daftar Obat
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col text-end">
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addMedicineModal">Tambah Obat</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Obat</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "proses/connect.php";
                                    $query = mysqli_query($conn, "SELECT * FROM tb_obat");
                                    if (!$query) {
                                        die("Query error: " . mysqli_error($conn));
                                    }

                                    $result = [];
                                    while ($record = mysqli_fetch_array($query)) {
                                        $result[] = $record;
                                    }

                                    if (empty($result)) {
                                        echo "<tr><td colspan='6' class='text-center'>Data obat tidak ada</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($result as $row) {
                                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td><?php echo htmlspecialchars($row['nama_obat']); ?></td>
                                        <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                                        <td><?php echo htmlspecialchars($row['harga']); ?></td>
                                        <td><?php echo htmlspecialchars($row['stok']); ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#viewMedicineModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#editMedicineModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteMedicineModal<?php echo $row['id']; ?>"><i
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
    <div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addMedicineModalLabel">Tambah Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk tambah obat -->
                    <form class="needs-validation" novalidate action="proses/proses_input_obat.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama_obat" placeholder="Nama Obat"
                                        name="nama_obat" required>
                                    <label for="nama_obat">Nama Obat</label>
                                    <div class="invalid-feedback">Masukkan nama obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="kategori" placeholder="Kategori"
                                        name="kategori" required>
                                    <label for="kategori">Kategori</label>
                                    <div class="invalid-feedback">Masukkan kategori obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="harga" placeholder="Harga"
                                        name="harga" required>
                                    <label for="harga">Harga</label>
                                    <div class="invalid-feedback">Masukkan harga obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="stok" placeholder="Stok" name="stok"
                                        required>
                                    <label for="stok">Stok</label>
                                    <div class="invalid-feedback">Masukkan jumlah stok.</div>
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

    <?php
    foreach ($result as $row) {
        ?>
    <!-- Modal View Obat -->
    <div class="modal fade" id="viewMedicineModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="viewMedicineModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewMedicineModalLabel<?php echo $row['id']; ?>">Detail Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Obat:</strong> <?php echo htmlspecialchars($row['nama_obat']); ?></p>
                    <p><strong>Kategori:</strong> <?php echo htmlspecialchars($row['kategori']); ?></p>
                    <p><strong>Harga:</strong> <?php echo htmlspecialchars($row['harga']); ?></p>
                    <p><strong>Stok:</strong> <?php echo htmlspecialchars($row['stok']); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal View Obat -->

    <!-- Modal Edit Obat -->
    <div class="modal fade" id="editMedicineModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="editMedicineModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMedicineModalLabel<?php echo $row['id']; ?>">Edit Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk edit obat -->
                    <form class="needs-validation" novalidate action="proses/proses_edit_obat.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="edit_nama_obat<?php echo $row['id']; ?>"
                                        placeholder="Nama Obat" name="nama_obat"
                                        value="<?php echo htmlspecialchars($row['nama_obat']); ?>" required>
                                    <label for="edit_nama_obat<?php echo $row['id']; ?>">Nama Obat</label>
                                    <div class="invalid-feedback">Masukkan nama obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="edit_kategori<?php echo $row['id']; ?>"
                                        placeholder="Kategori" name="kategori"
                                        value="<?php echo htmlspecialchars($row['kategori']); ?>" required>
                                    <label for="edit_kategori<?php echo $row['id']; ?>">Kategori</label>
                                    <div class="invalid-feedback">Masukkan kategori obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="edit_harga<?php echo $row['id']; ?>"
                                        placeholder="Harga" name="harga"
                                        value="<?php echo htmlspecialchars($row['harga']); ?>" required>
                                    <label for="edit_harga<?php echo $row['id']; ?>">Harga</label>
                                    <div class="invalid-feedback">Masukkan harga obat.</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="edit_stok<?php echo $row['id']; ?>"
                                        placeholder="Stok" name="stok"
                                        value="<?php echo htmlspecialchars($row['stok']); ?>" required>
                                    <label for="edit_stok<?php echo $row['id']; ?>">Stok</label>
                                    <div class="invalid-feedback">Masukkan jumlah stok.</div>
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
    <!-- End Modal Edit Obat -->

    <!-- Modal Hapus Obat -->
    <div class="modal fade" id="deleteMedicineModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="deleteMedicineModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteMedicineModalLabel<?php echo $row['id']; ?>">Hapus Obat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus obat
                        <strong><?php echo htmlspecialchars($row['nama_obat']); ?></strong>?
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="proses/proses_hapus_obat.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" name="delete_obat_validate">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Hapus Obat -->
    <?php
    }
    ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9DA3MAF6gH0I4gRojD+6ZVBDP5EzQEO5LG8rD6h1t2WAA9y8xR3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-Jew0l9iJkJ5F5enOaVAmMjZnbQf2p9WnlTnY5fclA0ijTu2j2UEnMbU4k8IjM9+Y" crossorigin="anonymous">
    </script>
</body>

</html>
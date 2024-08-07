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
                        <i class="bi bi-person"></i> Halaman Admin
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col text-end">
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addAdminModal">Tambah Admin</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">No Telp</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "proses/connect.php";
                                    $query = mysqli_query($conn, "SELECT * FROM tb_user");
                                    $result = [];
                                    while ($record = mysqli_fetch_array($query)) {
                                        $result[] = $record;
                                    }
                                    if (empty($result)) {
                                        echo "<tr><td colspan='6' class='text-center'>Data user tidak ada</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($result as $row) {
                                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['level']; ?></td>
                                        <td><?php echo $row['nohp']; ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#viewAdminModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#editAdminModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteAdminModal<?php echo $row['id']; ?>"><i
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

    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addAdminModalLabel">Tambah Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk tambah admin -->
                    <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama"
                                        required>
                                    <label for="nama">Nama</label>
                                    <div class="invalid-feedback">Masukkan nama.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="username" placeholder="Email"
                                        name="username" required>
                                    <label for="username">Username</label>
                                    <div class="invalid-feedback">Masukkan username.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="level" name="level" required>
                                        <option value="1">Admin</option>
                                        <option value="2">Kasir</option>
                                        <option value="3">Pelayan</option>
                                        <option value="4">Gudang</option>
                                    </select>
                                    <label for="level">Level User</label>
                                    <div class="invalid-feedback">Pilih level user.</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nohp" placeholder="No Telp" name="nohp"
                                        required>
                                    <label for="nohp">No Telp</label>
                                    <div class="invalid-feedback">Masukkan nomor telepon.</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat"
                                required></textarea>
                            <label for="alamat">Alamat</label>
                            <div class="invalid-feedback">Masukkan alamat.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" required>
                            <label for="password">Password</label>
                            <div class="invalid-feedback">Masukkan password.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password2" placeholder="Confirm Password"
                                name="password2" required>
                            <label for="password2">Confirm Password</label>
                            <div class="invalid-feedback">Masukkan konfirmasi password.</div>
                        </div>
                        <button class="w-100 btn btn-primary" type="submit" name="input_user_validate"
                            value="abc">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lihat Admin -->
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            ?>
    <div class="modal fade" id="viewAdminModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="viewAdminModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewAdminModalLabel<?php echo $row['id']; ?>">Lihat Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tampilan detail admin -->
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama"
                                        value="<?php echo $row['nama']; ?>" readonly>
                                    <label for="nama">Nama</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="username" placeholder="Email"
                                        name="username" value="<?php echo $row['username']; ?>" readonly>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="level" name="level" disabled>
                                        <option value="1" <?php echo $row['level'] == 1 ? 'selected' : ''; ?>>Admin
                                        </option>
                                        <option value="2" <?php echo $row['level'] == 2 ? 'selected' : ''; ?>>Kasir
                                        </option>
                                        <option value="3" <?php echo $row['level'] == 3 ? 'selected' : ''; ?>>Pelayan
                                        </option>
                                        <option value="4" <?php echo $row['level'] == 4 ? 'selected' : ''; ?>>Gudang
                                        </option>
                                    </select>
                                    <label for="level">Level User</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nohp" placeholder="No Telp" name="nohp"
                                        value="<?php echo $row['nohp']; ?>" readonly>
                                    <label for="nohp">No Telp</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat"
                                readonly><?php echo $row['alamat']; ?></textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>

    <!-- Modal Edit Admin -->
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            ?>
    <div class="modal fade" id="editAdminModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="editAdminModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAdminModalLabel<?php echo $row['id']; ?>">Edit Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk edit admin -->
                    <form class="needs-validation" novalidate action="proses/proses_edit_user.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama"
                                        value="<?php echo $row['nama']; ?>" required>
                                    <label for="nama">Nama</label>
                                    <div class="invalid-feedback">Masukkan nama.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="username" placeholder="Email"
                                        name="username" value="<?php echo $row['username']; ?>" required>
                                    <label for="username">Username</label>
                                    <div class="invalid-feedback">Masukkan username.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="level" name="level" required>
                                        <option value="1" <?php echo $row['level'] == 1 ? 'selected' : ''; ?>>Admin
                                        </option>
                                        <option value="2" <?php echo $row['level'] == 2 ? 'selected' : ''; ?>>Kasir
                                        </option>
                                        <option value="3" <?php echo $row['level'] == 3 ? 'selected' : ''; ?>>Pelayan
                                        </option>
                                        <option value="4" <?php echo $row['level'] == 4 ? 'selected' : ''; ?>>Gudang
                                        </option>
                                    </select>
                                    <label for="level">Level User</label>
                                    <div class="invalid-feedback">Pilih level user.</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nohp" placeholder="No Telp" name="nohp"
                                        value="<?php echo $row['nohp']; ?>" required>
                                    <label for="nohp">No Telp</label>
                                    <div class="invalid-feedback">Masukkan nomor telepon.</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat"
                                required><?php echo $row['alamat']; ?></textarea>
                            <label for="alamat">Alamat</label>
                            <div class="invalid-feedback">Masukkan alamat.</div>
                        </div>
                        <button class="w-100 btn btn-primary" type="submit" name="edit_user_validate">Simpan
                            Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>

    <!-- Modal Hapus Admin -->
    <?php
    if (!empty($result)) {
        foreach ($result as $row) {
            ?>
    <div class="modal fade" id="deleteAdminModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="deleteAdminModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteAdminModalLabel<?php echo $row['id']; ?>">Hapus Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus admin <strong><?php echo $row['nama']; ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="proses/proses_hapus_user.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger" name="delete_user_validate">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/validation.js"></script>
    <script>
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
    </script>

    <footer class="footer">
        <p>&copy; 2024 Sistem Informasi Manajemen Apotek.</p>
    </footer>

</body>

</html>
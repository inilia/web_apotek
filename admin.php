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
                                        value="<?php echo $row['nama'] ?>">
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
                                    <input type="text" class="form-control" id="nohp" placeholder="No HP" name="nohp">
                                    <label for="nohp">No HP</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password" required>
                                    <label for="password">Password</label>
                                    <div class="invalid-feedback">Masukkan password.</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="alamat" placeholder="Alamat"
                                        style="height: 100px;" name="alamat"></textarea>
                                    <label for="alamat">Alamat</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="input_user_validate">Tambah
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal Tambah Admin -->
    <?php
    foreach ($result as $row) {
        ?>

    <!-- Modal View Admin -->
    <?php
        foreach ($result as $row) {
            ?>
    <div class="modal fade" id="viewAdminModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="viewAdminModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewAdminModalLabel<?php echo $row['id']; ?>">Detail Data Admin
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="viewNama<?php echo $row['id']; ?>" class="form-label">Nama</label>
                        <input disabled type="text" class="form-control" id="viewNama<?php echo $row['id']; ?>"
                            value="<?php echo $row['nama']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="viewUsername<?php echo $row['id']; ?>" class="form-label">Username</label>
                        <input disabled type="text" class="form-control" id="viewUsername<?php echo $row['id']; ?>"
                            value="<?php echo $row['username']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="viewLevel<?php echo $row['id']; ?>" class="form-label">Level</label>
                        <input disabled type="text" class="form-control" id="viewLevel<?php echo $row['id']; ?>"
                            value="<?php echo $row['level']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="viewNohp<?php echo $row['id']; ?>" class="form-label">No HP</label>
                        <input disabled type="text" class="form-control" id="viewNohp<?php echo $row['id']; ?>"
                            value="<?php echo $row['nohp']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="viewAlamat<?php echo $row['id']; ?>" class="form-label">Alamat</label>
                        <textarea disabled class="form-control" id="viewAlamat<?php echo $row['id']; ?>" rows="3"
                            readonly><?php echo $row['alamat']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
        ?>
    <!-- End Modal View Admin -->
    <?php }
    ?>


    <!-- Modal Edit Admin -->
    <?php
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
                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nama_edit<?php echo $row['id']; ?>"
                                        placeholder="Nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                    <label for="nama_edit<?php echo $row['id']; ?>">Nama</label>
                                    <div class="invalid-feedback">Masukkan nama.</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="username_edit<?php echo $row['id']; ?>"
                                        placeholder="Email" name="username" value="<?php echo $row['username']; ?>"
                                        required>
                                    <label for="username_edit<?php echo $row['id']; ?>">Username</label>
                                    <div class="invalid-feedback">Masukkan username.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="level_edit<?php echo $row['id']; ?>" name="level"
                                        required>
                                        <option value="1" <?php if ($row['level'] == 1)
                                                echo 'selected'; ?>>Admin
                                        </option>
                                        <option value="2" <?php if ($row['level'] == 2)
                                                echo 'selected'; ?>>Kasir
                                        </option>
                                        <option value="3" <?php if ($row['level'] == 3)
                                                echo 'selected'; ?>>Pelayan
                                        </option>
                                        <option value="4" <?php if ($row['level'] == 4)
                                                echo 'selected'; ?>>Gudang
                                        </option>
                                    </select>
                                    <label for="level_edit<?php echo $row['id']; ?>">Level User</label>
                                    <div class="invalid-feedback">Pilih level user.</div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nohp_edit<?php echo $row['id']; ?>"
                                        placeholder="No HP" name="nohp" value="<?php echo $row['nohp']; ?>">
                                    <label for="nohp_edit<?php echo $row['id']; ?>">No HP</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="alamat_edit<?php echo $row['id']; ?>"
                                        placeholder="Alamat" style="height: 100px;"
                                        name="alamat"><?php echo $row['alamat']; ?></textarea>
                                    <label for="alamat_edit<?php echo $row['id']; ?>">Alamat</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edit_user_validate">Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <!-- End Modal Edit Admin -->

    <!-- Modal Delete Admin -->
    <?php foreach ($result as $row) { ?>
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
                    <form action="proses/proses_delete_user.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- End Modal Delete Admin -->


    <?php
    foreach ($result as $row) {
        ?>

    <?php
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
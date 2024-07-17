<!doctype html>
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
                                                data-bs-target="#viewAdminModal"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#editAdminModal"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteAdminModal"><i class="bi bi-trash"></i></button>
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
                <!-- End Content -->
            </div>
        </div>

        <!-- Modal Tambah Admin -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addAdminModalLabel">Tambah Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk tambah admin -->
                        <form action="proses/proses_input_user.php">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput"
                                            placeholder="Your Name">
                                        <label for="floatingInput">Nama</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput"
                                            placeholder="name@example.com">
                                        <label for="floatingInput">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected hidden>Pilih Level User</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Kasir</option>
                                            <option value="3">Pelayan</option>
                                            <option value="4">Gudang</option>
                                        </select>
                                        <label for="floatingInput">Level User</label>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput"
                                            placeholder="08xxxxx">
                                        <label for="floatingInput">No HP</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingInput"
                                            placeholder="password" disabled value="12345">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="from-control" name="" id="" style="height: 100px"></textarea>
                                    <label for="floatingInput">Alamat</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save
                                        changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah Admin -->

        <!-- Modal View Admin -->
        <div class="modal fade" id="viewAdminModal" tabindex="-1" aria-labelledby="viewAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="viewAdminModalLabel">Daftar Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Content untuk view admin -->
                        <p>Nama: Mark</p>
                        <p>Username: Otto</p>
                        <p>Level: Admin</p>
                        <p>No Telp: 123456789</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Modal View Admin -->

        <!-- Modal Edit Admin -->
        <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editAdminModalLabel">Edit Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk edit admin -->
                        <form>
                            <div class="mb-3">
                                <label for="editNama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="editNama" value="Mark">
                            </div>
                            <div class="mb-3">
                                <label for="editUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="editUsername" value="Otto">
                            </div>
                            <div class="mb-3">
                                <label for="editLevel" class="form-label">Level</label>
                                <input type="text" class="form-control" id="editLevel" value="Admin">
                            </div>
                            <div class="mb-3">
                                <label for="editNoTelp" class="form-label">No Telp</label>
                                <input type="text" class="form-control" id="editNoTelp" value="123456789">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Edit Admin -->

        <!-- Modal Hapus Admin -->
        <div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="deleteAdminModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteAdminModalLabel">Hapus Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus admin ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Hapus Admin -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>
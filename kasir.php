<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir - Sistem Informasi Manajemen Apotek</title>
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
                        <i class="bi bi-cash"></i> Halaman Kasir
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                                    Konfirmasi Pembayaran
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Total Pembayaran</th>
                                        <th scope="col">Jumlah Bayar</th>
                                        <th scope="col">Kembalian</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status Pembayaran</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "proses/connect.php";
                                    $query = mysqli_query($conn, "SELECT * FROM kasir");
                                    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    if (empty($result)) {
                                        echo "<tr><td colspan='8' class='text-center'>Data kasir tidak ada</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($result as $row) {
                                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
                                        <td><?php echo number_format($row['total_pembayaran'], 2); ?></td>
                                        <td><?php echo number_format($row['jumlah_bayar'], 2); ?></td>
                                        <td><?php echo number_format($row['kembalian'], 2); ?></td>
                                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                        <td><?php echo htmlspecialchars($row['status_pembayaran']); ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#viewReceiptModal<?php echo $row['id']; ?>"><i
                                                    class="bi bi-eye"></i></button>
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

    <!-- Modal Konfirmasi Pembayaran -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPaymentModalLabel">Konfirmasi Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk konfirmasi pembayaran -->
                    <form action="proses/konfirmasi_pembayaran.php" method="POST">
                        <div class="mb-3">
                            <label for="order_id" class="form-label">ID Pesanan</label>
                            <input type="number" class="form-control" id="order_id" name="order_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_amount" class="form-label">Jumlah Bayar</label>
                            <input type="number" class="form-control" id="payment_amount" name="payment_amount"
                                step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_payment" class="form-label">Total Pembayaran</label>
                            <input type="number" class="form-control" id="total_payment" name="total_payment"
                                step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="change" class="form-label">Kembalian</label>
                            <input type="number" class="form-control" id="change" name="change" step="0.01" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="confirm_payment">Konfirmasi
                                Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Konfirmasi Pembayaran -->

    <!-- Modal Bukti Pembayaran -->
    <?php foreach ($result as $row) { ?>
    <div class="modal fade" id="viewReceiptModal<?php echo $row['id']; ?>" tabindex="-1"
        aria-labelledby="viewReceiptModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewReceiptModalLabel<?php echo $row['id']; ?>">Bukti Pembayaran
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Nama Pelanggan:</strong> <?php echo htmlspecialchars($row['nama_pelanggan']); ?>
                    </div>
                    <div class="mb-3">
                        <strong>Total Pembayaran:</strong> <?php echo number_format($row['total_pembayaran'], 2); ?>
                    </div>
                    <div class="mb-3">
                        <strong>Jumlah Bayar:</strong> <?php echo number_format($row['jumlah_bayar'], 2); ?>
                    </div>
                    <div class="mb-3">
                        <strong>Kembalian:</strong> <?php echo number_format($row['kembalian'], 2); ?>
                    </div>
                    <div class="mb-3">
                        <strong>Tanggal:</strong> <?php echo htmlspecialchars($row['tanggal']); ?>
                    </div>
                    <div class="mb-3">
                        <strong>Status Pembayaran:</strong> <?php echo htmlspecialchars($row['status_pembayaran']); ?>
                    </div>
                    <a href="proses/bukti_pembayaran.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Unduh
                        Bukti Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- End Modal Bukti Pembayaran -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9vTfH5t7vNujHBCnT2e8XW7T3iKzLXWzYtD7m6sK7BtTjB1I6ED" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-66LJKYo81KQhpiz7aZh4uNGt72oc9AlwVgWz6wroJrE9KjAT5Fd4Ej1JrN42e8v5f" crossorigin="anonymous">
    </script>
    <script>
    document.getElementById('payment_amount').addEventListener('input', function() {
        var total = parseFloat(document.getElementById('total_payment').value) || 0;
        var amount = parseFloat(this.value) || 0;
        document.getElementById('change').value = (amount - total).toFixed(2);
    });
    </script>

    <footer class="footer">
        <p>&copy; 2024 Sistem Informasi Manajemen Apotek.</p>
    </footer>

</body>

</html>
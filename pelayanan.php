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
                        <i class="bi bi-cart"></i> Halaman Pelayanan
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                                    Tambah Pesanan
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive mb-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "proses/connect.php";
                                    $query = mysqli_query($conn, "SELECT * FROM produk");
                                    $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    if (empty($products)) {
                                        echo "<tr><td colspan='6' class='text-center'>Data produk tidak ada</td></tr>";
                                    } else {
                                        $no = 1;
                                        foreach ($products as $product) {
                                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td><?php echo htmlspecialchars($product['nama_produk']); ?></td>
                                        <td><?php echo number_format($product['harga'], 2); ?></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm"
                                                id="qty_<?php echo $product['id']; ?>" value="1" min="1">
                                        </td>
                                        <td id="total_<?php echo $product['id']; ?>">
                                            <?php echo number_format($product['harga'], 2); ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm"
                                                onclick="addToOrder(<?php echo $product['id']; ?>)">
                                                <i class="bi bi-plus-circle"></i> Tambah
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <h5>Total Harga Pesanan:</h5>
                                <p id="order_total">Rp 0.00</p>
                            </div>
                        </div>
                        <div class="table-responsive mb-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="order_table_body">
                                    <!-- Pesanan akan ditambahkan di sini -->
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#updateOrderModal">
                            Update Pesanan
                        </button>
                        <button class="btn btn-danger" id="deleteOrderButton" data-bs-toggle="modal"
                            data-bs-target="#deleteOrderModal">
                            Hapus Pesanan
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <!-- Modal Tambah Pesanan -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addOrderModalLabel">Tambah Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambahkan pesanan -->
                    <form id="orderForm">
                        <div class="mb-3">
                            <label for="order_product" class="form-label">Produk</label>
                            <select class="form-select" id="order_product" required>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM produk");
                                while ($product = mysqli_fetch_assoc($query)) {
                                    echo "<option value='" . $product['id'] . "'>" . htmlspecialchars($product['nama_produk']) . " - Rp " . number_format($product['harga'], 2) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="order_quantity" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="order_quantity" min="1" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah Pesanan -->

    <!-- Modal Update Pesanan -->
    <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="updateOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateOrderModalLabel">Update Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk memperbarui pesanan -->
                    <form id="updateOrderForm">
                        <div class="mb-3">
                            <label for="update_order_id" class="form-label">ID Pesanan</label>
                            <input type="text" class="form-control" id="update_order_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_product" class="form-label">Produk</label>
                            <select class="form-select" id="update_product" required>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM produk");
                                while ($product = mysqli_fetch_assoc($query)) {
                                    echo "<option value='" . $product['id'] . "'>" . htmlspecialchars($product['nama_produk']) . " - Rp " . number_format($product['harga'], 2) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="update_quantity" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="update_quantity" min="1" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Update Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Update Pesanan -->

    <!-- Modal Konfirmasi Hapus Pesanan -->
    <div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteOrderModalLabel">Hapus Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
                    <input type="hidden" id="delete_order_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteOrder">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Konfirmasi Hapus Pesanan -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFOs1DJPUC21zLY8GHlf3ZY7F9BIZn1V0sJ2eMbvTkUnUt0R8ANa2O" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-c2X5m8V0sSXIbiVmqmN5GueaFnBtAzPmp9FxJ0Q3kFgFtfTrDsbGq5zKkc6hoZos" crossorigin="anonymous">
    </script>
    <script>
    function updateTotalPrice() {
        let total = 0;
        document.querySelectorAll("#order_table_body tr").forEach(row => {
            const price = parseFloat(row.querySelector(".total_price").textContent.replace('Rp ', '').replace(
                ',', ''));
            total += price;
        });
        document.getElementById("order_total").textContent = 'Rp ' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g,
            '$&,');
    }

    function addToOrder(productId) {
        const quantity = document.getElementById('qty_' + productId).value;
        const price = parseFloat(document.getElementById('total_' + productId).textContent.replace('Rp ', '').replace(
            ',', ''));
        const totalPrice = price * quantity;

        let orderTableBody = document.getElementById('order_table_body');
        let orderRow = document.getElementById('order_row_' + productId);

        if (!orderRow) {
            orderRow = document.createElement('tr');
            orderRow.id = 'order_row_' + productId;

            orderRow.innerHTML = `
                <td>${orderTableBody.children.length + 1}</td>
                <td>${document.querySelector("#qty_" + productId).closest('tr').children[1].textContent}</td>
                <td>Rp ${price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                <td>${quantity}</td>
                <td class="total_price">Rp ${totalPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>
                <td><button class="btn btn-danger btn-sm" onclick="removeFromOrder(${productId})">Hapus</button></td>
            `;
            orderTableBody.appendChild(orderRow);
        } else {
            let existingQuantity = parseInt(orderRow.children[3].textContent);
            let newQuantity = existingQuantity + parseInt(quantity);
            let newTotalPrice = price * newQuantity;

            orderRow.children[3].textContent = newQuantity;
            orderRow.children[4].textContent = 'Rp ' + newTotalPrice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        updateTotalPrice();
    }

    function removeFromOrder(productId) {
        let row = document.getElementById('order_row_' + productId);
        if (row) {
            row.remove();
            updateTotalPrice();
        }
    }

    document.getElementById('orderForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const productId = document.getElementById('order_product').value;
        const quantity = document.getElementById('order_quantity').value;
        addToOrder(productId);

        document.getElementById('orderForm').reset();
        const addOrderModal = bootstrap.Modal.getInstance(document.getElementById('addOrderModal'));
        addOrderModal.hide();
    });

    document.getElementById('updateOrderForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const orderId = document.getElementById('update_order_id').value;
        const productId = document.getElementById('update_product').value;
        const quantity = document.getElementById('update_quantity').value;

        removeFromOrder(orderId);
        addToOrder(productId);

        document.getElementById('updateOrderForm').reset();
        const updateOrderModal = bootstrap.Modal.getInstance(document.getElementById('updateOrderModal'));
        updateOrderModal.hide();
    });

    document.getElementById('confirmDeleteOrder').addEventListener('click', function() {
        const orderId = document.getElementById('delete_order_id').value;
        removeFromOrder(orderId);
        const deleteOrderModal = bootstrap.Modal.getInstance(document.getElementById('deleteOrderModal'));
        deleteOrderModal.hide();
    });

    document.getElementById('deleteOrderButton').addEventListener('click', function() {

        const orderId = Array.from(document.querySelectorAll('#order_table_body tr')).map(row => row.id.replace(
            'order_row_', ''))[0];
        document.getElementById('delete_order_id').value = orderId;
    });
    </script>

    <footer class="footer">
        <p>&copy; 2024 Sistem Informasi Manajemen Apotek.</p>
    </footer>

</body>

</html>
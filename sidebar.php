<nav class="navbar navbar-expand-lg bg-light rounded border mt-2">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel"
            style="width: 250px;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'home') ? 'active link-light' : 'link-dark'; ?>"
                            aria-current="page" href="index.php?x=home">
                            <i class="bi bi-house-heart"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'admin') ? 'active link-light' : 'link-dark'; ?>"
                            href="admin.php?x=admin">
                            <i class="bi bi-person-badge"></i> Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'kasir') ? 'active link-light' : 'link-dark'; ?>"
                            href="kasir.php?x=kasir">
                            <i class="bi bi-person-arms-up"></i> Kasir
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'pelayanan') ? 'active link-light' : 'link-dark'; ?>"
                            href="pelayanan.php?x=pelayanan">
                            <i class="bi bi-people-fill"></i> Pelayanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'gudang') ? 'active link-light' : 'link-dark'; ?>"
                            href="gudang.php?x=gudang">
                            <i class="bi bi-box-seam"></i> Gudang
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
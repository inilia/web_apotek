<?php
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "index.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'admin') {
    $page = "admin.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'obat') {
    $page = "daftar_obat.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'kasir') {
    $page = "kasir.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'kasir') {
    $page = "kasir.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'pelayanan') {
    $page = "pelayanan.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'gudang') {
    $page = "gudang.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include "proses/proses_logout.php";
} else {
    $page = "home.php";
    include "main.php";
}
?>
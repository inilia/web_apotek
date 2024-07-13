<?php
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "home.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'admin') {
    $page = "admin.php";
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
} else {
    include "main.php";
}
?>
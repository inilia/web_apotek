<?php
include "connect.php";


$id = isset($_POST['id']) ? $_POST['id'] : '';


$nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : '';
$username = isset($_POST['username']) ? htmlentities($_POST['username']) : '';
$level = isset($_POST['level']) ? htmlentities($_POST['level']) : '';
$nohp = isset($_POST['nohp']) ? htmlentities($_POST['nohp']) : '';
$password = isset($_POST['password']) ? md5(htmlentities($_POST['password'])) : '';
$alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : '';

$query = "UPDATE tb_user SET nama = '$nama', username = '$username', level = '$level', nohp = '$nohp', password = '$password', alamat = '$alamat' WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
    header("Location: ../admin.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
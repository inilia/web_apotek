<?php
include "connect.php";

$name = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
$username = isset($_POST['username']) ? htmlentities($_POST['username']) : "";
$level = isset($_POST['level']) ? htmlentities($_POST['level']) : "";
$nohp = isset($_POST['nohp']) ? htmlentities($_POST['nohp']) : "";
$alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : "";
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : "";

$message = '';

if (isset($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "INSERT INTO tb_user (nama, username, level, nohp, alamat, password) 
                                VALUES ('$name', '$username', '$level', '$nohp', '$alamat', '$password')");
    if ($query) {
        $message = '<script>alert("Data berhasil dimasukkan"); window.location="../user";</script>';
    } else {
        $message = '<script>alert("Data gagal dimasukkan"); window.location="../user";</script>';
    }
} else {
    header("Location: admin.php");
    exit();
}




echo $message;
?>
<?php
include "connect.php";

// Ambil data dari form POST
$id = isset($_POST['id']) ? htmlentities($_POST['id']) : "";
$username = isset($_POST['username']) ? htmlentities($_POST['username']) : "";
$level = isset($_POST['level']) ? htmlentities($_POST['level']) : "";
$nohp = isset($_POST['nohp']) ? htmlentities($_POST['nohp']) : "";
$alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : "";
$password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : "";

$message = '';

if (isset($_POST['input_user_validate'])) {
    // Update statement menggunakan prepared statements untuk keamanan
    $stmt = $conn->prepare("UPDATE tb_user SET username=?, level=?, nohp=?, alamat=?, password=? WHERE id=?");
    $stmt->bind_param("sssssi", $username, $level, $nohp, $alamat, $password, $id);

    if ($stmt->execute()) {
        $message = '<script>alert("Data berhasil diupdate"); window.location="../user";</script>';
    } else {
        $message = '<script>alert("Data gagal diupdate"); window.location="../user";</script>';
    }

    $stmt->close();
} else {
    header("Location: ../admin.php");
    exit();
}

echo $message;
?>
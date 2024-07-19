<?php
include "connect.php";

$current_password = isset($_POST['current_password']) ? htmlentities($_POST['current_password']) : "";
$new_password = isset($_POST['new_password']) ? htmlentities($_POST['new_password']) : "";
$confirm_password = isset($_POST['confirm_password']) ? htmlentities($_POST['confirm_password']) : "";
$id = isset($_POST['id']) ? htmlentities($_POST['id']) : "";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($new_password !== $confirm_password) {
        $message = '<script>alert("Password baru dan konfirmasi password tidak cocok"); window.location="../user";</script>';
    } else {
        $query = mysqli_query($conn, "SELECT password FROM tb_user WHERE id='$id'");
        $row = mysqli_fetch_assoc($query);
        if (password_verify($current_password, $row['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = mysqli_query($conn, "UPDATE tb_user SET password='$hashed_password' WHERE id='$id'");
            if ($update_query) {
                $message = '<script>alert("Password berhasil diubah"); window.location="../user";</script>';
            } else {
                $message = '<script>alert("Password gagal diubah"); window.location="../user";</script>';
            }
        } else {
            $message = '<script>alert("Password saat ini salah"); window.location="../user";</script>';
        }
    }
} else {
    header("Location: ../admin.php");
}

echo $message;
?>
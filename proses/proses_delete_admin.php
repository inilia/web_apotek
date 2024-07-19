<?php
include "connect.php";

$id = isset($_POST['id']) ? htmlentities($_POST['id']) : "";

$message = '';

if (isset($_POST['delete_admin_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("Data berhasil dihapus"); window.location="../user";</script>';
    } else {
        $message = '<script>alert("Data gagal dihapus"); window.location="../user";</script>';
    }
} else {
    header("Location: admin.php");
    exit();
}

echo $message;
?>
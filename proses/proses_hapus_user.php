<?php
include "../proses/connect.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM tb_user WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin.php?status=success&action=delete");
    } else {
        header("Location: ../admin.php?status=error&action=delete");
    }
}
?>
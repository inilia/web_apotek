<?php
include "connect.php";

if (isset($_POST['hapus_user_validate'])) {
    $id_admin = $_POST['id_admin'];


    $query = "DELETE FROM tb_user WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_admin);

    if ($stmt->execute()) {

        header("Location: ../admin.php?message=success_delete");
    } else {

        header("Location: ../admin.php?message=error_delete");
    }

    $stmt->close();
    $conn->close();
} else {

    header("Location: ../admin.php");
}
?>
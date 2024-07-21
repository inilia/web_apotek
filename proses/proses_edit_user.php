<?php
include "../proses/connect.php";

if (isset($_POST['edit_user_validate'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE tb_user SET nama='$nama', username='$username', level='$level', nohp='$nohp', alamat='$alamat' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin.php?status=success&action=edit");
    } else {
        header("Location: ../admin.php?status=error&action=edit");
    }
}
?>
<?php
include "connect.php";
$id = isset($_GET['id']) ? $_GET['id'] : '';
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = '$id'");
$user = mysqli_fetch_assoc($query);

echo json_encode($user);
?>
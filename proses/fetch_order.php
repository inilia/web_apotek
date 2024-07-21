<?php
include "connect.php";

$query = "SELECT * FROM pesanan";
$result = mysqli_query($conn, $query);

$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

echo json_encode($orders);

mysqli_close($conn);
?>
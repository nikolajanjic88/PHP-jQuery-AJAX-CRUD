<?php

require_once 'db.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo JSON_encode($users, 256);
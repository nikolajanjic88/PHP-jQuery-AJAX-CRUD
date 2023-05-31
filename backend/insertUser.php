<?php

require_once 'db.php';

$name = htmlentities($_POST['name']);
$email = htmlentities($_POST['email']);
$phone = htmlentities($_POST['phone']);
$place = htmlentities($_POST['place']);
$result['error'] = '';

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();

if($user) {
    $result['error'] = 'Email taken';
}

if(trim($name) === '' || trim($email) === '' || trim('phone') === '' || trim($place) === '') {
    $result['error'] = 'Enter all data';
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result['error'] = 'Invalid email address';
}

if($result['error'] === '') {
    $sql = "INSERT INTO users (name, email, phone, place) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $place);
    $stmt->execute();
}

echo JSON_encode($result);
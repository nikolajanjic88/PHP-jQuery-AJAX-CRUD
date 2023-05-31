<?php

require_once 'db.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();
    
    echo JSON_encode($user);
}

if(isset($_POST['hiddenData'])) {
    $id = $_POST['hiddenData'];
    $name = htmlentities($_POST['name']);
    $phone = htmlentities($_POST['phone']);
    $place = htmlentities($_POST['place']);
    $result['error'] = '';
    $result['success'] = '';

    if(trim($name) === '' || trim($phone) === '' || trim($place) === '') {
        $result['error'] = 'Enter all data';
    } 

    if($result['error'] === '') {
        $sql = "UPDATE users SET name = ?, phone = ?, place = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $phone, $place, $id);
        $stmt->execute();
        $result['success'] = 'User updated';
    }
        
    echo JSON_encode($result);
}
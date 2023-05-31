<?php

$conn = new mysqli('localhost', 'root', '', 'bootstrapcrud');

if(!$conn) {
    die(mysqli_error($conn));
}
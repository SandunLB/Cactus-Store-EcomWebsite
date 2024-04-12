<?php

$host = "localhost"; 
$username = "your_username"; 
$password = "your_password"; 
$database = "your_database";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

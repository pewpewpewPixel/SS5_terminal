<?php
$servername = "127.0.0.1"; // Change if hosted elsewhere
$username = "mariadb";
$password = "mariadb";
$dbname = "mariadb"; // Ensure this is the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
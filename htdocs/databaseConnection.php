<?php

$conn = mysqli_connect("127.0.0.1", "mariadb", "mariadb", "mariadb" );

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
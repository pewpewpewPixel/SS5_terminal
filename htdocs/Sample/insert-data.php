<?php


$server = "localhost";
$username = "root";
$password = "$";
$database_name = "finegaps";

$conn = mysqli_connect($server, $username, $password, $database_name);

if ($conn){
    echo "Database Connection Established Successfully";
}else{
    echo "Database Not Connected";
}

// CREATE, READ, UPDATE, DELETE
?>
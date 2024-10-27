<?php
include("db_connect.php");
include ("style.php");
include ("menu.php");

// Check if clientnumber is provided
if (isset($_GET['clientnumber'])) {
    $clientnumber = mysqli_real_escape_string($conn, $_GET['clientnumber']);

    // Delete the client from the database
    $sql = "DELETE FROM client WHERE clientnumber = '$clientnumber'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Client deleted successfully'); window.location='client.php';</script>";
    } else {
        echo "<script>alert('Error deleting client: " . mysqli_error($conn) . "'); window.location='client.php';</script>";
    }
} else {
    echo "<script>alert('No client number provided'); window.location='client.php';</script>";
}
?>
<?php

include_once "databaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (isset($_POST["submit"])) {
        
        $new_firstname = $_POST["new_firstname"];
        $new_lastname = $_POST["new_lastname"];
        
        $user_id = $_SESSION['user_Id'];

        $sql = "UPDATE user SET firstname='$new_firstname', lastname='$new_lastname' WHERE user_id='$user_id'";

        if ($conn->query($sql) === TRUE) {
            echo "User's name updated successfully";
        } else {
            echo "Error updating user's name: " . $conn->error;
        }
    }
}
?>



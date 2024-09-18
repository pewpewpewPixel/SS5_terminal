<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $firstname = filter_var($_POST["firstname"], );
    $lastname = filter_var($_POST["lastname"], );
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if (!$email) {
        die("<script>alert('Invalid Email Address!');
         window.location.href = 'profile.php';
         </script>");
    }

    try {
        require_once "databaseConnection.php";

        $query = "INSERT INTO user (firstname, lastname, email, `password`) VALUES (?, ?, ?, ?)";
        $statement = $conn->prepare($query);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $statement->bind_param("ssss", $firstname, $lastname, $email, $hashedPassword);
        $statement->execute();


        // Close resources
        $statement->close();
        $conn->close();

        
        // Redirect to profile page

        echo "<script>alert('Account Created Successfully! Please login.');
         window.location.href = 'login.php';
         </script>";

        exit();

    } catch (PDOException $errorMsg) {
        die("Failed to insert data to Database: " . $errorMsg->getMessage());
    }

} else {
  
    exit();
}

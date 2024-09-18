<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_input = $_POST["email"];
    $password_input = $_POST["password"];

    try {
        include "databaseConnection.php";
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_input); // Bind email input to the prepared statement
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result(); // Get the result set from the prepared statement

        if ($result->num_rows == 1) { // Check if a single row is returned
            $user = $result->fetch_assoc(); // Fetch the row as an associative array

            // Verify password
            if (password_verify($password_input, $user['password'])) {
                // Set session variables
                $_SESSION["loggedInUserId"] = $user["userId"];

                // Redirect to dashboard or any other page after successful login
                header("Location: profile.php");
                exit();
            } else {
                echo"<script>alert('Invalid email or password password, please try again.'); 
                window.location.href='login.php';
                </script>";
            }
        } else {
            echo"<script>alert('Invalid email or password password, please try again.'); 
            window.location.href='login.php';
            </script>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

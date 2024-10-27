<?php
    include("db_connect.php");
?>
<body>

<html>
<head>
</head>

<body>
    <center>
        <h1>Insert Client</h1>

        <form method="POST" action="insert_client.php">
            <table cellpadding="10" align="center" width="60%">
                <tr>
                    <td><label for="clientnumber">Client Number:</label></td>
                    <td><input type="text" name="clientnumber" required></td>
                </tr>
                <tr>
                    <td><label for="firstname">First Name:</label></td>
                    <td><input type="text" name="firstname" required></td>
                </tr>
                <tr>
                    <td><label for="middlename">Middle Name:</label></td>
                    <td><input type="text" name="middlename" required></td>
                </tr>
                <tr>
                    <td><label for="lastname">Last Name:</label></td>
                    <td><input type="text" name="lastname" required></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="add_client" value="Add Client">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Handle form submission
        if (isset($_POST['add_client'])) {
            // Establish database connection (replace with your connection details)
            $conn = new mysqli("your_host", "your_username", "your_password", "your_database");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $clientNumber = mysqli_real_escape_string($conn, trim($_POST['clientnumber']));
            $firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
            $middlename = mysqli_real_escape_string($conn, trim($_POST['middlename']));
            $lastname = mysqli_real_escape_string($conn, trim($_POST['lastname']));
            $address = mysqli_real_escape_string($conn, trim($_POST['address']));

            // Insert client data into the database
            $sql = "INSERT INTO clients (ClientNumber, firstname, middlename, lastname, address) VALUES ('$clientNumber', '$firstname', '$middlename', '$lastname', '$address')";

            if ($conn->query($sql)) {
                echo "<script>alert('Client has been added'); window.location= 'insert_client.php'; </script>";
            } else {
                echo "<script>alert('Error adding client: " . $conn->error . "');</script>";
            }

            // Close the database connection
            $conn->close();
        }
        ?>
    </center>
</body>
</html>
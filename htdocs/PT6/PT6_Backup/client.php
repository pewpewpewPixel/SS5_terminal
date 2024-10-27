<?php
include("style.php");
include("menu.php");
include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List</title>
</head>
<body>
    <h1>Clients List</h1>

    <table border="1">
        <tr>
            <th>Client Number</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <?php
        // Handle form submission for adding a new client
        if (isset($_POST['add_client'])) {
            $firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
            $middlename = mysqli_real_escape_string($conn, trim($_POST['middlename']));
            $lastname = mysqli_real_escape_string($conn, trim($_POST['lastname']));
            $address = mysqli_real_escape_string($conn, trim($_POST['address']));

            // Insert client data into the database
            $sql = "INSERT INTO client (clientfirstname, clientmiddlename, clientlastname, clientaddress) VALUES ('$firstname', '$middlename', '$lastname', '$address')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Client has been added'); window.location= 'client.php'; </script>";
            } else {
                echo "<script>alert('Error adding client: " . mysqli_error($conn) . "');</script>";
            }
        }
        
        // Retrieve all clients from the database
        $sql = "SELECT * FROM client ORDER BY clientnumber ASC"; // Sort clients by clientnumber
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $counter = 1; // Initialize a counter for sequential numbering
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $counter++ . "</td>"; // Display sequential number
                echo "<td>" . htmlspecialchars($row['clientfirstname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['clientmiddlename']) . "</td>";
                echo "<td>" . htmlspecialchars($row['clientlastname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['clientaddress']) . "</td>";
                echo "<td>
                        <a href='delete_client.php?clientnumber=" . $row['clientnumber'] . "' 
                           onclick=\"return confirm('Are you sure you want to delete this client?');\">
                           Delete
                        </a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No clients found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

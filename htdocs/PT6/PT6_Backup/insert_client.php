<html>
<head>
    <?php include("db_connect.php"); ?>
</head>

<body>
    <?php
    include("style.php");
    include("menu.php");
    ?>

    <center>
        <h1>Insert Client</h1>

        <form method="post">
            <table border="1" align="center" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Client Number</td>
                    <td><input type="text" name="clientnumber" required></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="firstname" required></td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td><input type="text" name="middlename" required></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="lastname" required></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" name="address" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit" name="insert_client">Insert Client</button>
                    </td>
                </tr>
            </table>
        </form>

        <?php
if (isset($_POST['insert_client'])) {
    $clientnumber = mysqli_real_escape_string($conn, trim($_POST['clientnumber']));
    $firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
    $middlename = mysqli_real_escape_string($conn, trim($_POST['middlename']));
    $lastname = mysqli_real_escape_string($conn, trim($_POST['lastname']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));

    // Check if the clientnumber already exists
    $checkQuery = "SELECT * FROM client WHERE clientnumber = '$clientnumber'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Error: Client number already exists. Please use a different number.');</script>";
    } else {
        // Insert new client if the client number doesn't exist
        $sql = "INSERT INTO client (clientnumber, clientfirstname, clientmiddlename, clientlastname, clientaddress) 
                VALUES ('$clientnumber', '$firstname', '$middlename', '$lastname', '$address')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Client added successfully'); window.location = 'client.php';</script>";
        } else {
            echo "Error inserting client: " . mysqli_error($conn);
        }
    }

    // Close the connection
    mysqli_close($conn);
}


?>
<?php
include("style.php");
include("menu.php");
include("db_connect.php");


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle add action
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $description = trim($_POST['description']);
        $asking_price = trim($_POST['asking_price']);
        $condition = trim($_POST['condition']);

        // Validate input
        if (empty($description) || empty($asking_price) || empty($condition)) {
            echo "All fields are required.";
        } else {
            // Insert new item into the database
            $insert_query = "INSERT INTO items (Description, AskingPrice, Conditions) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("sds", $description, $asking_price, $condition); // "sds" means string, double, string

            if ($stmt->execute()) {
                echo "New item added successfully!";
            } else {
                echo "Error adding item: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    // Handle delete action
    elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $item_number = intval($_POST['item_number']);
        
        // Prepare the delete statement
        $delete_query = "DELETE FROM items WHERE ItemNumber = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $item_number); // "i" means integer

        if ($stmt->execute()) {
            echo "Item deleted successfully!";
        } else {
            echo "Error deleting item: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Query to retrieve items from the database
$query = "SELECT ItemNumber, Description, AskingPrice, Conditions FROM items"; 
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items List</title>
</head>
<body>
    <h1>Items List</h1>

    <table border="1">
        <tr>
            <th>Item Number</th>
            <th>Description</th>
            <th>Asking Price</th>
            <th>Condition</th>
            <th>Action</th>
        </tr>

        <?php
        // Query to retrieve items from the database
        $query = "SELECT ItemNumber, Description, AskingPrice, Conditions FROM items"; 
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['ItemNumber']}</td>
                    <td>{$row['Description']}</td>
                    <td>{$row['AskingPrice']}</td>
                    <td>{$row['Conditions']}</td>
                    <td>
                        <form method='post' action='items.php' style='display:inline;'>
                            <input type='hidden' name='item_number' value='{$row['ItemNumber']}'>
                            <input type='hidden' name='action' value='delete'>
                            <button type='submit' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</button>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No items found.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

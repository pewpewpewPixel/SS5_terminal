<?php
include("db_connect.php");
include("style.php");
include("menu.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle add action
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $item_number = intval(trim($_POST['item_number'])); 
        $description = trim($_POST['description']);
        $asking_price = trim($_POST['asking_price']);
        $condition = trim($_POST['condition']);
        $comments = trim($_POST['comments']);

        // Validate input
        if (empty($item_number) || empty($description) || empty($asking_price) || empty($condition)) {
            echo "All fields are required.";
        } else {
            // Check if the item number already exists
            $check_query = "SELECT 1 FROM items WHERE ItemNumber = ?";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("i", $item_number);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "Error: Item number already exists. Please use a unique item number.";
            } else {
                // Insert new item into the database
                $insert_query = "INSERT INTO items (ItemNumber, Description, AskingPrice, Conditions, Comments) 
                                 VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_query);
                $stmt->bind_param("issss", $item_number, $description, $asking_price, $condition, $comments);

                if ($stmt->execute()) {
                    echo "New item added successfully!";
                } else {
                    echo "Error adding item: " . $stmt->error;
                }
            }
            $stmt->close();
        }
    } 
    // Handle delete action
    elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $item_number = intval($_POST['item_number']);
        $delete_query = "DELETE FROM items WHERE ItemNumber = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $item_number);

        if ($stmt->execute()) {
            echo "Item deleted successfully!";
        } else {
            echo "Error deleting item: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Query to retrieve items from the database
$query = "SELECT ItemNumber, Description, AskingPrice, Conditions, Comments FROM items"; 
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item (Optional)</title>
</head>
<body>
    <h2>Add New Item (Optional)</h2>

    <form method="post" action="Add_item_optional.php">
        <label for="item_number">Item Number:</label>
        <input type="number" name="item_number" required><br>

        <label for="description">Description:</label>
        <input type="text" name="description" required><br>

        <label for="asking_price">Asking Price:</label>
        <input type="number" step="0.01" name="asking_price" required><br>

        <label for="condition">Conditions:</label>
        <input type="text" name="condition" required><br>

        <label for="comments">Comments:</label>
        <textarea name="comments" rows="4" cols="50"></textarea><br>

        <input type="hidden" name="action" value="add">
        <button type="submit">Add Item</button>
    </form>

    <h2>Current Items</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Item Number</th>
                <th>Description</th>
                <th>Asking Price</th>
                <th>Conditions</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['ItemNumber']}</td>
                        <td>{$row['Description']}</td>
                        <td>{$row['AskingPrice']}</td>
                        <td>{$row['Conditions']}</td>
                        <td>{$row['Comments']}</td>
                        <td>
                            <form method='post' action='Add_item_optional.php' style='display:inline;'>
                                <input type='hidden' name='item_number' value='{$row['ItemNumber']}'>
                                <input type='hidden' name='action' value='delete'>
                                <button type='submit' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>

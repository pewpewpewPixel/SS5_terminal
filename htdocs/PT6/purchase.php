<?php
include("style.php");
include("menu.php");
include("db_connect.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $purchase_number = trim($_POST['purchase_number']);
        $purchase_cost = trim($_POST['purchase_cost']);
        $date_purchased = trim($_POST['date_purchased']);
        $condition = trim($_POST['condition']);
        $client_number = trim($_POST['client_number']);
        $item_id = trim($_POST['item_id']); // New field for item
        $quantity = trim($_POST['quantity']); // New field for quantity

        // Validate input
        if (empty($purchase_number) || empty($purchase_cost) || empty($date_purchased) || 
            empty($condition) || empty($client_number) || empty($item_id) || empty($quantity)) {
            echo "All fields are required.";
        } else {
            // Start a transaction to ensure consistency
            $conn->begin_transaction();
            try {
                // Insert into the purchase table
                $insert_purchase = "
                    INSERT INTO purchase 
                    (PurchaseNumber, PurchaseCost, DatePurchased, `Condition`, ClientNumber) 
                    VALUES (?, ?, ?, ?, ?)";
                $stmt1 = $conn->prepare($insert_purchase);
                $stmt1->bind_param("sssss", $purchase_number, $purchase_cost, $date_purchased, 
                                   $condition, $client_number);
                $stmt1->execute();

                // Insert into the transaction_record table
                $insert_transaction = "
                    INSERT INTO transaction_record 
                    (ClientNumber, ItemNumber, Quantity, TransactionDate) 
                    VALUES (?, ?, ?, ?)";
                $stmt2 = $conn->prepare($insert_transaction);
                $stmt2->bind_param("ssis", $client_number, $item_id, $quantity, $date_purchased);
                $stmt2->execute();

                // Commit the transaction
                $conn->commit();
                echo "Purchase and transaction recorded successfully!";
            } catch (Exception $e) {
                $conn->rollback(); // Rollback on error
                echo "Error: " . $e->getMessage();
            }

            $stmt1->close();
            $stmt2->close();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $purchase_number = $_POST['purchase_number'];

        // Delete purchase record
        $delete_query = "DELETE FROM purchase WHERE PurchaseNumber = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("s", $purchase_number);

        if ($stmt->execute()) {
            echo "Purchase deleted successfully!";
        } else {
            echo "Error deleting purchase: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Retrieve purchases from the database
$query = "SELECT PurchaseNumber, PurchaseCost, DatePurchased, `Condition`, ClientNumber FROM purchase";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase List</title>
</head>
<body>
    <h1>Purchase List</h1>

    <form method="post" action="purchase.php">
        <h3>Add New Purchase</h3>
        <input type="text" name="purchase_number" placeholder="Purchase Number" required><br>
        <input type="text" name="purchase_cost" placeholder="Purchase Cost" required><br>
        <input type="date" name="date_purchased" required><br>
        <input type="text" name="condition" placeholder="Condition" required><br>
        <input type="text" name="client_number" placeholder="Client Number" required><br>
        <input type="text" name="item_id" placeholder="Item ID" required><br>
        <input type="number" name="quantity" placeholder="Quantity" required><br>
        <input type="hidden" name="action" value="add">
        <button type="submit">Add Purchase</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Purchase Number</th>
                <th>Purchase Cost</th>
                <th>Date Purchased</th>
                <th>Condition</th>
                <th>Client Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['PurchaseNumber']}</td>
                        <td>{$row['PurchaseCost']}</td>
                        <td>{$row['DatePurchased']}</td>
                        <td>{$row['Condition']}</td>
                        <td>{$row['ClientNumber']}</td>
                        <td>
                            <form method='post' action='purchase.php' style='display:inline;'>
                                <input type='hidden' name='purchase_number' value='{$row['PurchaseNumber']}'>
                                <input type='hidden' name='action' value='delete'>
                                <button type='submit' onclick='return confirm(\"Are you sure?\");'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No purchases found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

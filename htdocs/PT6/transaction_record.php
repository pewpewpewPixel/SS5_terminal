<?php
include("db_connect.php");
include("style.php");
include("menu.php");

// Check if a delete request has been made
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM transaction_record WHERE TransactionID = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "Transaction successfully deleted.";
    } else {
        echo "Error deleting transaction: " . $stmt->error;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Records</title>
</head>
<body>
    <h1>Transaction Records</h1>
    <table border="1">
        <tr>
            <th>Transaction ID</th>
            <th>Client Number</th>
            <th>Item Number</th>
            <th>Item Description</th>
            <th>Asking Price</th>
            <th>Quantity</th>
            <th>Transaction Date</th>
            <th>Action</th> <!-- Added Action column for delete option -->
        </tr>

        <?php
        $query = "SELECT TransactionID, ClientNumber, ItemNumber, ItemDescription, 
                         AskingPrice, Quantity, TransactionDate 
                  FROM transaction_record 
                  ORDER BY TransactionDate DESC";
        
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . htmlspecialchars($row['TransactionID'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($row['ClientNumber'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($row['ItemNumber'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($row['ItemDescription'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($row['AskingPrice'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($row['Quantity'] ?? 'N/A') . "</td>
                    <td>" . htmlspecialchars($row['TransactionDate'] ?? 'N/A') . "</td>
                    <td><a href='?delete_id=" . htmlspecialchars($row['TransactionID']) . "' onclick=\"return confirm('Are you sure you want to delete this transaction?');\">Delete</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No transactions found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>

<?php
include("style.php");
include("menu.php");
include("db_connect.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $sale_id = trim($_POST['sale_id']); // Get Sale ID from form input
        $commission_paid = trim($_POST['commission_paid']);
        $selling_price = trim($_POST['selling_price']);
        $sales_tax = trim($_POST['sales_tax']);
        $date_sold = trim($_POST['date_sold']);
        $client_number = trim($_POST['client_number']);

        // Validate input
        if (empty($sale_id) || empty($commission_paid) || empty($selling_price) || 
            empty($sales_tax) || empty($date_sold) || empty($client_number)) {
            echo "All fields are required.";
        } else {
            // Insert new sale into the database
            $insert_query = "INSERT INTO sales 
                (SaleID, CommisionPaid, ActualSellingPrice, SalesTax, DateSold, ClientNumber) 
                VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ssssss", $sale_id, $commission_paid, $selling_price, 
                              $sales_tax, $date_sold, $client_number);

            if ($stmt->execute()) {
                echo "New sale added successfully!";
            } else {
                echo "Error adding sale: " . $stmt->error;
            }
            $stmt->close();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $sale_id = $_POST['sale_id'];

        // Prepare delete statement
        $delete_query = "DELETE FROM sales WHERE SaleID = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("s", $sale_id);

        if ($stmt->execute()) {
            echo "Sale deleted successfully!";
        } else {
            echo "Error deleting sale: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Query to retrieve sales from the database
$query = "SELECT SaleID, CommisionPaid, ActualSellingPrice, SalesTax, DateSold, ClientNumber FROM sales";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales List</title>
</head>
<body>
    <h1>Sales List</h1>

    <form method="post" action="sales.php">
        <h3>Add New Sale (Optional)</h3>
        <input type="text" name="sale_id" placeholder="Sale ID" required><br>
        <input type="text" name="commission_paid" placeholder="Commission Paid" required><br>
        <input type="text" name="selling_price" placeholder="Actual Selling Price" required><br>
        <input type="text" name="sales_tax" placeholder="Sales Tax" required><br>
        <input type="date" name="date_sold" required><br>
        <input type="text" name="client_number" placeholder="Client Number" required><br>
        <input type="hidden" name="action" value="add">
        <button type="submit">Add Sale</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>Commission Paid</th>
                <th>Actual Selling Price</th>
                <th>Sales Tax</th>
                <th>Date Sold</th>
                <th>Client Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if the query was successful
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['SaleID']}</td>
                        <td>{$row['CommisionPaid']}</td>
                        <td>{$row['ActualSellingPrice']}</td>
                        <td>{$row['SalesTax']}</td>
                        <td>{$row['DateSold']}</td>
                        <td>{$row['ClientNumber']}</td>
                        <td>
                            <form method='post' action='sales.php' style='display:inline;'>
                                <input type='hidden' name='sale_id' value='{$row['SaleID']}'>
                                <input type='hidden' name='action' value='delete'>
                                <button type='submit' onclick='return confirm(\"Are you sure you want to delete this sale?\");'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No sales found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

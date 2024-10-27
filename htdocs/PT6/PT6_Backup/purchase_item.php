<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
include("db_connect.php"); // This should initialize the $conn variable
include("style.php");
include("menu.php");

// Check if the connection was established successfully
if (isset($conn) && $conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Items for sale: now fetching directly from the database
$items = [];
$result = $conn->query("SELECT ItemNumber, Description, AskingPrice FROM items");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'id' => $row['ItemNumber'],
            'item_name' => $row['Description'],
            'price' => $row['AskingPrice']
        ];
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $client_id = trim($_POST['client_id']);
    $item_id = intval($_POST['item_id']);
    $quantity = intval($_POST['quantity']);

    // Validate input
    if (empty($client_id) || empty($item_id) || empty($quantity)) {
        echo "All fields are required.";
    } else {
        // Check if Client ID exists in the client table
        $stmt = $conn->prepare("SELECT 1 FROM client WHERE clientnumber = ? LIMIT 1");
        $stmt->bind_param("s", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Client ID [$client_id] does not exist. Please provide a valid Client ID.";
            exit; // Stop further execution if client ID is invalid
        }

        // Check if Item ID exists in the items table and get AskingPrice and Description
        $stmt = $conn->prepare("SELECT AskingPrice, Description FROM items WHERE ItemNumber = ? LIMIT 1");
        $stmt->bind_param("i", $item_id); // Assuming item_id is an integer
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Error: Item ID [$item_id] does not exist. Please provide a valid Item ID.";
            exit; // Stop further execution if item ID is invalid
        }

        // Fetch item price and name for transaction record
        $item = $result->fetch_assoc();
        $item_price = $item['AskingPrice'];
        $item_name = $item['Description'];

        // Proceed with the purchase if the Client ID and Item ID are valid
        $purchase_query = "INSERT INTO purchases (client_id, item_id, quantity, purchase_date) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($purchase_query);
        $stmt->bind_param("ssi", $client_id, $item_id, $quantity);

        if ($stmt->execute()) {
            // Insert into transaction_record
            $transaction_query = "INSERT INTO transaction_record (ClientNumber, ItemNumber, ItemDescription, AskingPrice, Quantity, TransactionDate) VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($transaction_query);
            $stmt->bind_param("ssssd", $client_id, $item_id, $item_name, $item_price, $quantity);

            if ($stmt->execute()) {
                echo "Purchase successful! Thank you for your order.";
            } else {
                echo "Error recording transaction: " . $stmt->error;
            }
        } else {
            echo "Error processing your purchase: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Item</title>
</head>
<body>
    <h1>Purchase Item</h1>

    <form method="post" action="purchase_item.php">
        <label for="client_id">Client ID:</label>
        <input type="text" name="client_id" required><br>

        <label for="item_id">Select Item:</label>
        <select name="item_id" required>
            <option value="">--Select an Item--</option>
            <?php
            // Loop through the items fetched from the database
            foreach ($items as $item) {
                echo '<option value="' . $item['id'] . '">' . htmlspecialchars($item['item_name']) . ' - $' . number_format($item['price'], 2) . '</option>';
            }
            ?>
        </select><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" min="1" required><br>

        <button type="submit">Purchase</button>
    </form>

</body>
</html>

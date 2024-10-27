<?php
include("db_connect.php"); // Include your database connection

// Check if sale_id is set in the URL
if (isset($_GET['sale_id'])) {
    $sale_id = intval($_GET['sale_id']); // Get the sale ID from the query string

    // Prepare the delete statement
    $delete_query = "DELETE FROM sales WHERE SaleID = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $sale_id); // Bind the sale ID as an integer

    if ($stmt->execute()) {
        // Redirect back to sales.php after successful deletion
        header("Location: sales.php?message=Sale deleted successfully.");
        exit; // Always exit after redirection
    } else {
        // If there's an error, redirect back with an error message
        header("Location: sales.php?error=Error deleting sale: " . $stmt->error);
        exit;
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the database connection
?>
<?php
// Database configuration
$host = 'localhost'; // Your database host
$db = 'your_database_name'; // Your database name
$user = 'your_username'; // Your database username
$pass = 'your_password'; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and sanitize input data
        $description = htmlspecialchars(trim($_POST['itemDescription']));
        $askingPrice = htmlspecialchars(trim($_POST['askingPrice']));
        $condition = htmlspecialchars(trim($_POST['itemCondition']));
        $comments = htmlspecialchars(trim($_POST['itemComments']));

        // Prepare an SQL statement for execution
        $stmt = $pdo->prepare("INSERT INTO items (description, asking_price, condition, comments) VALUES (:description, :asking_price, :condition, :comments)");

        // Bind parameters
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':asking_price', $askingPrice);
        $stmt->bindParam(':condition', $condition);
        $stmt->bindParam(':comments', $comments);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New item added successfully!";
        } else {
            echo "Error adding item.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

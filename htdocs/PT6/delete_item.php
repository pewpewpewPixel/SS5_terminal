<?php
include("menu.php");
include("style.php");
include("db_connect.php");

// Fetch items from the database
$result = $conn->query("SELECT ItemNumber, Description, AskingPrice, Conditions FROM items");

?>

<h2 class="center">Items</h2>
<table>
    <thead>
        <tr>
            <th>Item Number</th>
            <th>Description</th>
            <th>Asking Price</th>
            <th>Condition</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Display the items
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['ItemNumber']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Description']) . '</td>';
                echo '<td>' . htmlspecialchars(number_format($row['AskingPrice'], 2)) . '</td>';
                echo '<td>' . htmlspecialchars($row['Conditions']) . '</td>';
                echo '<td><a href="delete_item.php?item_number=' . htmlspecialchars($row['ItemNumber']) . '">Delete</a></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No items found.</td></tr>';
        }
        ?>
    </tbody>
</table>
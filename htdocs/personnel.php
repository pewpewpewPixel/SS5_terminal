<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Dump Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #eaeaea;
        }
        pre {
            background-color: #efefef;
            padding: 15px;
            border: 1px solid #ccc;
            overflow-x: auto;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<h1 class="center">Stillwater</h1>

<h2>Table: Clients</h2>
<table>
    <thead>
        <tr>
            <th>Client Number</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>2</td><td>Felix</td><td>Edward</td><td>Abernathy</td><td>707 Ash St, Stillwater, WA 98025</td></tr>
        <tr><td>4</td><td>Beatrice</td><td>Anne</td><td>Caldwell</td><td>789 Pine Rd, Stillwater, WA 98025</td></tr>
        <tr><td>1</td><td>Eleanor</td><td>Marie</td><td>Hargrove</td><td>123 Maple St, Stillwater, WA 98025</td></tr>
        <tr><td>10</td><td>Lila</td><td>Mae</td><td>Sinclair</td><td>606 Cherry Blvd, Stillwater, WA 98025</td></tr>
        <tr><td>5</td><td>Clara</td><td>Louise</td><td>Whitmore</td><td>202 Elm St, Stillwater, WA 98025</td></tr>
        <tr><td>7</td><td>Harold</td><td>Joseph</td><td>Pritchard</td><td>303 Cedar Ln, Stillwater, WA 98025</td></tr>
        <tr><td>8</td><td>Violet</td><td>Grace</td><td>Kingsley</td><td>404 Spruce Dr, Stillwater, WA 98025</td></tr>
        <tr><td>9</td><td>Vincent</td><td>Paul</td><td>Morrow</td><td>505 Willow Way, Stillwater, WA 98025</td></tr>
        <tr><td>3</td><td>Thomas</td><td>James</td><td>Finch</td><td>456 Oak Ave, Stillwater, WA 98025</td></tr>
        <tr><td>6</td><td>Jasper</td><td>Lee</td><td>Thornton</td><td>101 Birch Ct, Stillwater, WA 98025</td></tr>
    </tbody>
</table>

<h2>Table: Items</h2>
<table>
    <thead>
        <tr>
            <th>Item Number</th>
            <th>Description</th>
            <th>Asking Price</th>
            <th>Conditions</th>
            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Victorian Walnut Armchair</td><td>450.00</td><td>Good</td><td>Beautifully restored, perfect for any sitting area.</td></tr>
        <tr><td>2</td><td>Vintage Trunk Coffee Table</td><td>250.00</td><td>Fair</td><td>Sturdy trunk with vintage charm, offers storage.</td></tr>
        <tr><td>3</td><td>Mid-Century Modern Coffee Table</td><td>350.00</td><td>Excellent</td><td>Minimal signs of wear, ideal for modern decor.</td></tr>
        <tr><td>4</td><td>Edwardian Sideboard</td><td>600.00</td><td>Very Good</td><td>Solid construction with ornate detailing.</td></tr>
        <tr><td>5</td><td>Antique Oak Writing Desk</td><td>500.00</td><td>Good</td><td>Functional with minor scratches, adds character.</td></tr>
        <tr><td>6</td><td>Rustic Farmhouse Dining Table</td><td>700.00</td><td>Fair</td><td>Reclaimed wood with a weathered finish.</td></tr>
        <tr><td>7</td><td>French Provincial Nightstand</td><td>200.00</td><td>Excellent</td><td>Charming and functional with vintage brass knobs.</td></tr>
        <tr><td>8</td><td>Art Deco Lounge Chair</td><td>400.00</td><td>Very Good</td><td>Stylish design with rich leather upholstery.</td></tr>
        <tr><td>9</td><td>Regency Style Dining Chairs (Set of 4)</td><td>800.00</td><td>Good</td><td>Upholstered in elegant fabric, great for dining.</td></tr>
        <tr><td>10</td><td>Baroque Style Mirror</td><td>300.00</td><td>Excellent</td><td>Intricate carvings with a stunning gold-leaf finish.</td></tr>
    </tbody>
</table>

<h2>Table: Purchase</h2>
<table>
    <thead>
        <tr>
            <th>Purchase Number</th>
            <th>Purchase Cost</th>
            <th>Date Purchased</th>
            <th>Condition</th>
            <th>Client Number</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>400.00</td><td>2024-09-22</td><td>New</td><td>1</td></tr>
        <tr><td>2</td><td>350.00</td><td>2024-09-23</td><td>Used</td><td>2</td></tr>
        <tr><td>3</td><td>600.00</td><td>2024-09-24</td><td>Refurbished</td><td>3</td></tr>
        <tr><td>4</td><td>250.00</td><td>2024-09-25</td><td>New</td><td>4</td></tr>
        <tr><td>5</td><td>450.00</td><td>2024-09-26</td><td>Used</td><td>5</td></tr>
        <tr><td>6</td><td>500.00</td><td>2024-09-27</td><td>New</td><td>6</td></tr>
        <tr><td>7</td><td>700.00</td><td>2024-09-28</td><td>Refurbished</td><td>7</td></tr>
        <tr><td>8</td><td>300.00</td><td>2024-09-29</td><td>Used</td><td>8</td></tr>
        <tr><td>9</td><td>200.00</td><td>2024-09-30</td><td>New</td><td>9</td></tr>
    </tbody>
</table>

<h2>Table: Sales</h2>
<table>
    <thead>
        <tr>
            <th>Sale ID</th>
            <th>Commission Paid</th>
            <th>Actual Selling Price</th>
            <th>Sales Tax</th>
            <th>Date Sold</th>
            <th>Client Number</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>50.00</td><td>450.00</td><td>25.00</td><td>2024-10-01</td><td>1</td></tr>
        <tr><td>2</td><td>30.00</td><td>250.00</td><td>15.00</td><td>2024-10-02</td><td>2</td></tr>
        <tr><td>3</td><td>60.00</td><td>600.00</td><td>30.00</td><td>2024-10-03</td><td>3</td></tr>
    </tbody>
</table>

<h2>Insert Client</h2>
<form action="insert_client.php" method="post">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="middle_name" placeholder="Middle Name">
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="submit" value="Add Client">
</form>

<h2>Insert Item</h2>
<form action="insert_item.php" method="post">
    <input type="text" name="description" placeholder="Description" required>
    <input type="number" step="0.01" name="asking_price" placeholder="Asking Price" required>
    <input type="text" name="conditions" placeholder="Conditions" required>
    <textarea name="comments" placeholder="Comments"></textarea>
    <input type="submit" value="Add Item">
</form>

</body>
</html>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Dump Display</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #e9ecef;
            color: #333;
        }
        nav {
            background-color: #007bff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        h1, h2 {
            text-align: center;
            color: #495057;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #dee2e6;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e2e6ea;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
<nav>
    <a href="#home">Home</a>
    <a href="#clients">Go to Clients</a>
    <a href="#items">Go to Items</a>
    <a href="#purchases">Go to Purchases</a>
    <a href="#sales">Go to Sales</a>
    <a href="#insert-clients">Insert Client Data</a>
    <a href="#insert-items">Insert Item Data</a>
    <a href="#insert-purchases">Insert Purchase Data</a>
    <a href="#insert-sales">Insert Sale Data</a>
</nav>

<h1 class="center">Stillwater</h1>

<h2 id="insert-clients">Insert Client Data</h2>
<form action="insert_client.php" method="post">
    <label for="clientFirstName">First Name:</label>
    <input type="text" id="clientFirstName" name="clientFirstName" required><br><br>
    
    <label for="clientLastName">Last Name:</label>
    <input type="text" id="clientLastName" name="clientLastName" required><br><br>
    
    <label for="clientAddress">Address:</label>
    <input type="text" id="clientAddress" name="clientAddress" required><br><br>
    
    <input type="submit" value="Insert Client Data">
</form>

<h2 id="insert-items">Insert Item Data</h2>
<form action="insert_item.php" method="post">
    <label for="itemDescription">Description:</label>
    <input type="text" id="itemDescription" name="itemDescription" required><br><br>
    
    <label for="askingPrice">Asking Price:</label>
    <input type="number" id="askingPrice" name="askingPrice" required><br><br>
    
    <label for="itemCondition">Condition:</label>
    <input type="text" id="itemCondition" name="itemCondition" required><br><br>
    
    <input type="submit" value="Insert Item Data">
</form>

<h2 id="insert-purchases">Insert Purchase Data</h2>
<form action="insert_purchase.php" method="post">
    <label for="purchaseCost">Purchase Cost:</label>
    <input type="number" id="purchaseCost" name="purchaseCost" required><br><br>
    
    <label for="purchaseDate">Date Purchased:</label>
    <input type="date" id="purchaseDate" name="purchaseDate" required><br><br>
    
    <label for="purchaseClient">Client Number:</label>
    <input type="number" id="purchaseClient" name="purchaseClient" required><br><br>
    
    <input type="submit" value="Insert Purchase Data">
</form>

<h2 id="insert-sales">Insert Sale Data</h2>
<form action="insert_sale.php" method="post">
    <label for="commissionPaid">Commission Paid:</label>
    <input type="number" id="commissionPaid" name="commissionPaid" required><br><br>
    
    <label for="sellingPrice">Actual Selling Price:</label>
    <input type="number" id="sellingPrice" name="sellingPrice" required><br><br>
    
    <label for="salesTax">Sales Tax:</label>
    <input type="number" id="salesTax" name="salesTax" required><br><br>
    
    <label for="saleDate">Date Sold:</label>
    <input type="date" id="saleDate" name="saleDate" required><br><br>
    
    <label for="saleClient">Client Number:</label>
    <input type="number" id="saleClient" name="saleClient" required><br><br>
    
    <input type="submit" value="Insert Sale Data">
</form>

<h2 id="clients">Table: Clients</h2>
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
        <tr><td>1</td><td>Felix</td><td>Edward</td><td>Abernathy</td><td>707 Ash St, Stillwater, WA 98025</td></tr>
        <tr><td>2</td><td>Beatrice</td><td>Anne</td><td>Caldwell</td><td>789 Pine Rd, Stillwater, WA 98025</td></tr>
        <tr><td>3</td><td>Eleanor</td><td>Marie</td><td>Hargrove</td><td>123 Maple St, Stillwater, WA 98025</td></tr>
        <tr><td>4</td><td>Lila</td><td>Mae</td><td>Sinclair</td><td>606 Cherry Blvd, Stillwater, WA 98025</td></tr>
        <tr><td>5</td><td>Clara</td><td>Louise</td><td>Whitmore</td><td>202 Elm St, Stillwater, WA 98025</td></tr>
        <tr><td>6</td><td>Harold</td><td>Joseph</td><td>Pritchard</td><td>303 Cedar Ln, Stillwater, WA 98025</td></tr>
        <tr><td>7</td><td>Violet</td><td>Grace</td><td>Kingsley</td><td>404 Spruce Dr, Stillwater, WA 98025</td></tr>
        <tr><td>8</td><td>Vincent</td><td>Paul</td><td>Morrow</td><td>505 Willow Way, Stillwater, WA 98025</td></tr>
        <tr><td>9</td><td>Thomas</td><td>James</td><td>Finch</td><td>456 Oak Ave, Stillwater, WA 98025</td></tr>
        <tr><td>10</td><td>Jasper</td><td>Lee</td><td>Thornton</td><td>101 Birch Ct, Stillwater, WA 98025</td></tr>
    </tbody>
</table>

<h2 id="items">Table: Items</h2>
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

<h2 id="purchases">Table: Purchase</h2>
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
    </tbody>
</table>

<h2 id="sales">Table: Sales</h2>
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
        <tr><td>4</td><td>45.00</td><td>500.00</td><td>20.00</td><td>2024-10-04</td><td>4</td></tr>
        <tr><td>5</td><td>70.00</td><td>750.00</td><td>37.50</td><td>2024-10-05</td><td>5</td></tr>
        <tr><td>6</td><td>55.00</td><td>400.00</td><td>20.00</td><td>2024-10-06</td><td>6</td></tr>
        <tr><td>7</td><td>80.00</td><td>800.00</td><td>40.00</td><td>2024-10-07</td><td>7</td></tr>
        <tr><td>8</td><td>65.00</td><td>550.00</td><td>27.50</td><td>2024-10-08</td><td>8</td></tr>
    </tbody>
</table>
</body>
</html>

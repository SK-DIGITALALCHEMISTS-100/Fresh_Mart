<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "df";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products from the product table, including product type
$sql = "SELECT id, product_name, product_type, amount, quantity FROM product"; // Use 'products' table and correct columns
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Stock View - Dashboard</title>
    <style>
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }
        .stock-table {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .stock-status-low {
            color: red;
            font-weight: bold;
        }
        .stock-status-ok {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Product Stock View</h2>

    <div class="stock-table mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Type</th> <!-- New Column -->
                    <th>Amount</th>
                    <th>Stock Quantity</th>
                    <th>Stock Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Adjust stock status check based on the desired threshold
                        $stock_status = ($row['quantity'] > 10) ? "<span class='stock-status-ok'>In Stock</span>" : "<span class='stock-status-low'>Low Stock</span>";
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['product_name']}</td>
                                <td>{$row['product_type']}</td> <!-- Display Product Type -->
                                <td>{$row['amount']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$stock_status}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found</td></tr>"; // Updated colspan
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Back Button -->
    <div class="mt-3">
        <a href="admin_access.php" class="btn btn-secondary">Back</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

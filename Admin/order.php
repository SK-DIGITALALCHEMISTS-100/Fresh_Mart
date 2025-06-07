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

// Fetch all orders and their details from the 'orders' and 'order_items' tables
$sql = "SELECT orders.id as order_id, orders.name, orders.address, orders.mobile_no, 
        orders.payment_method, orders.total, order_items.product_name, order_items.amount, 
        order_items.quantity, order_items.total_price
        FROM orders
        JOIN order_items ON orders.id = order_items.order_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Order View - Dashboard</title>
    <style>
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }
        .order-table {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order Details</h2>

    <div class="order-table mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Mobile No</th>
                    <th>Payment Method</th>
                    <th>Total Amount</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['order_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['mobile_no']}</td>
                                <td>{$row['payment_method']}</td>
                                <td>{$row['total']}</td>
                                <td>{$row['product_name']}</td>
                                <td>{$row['amount']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['total_price']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No orders found</td></tr>";
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

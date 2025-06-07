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

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: checkout.php');
    exit();
}

// Handle order confirmation and save details (e.g., save to database)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile_no = $_POST['mobile_no'];
    $payment_method = $_POST['payment_method'];

    // Calculate total
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['total_price'];
    }

    // Insert order details into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (name, address, mobile_no, payment_method, total) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssi", $name, $address, $mobile_no, $payment_method, $total);
        if ($stmt->execute()) {
            $order_id = $stmt->insert_id;  // Get the inserted order ID

            // Insert order items into the order_items table
            $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_name, amount, quantity, total_price) VALUES (?, ?, ?, ?, ?)");
            foreach ($_SESSION['cart'] as $item) {
                $stmt_item->bind_param("issii", $order_id, $item['product_name'], $item['amount'], $item['quantity'], $item['total_price']);
                $stmt_item->execute();

                // Reduce stock for the purchased product
                $product_name = $item['product_name'];
                $purchase_quantity = $item['quantity'];

                // Fetch the current stock for the product
                $stock_stmt = $conn->prepare("SELECT quantity FROM product WHERE product_name = ?");
                $stock_stmt->bind_param("s", $product_name);
                $stock_stmt->execute();
                $stock_result = $stock_stmt->get_result();

                if ($stock_result->num_rows > 0) {
                    $row = $stock_result->fetch_assoc();
                    $current_stock = $row['quantity'];

                    // Check if enough stock is available
                    if ($current_stock >= $purchase_quantity) {
                        $new_stock = $current_stock - $purchase_quantity;

                        // Update stock in the product table
                        $update_stock_stmt = $conn->prepare("UPDATE product SET quantity = ? WHERE product_name = ?");
                        $update_stock_stmt->bind_param("is", $new_stock, $product_name);
                        $update_stock_stmt->execute();
                        $update_stock_stmt->close();
                    } else {
                        echo "<script>alert('Not enough stock for {$item['product_name']}.');</script>";
                        // Handle case where there's not enough stock
                    }
                }
                $stock_stmt->close();
            }
            $stmt_item->close();

            // Clear the cart after successful order placement
            $_SESSION['cart'] = [];

            // Close the statement and connection
            $stmt->close();
            $conn->close();

            // Redirect or display a thank you message
            echo "<script>alert('Thank you for your purchase, {$name}!'); window.location.href='user_product.php';</script>";
        } else {
            echo "<script>alert('Error placing the order. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Error preparing the order statement.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Order Confirmation</title>
    <style>
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }
        .billing-table {
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
        .order-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .thank-you {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order Confirmation</h2>

    <!-- Billing Table -->
    <div class="billing-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    echo "<tr>
                            <td>{$item['product_name']}</td>
                            <td>{$item['amount']}</td>
                            <td>{$item['quantity']}</td>
                            <td>{$item['total_price']}</td>
                        </tr>";
                    $total += $item['total_price'];
                }
                echo "<tr>
                        <td colspan='3' align='right'><strong>Total</strong></td>
                        <td><strong>{$total}</strong></td>
                    </tr>";
                ?>
            </tbody>
        </table>
    </div>

    <!-- Order Form -->
    <div class="order-form mt-4">
        <form id="orderForm" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="mobile_no" class="form-label">Mobile No</label>
                <input type="text" id="mobile_no" name="mobile_no" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select id="payment_method" name="payment_method" class="form-select" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="debit_card">Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" name="confirm_order" class="btn btn-success">Confirm Order</button>
            <a href="checkout.php" class="btn btn-secondary">Back to Cart</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

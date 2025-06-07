<!DOCTYPE html>
<html lang="en">
<head>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .product-list {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:hover td {
            background-color: #f1f1f1;
        }

        button, input[type="number"], input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="number"] {
            width: 50px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
        }

        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .cart-button {
            margin-top: 5px;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #6c757d;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .filter-form {
            margin-bottom: 20px;
            text-align: left;
        }

        .filter-form input[type="submit"] {
            background-color: #28a745;
            color: white;
            margin-right: 10px;
        }

        .filter-form input[type="submit"]:hover {
            background-color: #218838;
        }

        .filter-form .clear-button {
            background-color: #dc3545;
            color: white;
        }

        .filter-form .clear-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="product-list">
        <h2>Juice</h2>

        <!-- Filter Form -->
        <div class="filter-form">
            <form method="GET" action="">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" value="<?php echo isset($_GET['product_name']) ? htmlspecialchars($_GET['product_name']) : ''; ?>">
                </div>
                <input type="submit" value="Filter" class="btn btn-primary">
                <input type="submit" value="Clear" name="clear_filter" class="btn clear-button">
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product Type</th>
                    <th>Product Name</th>
                    <th>Empno</th>
                    <th>Amount</th>
                    <th>Image</th>
                    <th>Add to Cart</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                    // Get filter parameters from URL
                    $product_name = isset($_GET['product_name']) ? $conn->real_escape_string($_GET['product_name']) : '';

                    // Clear filter if 'clear_filter' is set
                    if (isset($_GET['clear_filter'])) {
                        $product_name = '';
                    }

                    // Prepare SQL query with filters
                    $sql = "SELECT * FROM product WHERE product_type = 'juice'";

                    if (!empty($product_name)) {
                        $sql .= " AND product_name LIKE '%$product_name%'";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['product_type']}</td>";
                            echo "<td>{$row['product_name']}</td>";
                            echo "<td>{$row['empno']}</td>";
                            echo "<td>{$row['amount']}</td>";
                            echo "<td><img src='{$row['img']}' alt='Product Image' style='width:50px;height:50px;'></td>";
                            
                            // Form to send product data to checkout.php
                            echo "<td>
                                <form method='POST' action='checkout.php'>
                                    <input type='hidden' name='product_name' value='{$row['product_name']}' />
                                    <input type='hidden' name='amount' value='{$row['amount']}' />
                                    <label>Quantity: <input type='number' name='quantity' value='1' min='1' /></label>
                                    <button type='submit' name='add_to_cart' class='cart-button'>Add to Cart</button>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No juice products found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <button onclick="window.location.href='user_product.php'" class="back-button">Back to Home</button>
</body>
</html>

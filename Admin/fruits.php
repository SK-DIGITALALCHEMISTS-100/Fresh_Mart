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

        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
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
    </style>
</head>
<body>
    <div class="product-list">
        <h2>Fruits</h2>

        <table>
            <thead>
                <tr>
                    <th>Product Type</th>
                    <th>Product Name</th>
                    <th>Empno</th>
                    <th>Amount</th>
                    <th>Image</th>
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

                    // Prepare SQL query to fetch all skin care products
                    $sql = "SELECT * FROM product WHERE product_type = 'fruits'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['product_type']}</td>";
                            echo "<td>{$row['product_name']}</td>";
                            echo "<td>{$row['empno']}</td>";
                            echo "<td>{$row['amount']}</td>";
                            echo "<td><img src='{$row['img']}' alt='Product Image' style='width:50px;height:50px;'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No fruits products found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <button onclick="window.location.href='admin_access.php'" class="back-button">Back to Home</button>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>

    <div class="container">
        <h1>Product Management</h1>
        <!-- Form to search products by employee number -->
        <form action="" method="POST">
            <label for="empno">Search by Employee Number:</label>
            <input type="text" id="empno" name="empno" required>
            <button type="submit" name="searchempno">Search</button>
        </form>

        <div class="bill">
            <button onclick="window.location.href='admin_access.php'">BACK</button>
        </div>

        <?php
        // Include your database connection code
        include 'db_connection.php';

        // Handle the search query
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchempno'])) {
            $empno = $_POST['empno'];
            $sanitizedempno = mysqli_real_escape_string($connection, $empno); // Properly sanitize input

            // Search products by employee number
            $query = "SELECT * FROM product WHERE empno LIKE '%$sanitizedempno%'";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<tr><th>Product Type</th><th>Product Name</th><th>Amount</th><th>Image</th><th>Actions</th></tr>';

                // Fetch products and display them
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['product_type'] . '</td>';
                    echo '<td>' . $row['product_name'] . '</td>';
                    echo '<td>' . $row['amount'] . '</td>';
                    echo '<td><img src="' . $row['img'] . '" alt="Product Image" style="width:100px;"></td>';
                    echo '<td>';

                    // Update product form
                    echo '<form method="POST" action="update.php" style="display:inline-block; margin-right:10px;">';
                    echo '<input type="hidden" name="productId" value="' . $row['id'] . '">';
                    echo '<label for="newProductType">New Product Type:</label>';
                    echo '<input type="text" name="newProductType" value="' . $row['product_type'] . '" required>';
                    echo '<label for="newProductName">New Product Name:</label>';
                    echo '<input type="text" name="newProductName" value="' . $row['product_name'] . '" required>';
                    echo '<label for="newAmount">New Amount:</label>';
                    echo '<input type="number" name="newAmount" value="' . $row['amount'] . '" required>';
                    echo '<label for="newImg">New Image URL:</label>';
                    echo '<input type="text" name="newImg" value="' . $row['img'] . '" required>';
                    echo '<button type="submit" name="updateProduct">Update</button>';
                    echo '</form>';

                    // Delete product form
                    echo '<form method="POST" action="delete.php" style="display:inline-block;" onsubmit="return confirm(\'Are you sure you want to delete this product?\');">';
                    echo '<input type="hidden" name="productId" value="' . $row['id'] . '">';
                    echo '<button type="submit" name="deleteProduct" class="btn-danger">Delete</button>';
                    echo '</form>';

                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No products found for the given employee number.</p>';
            }
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
    
</body>
</html>

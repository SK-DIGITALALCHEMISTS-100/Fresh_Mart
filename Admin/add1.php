<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
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
        .product-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        #submitModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="product-form">
        <h2>Product Details Form</h2>
        <form id="productForm" action="" method="post" enctype="multipart/form-data">
            <label for="productType">Product Type:</label>
            <select name="productType" id="productType" required>
                <option value="" disabled selected>Select Type</option>
                <option value="Juice">Juice</option>
                <option value="Fruits">Fruits</option>
                <option value="Dates">Dates</option>
            </select>
            <br>

            <label for="productName">Product Name:</label>
            <input type="text" name="productName" required>

            <label for="empno">Empno:</label>
            <input type="text" name="empno" required>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" required>

            <label for="quantity">Quantity:</label> <!-- New field for quantity -->
            <input type="number" name="quantity" required>

            <label for="productImage">Product Image:</label>
            <input type="file" name="productImage" accept="image/*" required>

            <button type="submit" name="submit">Submit</button>
        </form>

        <!-- Back to Home Button -->
        <button onclick="window.location.href='admin_access.php'">Back to Home</button>
        
        <!-- Modal for success message -->
        <div id="submitModal">
            <p>Product added successfully!</p>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('submitModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('submitModal').style.display = 'none';
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "df";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch form data
        $productType = $_POST['productType'];
        $productName = $_POST['productName'];
        $empno = $_POST['empno'];
        $amount = $_POST['amount'];
        $quantity = $_POST['quantity']; // Fetch the quantity

        // Validate employee number exists in the admindata table
        $checkEmpnoQuery = $conn->prepare("SELECT * FROM admindata WHERE empno = ?");
        $checkEmpnoQuery->bind_param("s", $empno);
        $checkEmpnoQuery->execute();
        $result = $checkEmpnoQuery->get_result();

        if ($result->num_rows > 0) {
            // Employee exists, handle file upload
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
            $uploadOk = true;

            // Check if image file is valid
            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                $uploadOk = true;
            } else {
                $uploadOk = false;
                echo "<script>alert('Error uploading the file');</script>";
            }

            if ($uploadOk) {
                // Insert product data into the database
                $insertQuery = $conn->prepare("INSERT INTO product (product_type, product_name, empno, amount, img, quantity) VALUES (?, ?, ?, ?, ?, ?)"); // Added quantity
                $insertQuery->bind_param("sssisi", $productType, $productName, $empno, $amount, $targetFile, $quantity); // Include quantity in bind

                if ($insertQuery->execute()) {
                    echo "<script>openModal();</script>";
                } else {
                    echo "<script>alert('Error adding product: " . $conn->error . "');</script>";
                }

                $insertQuery->close();
            }
        } else {
            // Employee number does not exist in admindata
            echo "<script>alert('Error: Empno not found in admindata table. Please check your Empno.');</script>";
        }

        $checkEmpnoQuery->close();
        $conn->close();
    }
    ?>
</body>
</html>

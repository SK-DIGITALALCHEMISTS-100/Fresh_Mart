<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('bg.jpg') center/cover no-repeat; /* Update to your background image */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #021522;
            color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            box-sizing: border-box;
            width: 100%;
            font-size: 18px;
            border: none;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            color: #4a4a4a;
            background: #fff;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .signup-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .signup-link a {
            color: #28a745;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <div class="signup-link">
            <p>Don't have an account? <a href=" user_sign.php">Sign Up</a></p>
        </div>
        <div class="forgot-password-link">
            <p><a href="user_forget.php">Forgot Password?</a></p>
            <p><a href="/Bhuvana/home_page.html">Home</a></p>
        </div>

        <?php
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username_db = "root";
            $password_db = "";
            $dbname = "df";

            // Create connection
            $conn = new mysqli($servername, $username_db, $password_db, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);

            // Fetch user details
            $sql = "SELECT * FROM userdata WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Verify the password
                if (password_verify($password, $row["password"])) {
                    echo '<script>alert("Login successful! Redirecting...");</script>';
                    // Redirect to the desired page
                    header("Location: user_product.php"); // Change to your desired page
                    exit();
                } else {
                    echo '<script>alert("Invalid password!");</script>';
                }
            } else {
                echo '<script>alert("Invalid username!");</script>';
            }

            // Close the database connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

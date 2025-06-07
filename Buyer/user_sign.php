<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sign Up</title>
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

        .signup-container {
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

        .login-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #28a745;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="tel" name="mobile" placeholder="Mobile Number" required>
            <input type="submit" value="Sign Up">
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="user_login.php">Login</a></p>
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
            $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $sql = "INSERT INTO userdata (username, password, mobile) VALUES ('$username', '$hashed_password', '$mobile')";
            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Registration successful!");</script>';
            } else {
                echo '<script>alert("Error: ' . $conn->error . '");</script>';
            }

            // Close the database connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

<?php
session_start(); // Start session to access mobile number

// Redirect to forgot page if mobile number is not set
if (!isset($_SESSION['mobile'])) {
    header("Location: forgot.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Change Password</title>
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

        .change-password-container {
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

        .back-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .back-link a {
            color: #28a745;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="change-password-container">
        <h2>Change Password</h2>
        <form action="" method="post">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" value="Change Password">
        </form>
        <div class="back-link">
            <p><a href="user_login.php">Back to Login</a></p>
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

            $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);
            $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);
            $phoneno = $_SESSION['mobile'];

            // Check if passwords match
            if ($new_password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $sql = "UPDATE userdata SET password='$hashed_password' WHERE mobile='$phoneno'";
                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Password changed successfully!");</script>';
                    session_unset(); // Clear session variables
                    session_destroy(); // Destroy the session
                    header("Location: user_login.php"); // Redirect to login page
                    exit();
                } else {
                    echo '<script>alert("Error changing password.");</script>';
                }
            } else {
                echo '<script>alert("Passwords do not match.");</script>';
            }

            // Close the database connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

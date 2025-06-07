<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>ADMIN LOGIN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background color: ; center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .bar {
            padding: 10px;
            position: absolute;
            top: 0;
            right: 0;
        }
        .login-container {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 30px;
            border-radius: 8px;
            width: 350px;
            text-align: center;
        }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container input[type="submit"]:hover {
            background-color: #218838;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .navbar {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .navbar .nav-link {
            color: white;
        }
    </style>
</head>
<body>

    <div class="bar">
        <nav class="navbar navbar-dark">
            <div class="container-fluid">
                <a class="nav-link" href="\Bhuvana\home_page.html">HOME</a>
            </div>
        </nav>
    </div>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="" method="post">
            <input type="text" name="empno" placeholder="Employee Number" required>
            <input type="submit" value="Login">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>

<?php
// Handle form submission and validation
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "df";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind to prevent SQL injection
    $stmt = $conn->prepare("SELECT empno FROM admindata WHERE empno = ?");
    $stmt->bind_param("s", $empno);

    // Set parameters and execute
    $empno = $_POST["empno"];
    $stmt->execute();
    $stmt->store_result();

    // Check if the employee number exists
    if ($stmt->num_rows > 0) {
        // Redirect to the admin access page
        header("Location: admin_access.php");
        exit();
    } else {
        echo '<script>alert("Invalid employee number!");</script>';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

?>

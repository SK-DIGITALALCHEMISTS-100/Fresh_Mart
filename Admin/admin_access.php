<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body {
            background-image: url('bg11.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .navbar {
            background-color: rgba(0, 0, 0, 0.85); /* Darker transparent background */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); /* Navbar shadow */
            padding: 10px 0;
        }
        
        .navbar a {
            color: white;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        
        .navbar a:hover {
            background-color: #00FF00;
            color: white;
        }
        
        .content {
            padding: 50px 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Transparent white background for content */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Content shadow */
            margin-top: 30px;
        }
        
        h2 {
            color: #333;
            font-size: 30px;
            font-weight: 600;
        }
        
        .home-text {
            padding: 30px;
            margin: 20px;
            background-color: rgba(0, 0, 0, 0.7); /* Dark transparent background for text box */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for text box */
        }
        
        h1 {
            font-size: 60px;
            color: #00FF00;
            font-weight: 700;
            line-height: 1.2;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .home-text h1 {
            transition: transform 0.3s ease;
        }
        
        .home-text:hover h1 {
            transform: scale(1.05); /* Subtle zoom effect on hover */
        }
        
        /* Buttons in the navigation bar */
        .nav-item {
            margin-right: 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .navbar a {
                font-size: 14px;
            }
            h1 {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="add1.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">Update Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="juice.php">Juice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fruits.php">Fruits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dates.php">Dates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stock_view.php">Stock Manage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Order Manage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content container">
        <h2>Welcome,Admin!</h2>
        <div class="home-text">
            <h1><b>“Don’t Let Yesterday <br> Take Up Too Much of <br>Today.”</b></h1>
            <!-- Add your admin panel content here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

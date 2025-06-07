<?php
    session_start();
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    $displayName = isset($_SESSION['display_name']) ? $_SESSION['display_name'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER PRODUCT PAGE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #e3ffe7 0%, #d9e7ff 100%);
    }

    h1 {
        color: #17A589;
        text-align: center;
        letter-spacing: 10px;
        margin-top: 20px;
        font-size: 60px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    }

    .main {
        background-color: #FFDDC1;
        padding: 15px;
        text-align: center;
    }

    marquee {
        font-size: 20px;
        color: #333;
        font-weight: bold;
    }

    nav {
        background-color: #333;
        text-align: right;
        padding: 10px;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    nav li {
        display: inline;
    }

    nav a {
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        display: inline-block;
    }

    nav a:hover {
        background-color: #ddd;
        color: black;
    }

    label {
        font-size: 24px;
        font-style: italic;
        text-align: center;
        display: block;
        margin: 20px 0;
        color: #5D6D7E;
    }

    h3 {
        text-align: center;
        font-size: 28px;
        margin: 15px 0;
        color: #333;
    }

    .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin: 50px 0;
    }

    .content {
        width: 25%;
        margin: 20px;
        box-sizing: border-box;
        text-align: center;
        border-radius: 15px;
        cursor: pointer;
        padding: 20px;
        background: #fff;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .content:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 30px rgba(0,0,0,0.3);
    }

    img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 4px solid #ddd;
        transition: all 0.3s ease;
    }

    .content:hover img {
        border-color: #17A589;
    }

    p {
        text-align: center;
        color: #5D6D7E;
        padding: 8px;
        font-size: 18px;
    }

    @media(max-width: 1000px) {
        .content {
            width: 45%;
        }
    }

    @media(max-width: 750px) {
        .content {
            width: 100%;
        }
    }

    .back-button {
        text-align: center;
        margin-top: 20px;
        padding: 10px;
        font-size: 18px;
        background-color: #17A589;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .back-button:hover {
        background-color: #148F77;
    }
</style>

<body>
    <h1>FRESHMART</h1>
    <div class="main">
        <marquee>Healthy life is not a luxury It's a necessity</marquee>
    </div>

    <nav class="navbar">
        <ul>
            <li><a href="checkout.php">Cart</a></li>
            <li><a href="user_login.php">Logout</a></li>
        </ul>
    </nav>

    <center><label><b><i>Your Healthy Life, Our Passion</i></b></label></center>

    <div class="gallery">
        <!-- Clickable Image for SKIN CARE -->
        <div class="content">
            <a href="juice.php">
                <img src="j.jpg" alt="">
                <h3>JUICE</h3>
            </a>
        </div>

        <!-- Clickable Image for BEAUTY PRODUCT -->
        <div class="content">
            <a href="fruits.php">
                <img src="f.jpg" alt="">
                <h3>FRUITS</h3>
            </a>
        </div>
        <div class="content">
            <a href="dates.php">
                <img src="d.jpg" alt="">
                <h3>DATES</h3>
            </a>
        </div>
    </div>

    <center><a href="user_login.php" class="back-button">Back to Home</a></center>
</body>
</html>

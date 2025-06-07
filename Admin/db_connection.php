<?php
// Database credentials
$host = "localhost"; // e.g., "localhost"
$username = "root";
$password = "";
$database = "df";

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to UTF-8
mysqli_set_charset($connection, "utf8");
?>

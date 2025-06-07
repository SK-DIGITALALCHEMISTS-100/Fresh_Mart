<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteProduct'])) {
    $productId = $_POST['productId'];

    // Implement your delete logic here
    include 'db_connection.php';
    $deleteQuery = "DELETE FROM product WHERE id = $productId";
    mysqli_query($connection, $deleteQuery);
    mysqli_close($connection);

    // Redirect back to the index.php page after deleting
    header("Location: upload.php");
    exit();
} else {
    // Handle other cases or redirect to an error page
    header("Location: error.php");
    exit();
}
?>
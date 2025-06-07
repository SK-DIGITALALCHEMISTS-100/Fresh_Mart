<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProduct'])) {
    $productId = $_POST['productId'];

    // Get values from the form
    $newProductType = $_POST['newProductType'];
    $newProductName = $_POST['newProductName'];
    $newAmount = $_POST['newAmount'];
    $newImg = $_POST['newImg'];

    // Implement your update logic here
    include 'db_connection.php';
    $updateQuery = "UPDATE product SET 
                    product_type = '$newProductType', 
                    product_name = '$newProductName', 
                    amount = '$newAmount', 
                    img = '$newImg' 
                    WHERE id = $productId";
    mysqli_query($connection, $updateQuery);
    mysqli_close($connection);

    // Redirect back to the index.php page after updating
    header("Location: upload.php");
    exit();
} else {
    // Handle other cases or redirect to an error page
    header("Location: error.php");
    exit();
}
?>

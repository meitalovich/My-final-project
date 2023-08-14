<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "Book_Store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $status = $_POST['status'];
    $title = $_POST['title'];
    $price = floatval($_POST['price']);

    // Convert status value to bit
    $status_bit = ($status == '1') ? 1 : 0;

    // Update the product in the database
    $update_sql = "UPDATE products SET status1 = $status_bit, title = '$title', price = $price WHERE productid = '$product_id'";
    $conn->query($update_sql);

    // Redirect back to the admin.php page
    header("Location: admin.php");
    exit();
}

?>

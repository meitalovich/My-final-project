<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "Book_Store");

// Check if the connection to the database was successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the form data
$product_id = intval($_POST['product_id']);
$user_id = intval($_POST['user_id']);
$review_text = $_POST['review_text'];
$rating = intval($_POST['rating']); // Retrieve the rating value

// Validate the review text and rating
if (empty($review_text) || $rating < 1 || $rating > 5) {
    // Display an error message or take any appropriate action
    echo "Please enter a review and select a valid rating before submitting.";
    exit;
}

// Prepare and execute the query
$query = $connect->prepare('INSERT INTO reviews (product_id, user_id, review_text, rating_star) VALUES (?, ?, ?, ?)');
$query->bind_param("iisi", $product_id, $user_id, $review_text, $rating);

if ($query->execute()) {
    // The review was successfully inserted
    echo "Review submitted successfully.";
} else {
    // An error occurred while executing the query
    echo "Error occurred while submitting the review: " . $query->error;
}
?>

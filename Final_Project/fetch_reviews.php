<?php
// fetch_reviews.php

session_start();
$connect = mysqli_connect("localhost", "root", "", "Book_Store");

// Check if the delete button is clicked
if (isset($_POST['delete_review_id'])) {
  $delete_review_id = intval($_POST['delete_review_id']);

  // Delete the review from the database table
  $delete_query = "DELETE FROM reviews WHERE review_id = $delete_review_id AND user_id = {$_SESSION['id']}";
  mysqli_query($connect, $delete_query);
}

// Get the product ID from the AJAX request
$product_id = intval($_GET['product_id']);
$review_query = "SELECT r.review_id, r.review_text, r.rating_star, r.user_id, u.user_name FROM reviews r INNER JOIN users u ON r.user_id = u.id WHERE r.product_id = $product_id";
$review_result = mysqli_query($connect, $review_query);

// Generate HTML for the reviews
$review_content = '';
while ($review_row = mysqli_fetch_array($review_result)) {
  $review_id = $review_row['review_id'];
  $review_text = $review_row['review_text'];
  $rating_star = $review_row['rating_star'];
  $user_id = $review_row['user_id'];
  $username = $review_row['user_name'];

  $review_content .= '<div class="review">';
  $review_content .= '<div class="review-content">';
  $review_content .= '<h5>' . $username . '</h5>';

  // Add the rating stars
  $review_content .= '<div class="review-details">';
  $review_content .= '<p class="review-text">' . $review_text . '</p>';
  $review_content .= '<div class="rating-stars">';
  for ($i = 1; $i <= 5; $i++) {
    if ($i <= $rating_star) {
      $review_content .= '<i class="fas fa-star filled"></i>';
    } else {
      $review_content .= '<i class="far fa-star"></i>';
    }
  }
  $review_content .= '</div>';
  $review_content .= '</div>';

  $review_content .= '</div>';

  // Add delete button if review ID matches the logged-in user's ID
  if ($_SESSION['id'] === $user_id) {
    $review_content .= '<button class="delete-review-btn" data-review-id="' . $review_id . '">Delete</button>';
  }

  $review_content .= '</div>';
  $review_content .= '<hr class="review-separator">';
}

// Return the HTML content of the reviews
echo $review_content;
?>

<style>
  .review-separator {
  border: none;
  border-top: 1px solid #ccc;
  margin: 10px 0;
}

.review {
  display: flex;
  align-items: center;
}

.review-content {
  flex-grow: 1;
}

.review-details {
  display: flex;
  align-items: center;
}

.rating-stars {
  color: #FFD700; /* Set gold color for filled stars */
  margin-top: -65px;
    margin-left: 10px;
}

.filled {
  color: #FFD700; /* Set gold color for filled stars */
}

.delete-review-btn {
  margin-left: 10px;
}

 
</style>

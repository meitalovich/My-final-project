<?php
session_start();
 $connect = mysqli_connect("localhost", "root", "", "Book_Store");
 $tab_query = "SELECT * FROM category ORDER BY cat_id ASC";
 $tab_result = mysqli_query($connect, $tab_query);
 $tab_menu = '';
 $tab_content = '';
 $i = 0;
 while($row = mysqli_fetch_array($tab_result))
 {
  if($i == 0)
  {
   $tab_menu .= '
    <li class="active"><a href="#'.$row["cat_id"].'" data-toggle="tab">'.$row["name"].'</a></li>
   ';
   $tab_content .= '
    <div id="'.$row["cat_id"].'" class="tab-pane fade in active">
     <div class="row">
   ';
  }
  else
  {
   $tab_menu .= '
    <li><a href="#'.$row["cat_id"].'" data-toggle="tab">'.$row["name"].'</a></li>
   ';
   $tab_content .= '
    <div id="'.$row["cat_id"].'" class="tab-pane fade">
     <div class="row" >
   ';
  }
  $product_query = "SELECT p.*, COUNT(r.review_id) AS review_count
  FROM products p
  LEFT JOIN reviews r ON p.productid = r.product_id
  WHERE p.cat_id = '" . $row["cat_id"] . "' AND p.status1 = 1
  GROUP BY p.productid";

$product_result = mysqli_query($connect, $product_query);
  while($sub_row = mysqli_fetch_array($product_result))
  {
    $price_display = ($sub_row["new_old"] == 1 && $sub_row["price_old"] != 0) ? $sub_row["price_old"] : $sub_row["price"];
    $price_old_display =  $sub_row["price_old"];

    $price_dropdown = '';
    
    if ($sub_row["price_old"] != 0 &&$sub_row["price"] != 0) {
        $price_dropdown = '
            <div class="price-container">
                <h4 class="price">'.$price_display.'</h4>
                <select class="price-dropdown" onchange="updatePrice(this)">
                    <option value="'.$sub_row["price"].'">New Book</option>
                    <option value="'.$sub_row["price_old"].'">Used Book</option>
                </select>
            </div>
        ';
    }else if($sub_row["price_old"] != 0&& $sub_row["price"] == 0 ){
      $price_dropdown = '
      <div class="price-container">
          <h4 class="price" id="price_display">'.$price_old_display.'</h4>
      </div>
      <script>
          document.addEventListener("DOMContentLoaded", function() {
              var priceDisplay = document.getElementById("price_display");
              var priceContainer = priceDisplay.parentElement;
              
              // Call the updatePrice function initially with the default value
              updatePrice1(priceDisplay);
          });
      </script>
  ';
  
    }
    
    else {
        $price_dropdown = '<h4 class="price">'.$price_display.'</h4>';
    }
    
    $tab_content .= '
    <form action="" class="form-submit col-md-4" style="background-color:transparent;border:none; ">
        <div class="product-details">
        <img src="'.$sub_row["book_image"].'" class="img-responsive img-thumbnail product-image" />
        <h4>'.$sub_row["title"].' <i class="fas fa-info-circle book-summary-icon" data-toggle="modal" data-target="#bookSummaryModal-'.$sub_row["productid"].'"></i></h2>
        <h4>By '.$sub_row["author"].'</h4>
        <h12>'.$sub_row["year_pub"].'
                <br>
                <span class="fa fa-star checked" data-toggle="modal" data-target="#reviewModal"></span>
                <span class="review-count">(' . $sub_row["review_count"] . ' reviews)</span>
            </h12>
            <div class="price-dropdown-container">
                '.$price_dropdown.'
            </div>
        </div>
        <div class="add-to-cart">
            <input type="hidden" class="pqty" value="1">
            <input type="hidden" class="pid" value="'.$sub_row['productid'].'">
            <input type="hidden" class="pname" value="'.$sub_row['title'].'">
            <input type="hidden" class="pprice" value="'.$sub_row['price'].'">
            <input type="hidden" class="pimage" value="'.$sub_row['book_image'].'">
            <input type="hidden" class="pcode" value="'.$sub_row['product_code'].'">
            <input type="hidden" class="user_id" value="'.$_SESSION['id'].'">
            <button class="btn btn-info addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Buy</button>
            <a style="margin-top: 11px;margin-left: -10px;width: 212px;" href="checkout.php?source=pdf&item='.urlencode($sub_row['title']).'&price='.urlencode($sub_row['price']).'" class="btn btn-primary">Buy Online PDF</a>


        </div>
    </form>
    
    <div id="bookSummaryModal-'.$sub_row["productid"].'" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-right">'.$sub_row["title"].'</h4>
            </div>
            <div class="modal-body">
                <p>'.generateRandomSummary().'</p>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



        <style>
        
        .form-submit {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
      }
  
      .add-to-cart {
          box-sizing: border-box;
          padding: 10px;
      }
  
      .addItemBtn {
          display: block;
          margin-top: 10px;
          padding: 4px 78px;
                  font-size: 16px; 
                  margin-left: -11px;
      }
            
            .price-dropdown-container {
                display: flex;
                align-items: center;
            }
            
            .price-container {
                margin-right: 10px;
            }
            
            .price,
            .price-dropdown {
                display: inline-block;
                vertical-align: middle;
            }
            .fa-star.checked {
              color: gold;
          }
          .product-image {
            width: 100%; /* Set a specific width */
            height: 500px; /* Maintain aspect ratio */
          }
        
      
        </style>
        <script>
            function updatePrice(select) {
                var priceContainer = select.closest(".price-container");
                var selectedPrice = select.value;
                priceContainer.querySelector(".price").textContent = selectedPrice;
    
                var ppriceInput = select.closest("form").querySelector(".pprice");
                ppriceInput.value = selectedPrice;
            }
            function updatePrice1(priceElement) {
              var priceContainer = priceElement.closest(".price-container");
              var selectedPrice = priceElement.textContent;
              
              var ppriceInput = priceContainer.closest("form").querySelector(".pprice");
              ppriceInput.value = selectedPrice;
          }
          
        </script>
    ';
    

  }
  $tab_content .= '<div style="clear:both"></div></div></div>';
  $i++;
 }


function generateRandomSummary() {
   
 $englishPhrases = array(
  "This is the summary of the book that talks about the creative and complex process of the human world.",
  "In this book, we will experience the fascinating journey of the main character and discover powerful and intriguing stories.",
  "The book presents us with a new and fascinating way of life and invites us to a wonderful experience in the world of literature.",
  "With the captivating chapters in this book, we open up a whole new world of new and fascinating thoughts and ideas.",
  "The captivating stories in the book will inspire and excite you, influencing you to change and encourage.",
  "The book summary will introduce you to a new world of captivating characters and chapters.",
  "Read the book and be excited by the fascinating and stimulating stories in your consciousness.",
  "The book will challenge you to think again and discover new and fascinating ideas.",
  "This book offers a unique and fascinating experience that deepens your understanding of the subject.",
  "The book summary will help you understand the fascinating ideas found within the stories."
);
  $summary = '';
  $lines = rand(5, 10); // Number of lines for the summary (random between 5 and 10)

  for ($i = 0; $i < $lines; $i++) {
    $randomIndex = array_rand($englishPhrases);
    $summary .= $englishPhrases[$randomIndex] . " ";
}

return $summary;
}


?>
<!DOCTYPE html>
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
   
  
    #ratingStars i {
  color: gray; /* Set the default star icon color */
  cursor: pointer;
}

#ratingStars i.filled-star {
  color: gold; /* Set the star icon color to gold */
}


</style>
  <link rel="stylesheet" href="sstyle.css">
 </head>
 <body>

 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
 <a class="navbar-brand" href="home_page.php"><i class="fas fa-home"></i>&nbsp;&nbsp;Back to Home</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-left: 55%;">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link " href="buy.php"></i>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i> Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger" style="background-color: #dc3545;"></span>My Cart</a>
        </li>
        <li class="nav-item">
           <?php  if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : echo '<a class="nav-link" >Hello,' , $_SESSION['name'],'</a>' ?>
           <li class="nav-item">
           <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </li>
         <?php else : ?> 
         <a class="nav-link"  href="login.php"></i>Login</a> <?php endif; ?></a>
        </li>
      </ul>
    </div>
  </nav>

</li>
</ul>
</div>
</nav>
<div class="container1 my-3" >
<div class="row offset-md-1  justify-content-center ">
<div class="col-md-2 col-sm-12 mt-3" order="2"  >
<marquee class="marquee" behavior="scroll" direction="down"></marquee>
</div></div></div>

<div class="container">
<ul class="nav nav-tabs">
<?php echo $tab_menu; ?>
</ul>
<div class="tab-content">
<?php echo $tab_content; ?>
</div>
</div>

<script>
$(document).ready

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

  // Send product details to the server
  $(".addItemBtn").click(function(e) {
    e.preventDefault();
    var $form = $(this).closest(".form-submit");
    var pid = $form.find(".pid").val();
    var pname = $form.find(".pname").val();
    var pprice = $form.find(".pprice").val();
    var pimage = $form.find(".pimage").val();
    var pcode = $form.find(".pcode").val();
    var user_id = $form.find(".user_id").val(); 
    var pqty = $form.find(".pqty").val();

    $.ajax({
      url: 'action.php',
      method: 'post',
      data: {
        pid: pid,
        pname: pname,
        pprice: pprice,
        pqty: pqty,
        pimage: pimage,
        pcode: pcode,
        user_id: user_id 
      },
      success: function(response) {
        $("#message").html(response);
        window.scrollTo(0, 0);
        load_cart_item_number();
      }
    });
  });

  $('.fa-star.checked').click(function() {
    var productID = $(this).closest('.form-submit').find('.pid').val();
    
    // Open the review modal and pass the product ID
    $('#reviewModal').modal('show');
    $('#reviewModal').data('product-id', productID);

    // Fetch and display the reviews for the selected product
    $.ajax({
      url: 'fetch_reviews.php',
      method: 'GET',
      data: {
        product_id: productID
      },
      success: function(response) {
        $('#reviewContent').html(response);
      },
      error: function() {
        alert('Error occurred while fetching reviews.');
      }
    });
  });

  $(document).on('click', '.delete-review-btn', function() {
    var reviewId = $(this).data('review-id');
    var productID = $('#reviewModal').data('product-id'); 

    // Send an AJAX request to delete the review
    $.ajax({
      url: 'fetch_reviews.php',
      type: 'POST',
      data: { delete_review_id: reviewId },
      success: function(response) {
        // Reload the reviewContent with the updated reviews
        $.get('fetch_reviews.php', { product_id: productID }, function(response) {
          $('#reviewContent').html(response);
        });
      },
      error: function() {
        alert('Error occurred while deleting the review.');
      }
    });
  });

  $('#ratingStars i').click(function() {
    var rating = $(this).data('rating');
    $('#ratingStars i').removeClass('filled-star'); // Remove filled-star class from all stars
    $(this).prevAll().addBack().addClass('filled-star'); // Add filled-star class to selected star and previous stars
    $('#selectedRating').val(rating);
  });

  $('#reviewForm').submit(function(e) {
    e.preventDefault();

    var reviewText = $('#reviewText').val(); // Get the review text
    
    if (reviewText.trim() === '') {
      // Display an error message or take any appropriate action
      alert("Please enter a review before submitting.");
      return;
    }
  
    var rating = $('#selectedRating').val(); // Get the selected rating
    var productID = $('#reviewModal').data('product-id'); // Get the product ID
    var userID = $('.user_id').val(); // Get the user ID

    // Check if a rating star is chosen
    var chosenRatingStar = $('#ratingStars .fas').length;
    if (chosenRatingStar === 0 && rating === '') {
      // Display an error message or take any appropriate action
      alert("Please choose a rating before submitting.");
      return;
    }

    // Send the review data to submit_review.php using AJAX
    $.ajax({
      url: 'submit_review.php',
      method: 'POST',
      data: {
        review_text: reviewText,
        rating: rating,
        product_id: productID,
        user_id: userID
      },
      success: function(response) {
        // Handle the success response
        console.log(response);

        // Clear the textarea
        $('#reviewText').val('');

        // Fetch reviews using GET method
        $.get('fetch_reviews.php', { product_id: productID }, function(response) {
          // Handle the success response
          console.log(response);
          $('#reviewContent').html(response);
        })
        .done(function() {
          // Code to be executed if the request succeeds
        })
        .fail(function() {
          // Code to be executed if the request fails
          alert('Error occurred while fetching reviews.');
        });
      },
      error: function() {
        // Handle the error case
        alert('Error occurred while submitting the review.');
      }
    });
  });

  // Load total number of items added in the cart and display in the navbar
  load_cart_item_number();

  function load_cart_item_number() {
    $.ajax({
      url: 'action.php',
      method: 'get',
      data: {
        cartItem: "cart_item"
      },
      success: function(response) {
        $("#cart-item").html(response);
      }
    });
  }
});
</script>

<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Product Reviews</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="reviewContent">
          <!-- Review content goes here -->
        </div>
        <hr>

        <form id="reviewForm" action="submit_review.php" method="POST">
          <div class="form-group">
            <label for="reviewText">Your Review:</label>
            <textarea class="form-control" id="reviewText" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="rating">Rating:</label>
            <div id="ratingStars">
              <i class="far fa-star" data-rating="1"></i>
              <i class="far fa-star" data-rating="2"></i>
              <i class="far fa-star" data-rating="3"></i>
              <i class="far fa-star" data-rating="4"></i>
              <i class="far fa-star" data-rating="5"></i>
            </div>
          </div>
          <input type="hidden" id="selectedRating" name="rating">
          <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#reviewModal').on('hide.bs.modal', function(e) {
    location.reload();
  });
});
</script>

<br>
<footer><a>CopyRight &#169; Meital & Rim 2023</a></footer>

</body>
</html>

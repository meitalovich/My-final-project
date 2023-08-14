<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Book Sale</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' /> 
  <link rel="stylesheet" href="style.css">
  <style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%; /* Adjust the width as desired */
    height: 150px; /* Adjust the height as desired */
  }

  /* The Close Button */
  .close {
    color: #dc3545;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  </style>
</head>

<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="home_page.php"><i class="fas fa-home"></i>&nbsp;&nbsp;Back to Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link " href="buy.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span>My Cart</a>
      </li>
      <li class="nav-item">
        <?php  if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : 
          echo '<a class="nav-link">Hello, ' . $_SESSION['name'] . '</a>';
          ?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
      </li>
      <?php else : ?> 
      <a class="nav-link"  href="login.php">Login</a> <?php endif; ?>
      </li>
    </ul>
  </div>
</nav>
<div class="container1 my-3">
  <div class="row offset-md-1 justify-content-center">
    <div class="col-md-2 col-sm-12 mt-3" order="2">
      <marquee class="marquee" behavior="scroll" direction="down"></marquee>
    </div>
  </div>
</div>

<div class="container1 my-3">
  <div class="row offset-md-1 justify-content-center">
    <div class="col-md-2 col-sm-12 mt-3" order="1">
      <marquee class="marquee" behavior="scroll" direction="down">
      </marquee>
    </div>
  </div>
</div>
<div class="row justify-content-center">
  <form method="post" action="" id="placeOrder" onsubmit="" enctype="multipart/form-data">
    <fieldset >
      <legend  style="text-align: center;" required>Book Sale:</legend>

      <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Enter First and Last Name" required pattern="[a-zA-Z\s]+" title="Please enter letters only">
      </div>

      <div class="form-group">
        <input type="text" name="title" class="form-control" placeholder="Book Title" required>
      </div>

      <div class="form-group">
        <input type="text" name="author" class="form-control" placeholder="Author's Name" required pattern="[a-zA-Z\s]+" title="Please enter letters only">
      </div>
      <div class="col">
        <label for="category">Category: </label>
        <select id="category" name="category">
          <option value="1">Children's Books</option>
          <option value="2">Science Fiction</option>
          <option value="3">Adventure</option>
          <option value="4">Classic Literature</option>
          <option value="5">Fantasy</option>
          <option value="6">Romance</option>
          <option value="7">History</option>
          <option value="8">Horror</option>
        </select>
      </div>
      <div class="form-group">
        <input type="number" name="year_pub" class="form-control" placeholder="Year of Publication" required pattern="[0-9]{4}" title="Please enter numbers only">
      </div>

      <div class="form-group">
        <input type="price" name="price" class="form-control" placeholder="Price" required pattern="[0-9]+([.][0-9]+)?" title="Please enter numbers only">
      </div>

      <div class="form-group">
        <input type="tel" name="phone" pattern="[0-9]{1}[0-9]{9}" class="form-control" placeholder="Enter Phone Number" required>
      </div>

      <a required action="/action_page.php">
        <label for="img">Upload Book Images:</label><br>
        <label for="img" class="custom-file-upload">
  <i class="fas fa-cloud-upload-alt"></i> Upload File
</label>
<input type="file" name="img" id="img" accept="image/*" style="display:none;">

      </a>
      
      <div class="form-group"><br>
        <textarea name="comment" class="form-control" rows="3" cols="10" placeholder="Comments"></textarea>
      </div>
      <div class="form-group">
        <br><br>
        <button class="login_button" id="sub" type="submit">Submit</button>
        <div id="message" style="display: none;"></div>
      </div>
    </fieldset>
    <br>
  </form>
 
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p style="text-align: center;">Thank you for choosing to sell us the book</p>
      <p style="text-align: center;">We will review and get back to you soon</p>
    </div>
  </div>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {
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
  <script>
    $(document).ready(function() {
      $('#placeOrder').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        var $form = $(this).closest("form");
        var title = $form.find('input[name="title"]').val();
        var author = $form.find('input[name="author"]').val();
        var category = $('#category').val();
        var year_pub = $form.find('input[name="year_pub"]').val();
        var price = $form.find('input[name="price"]').val();
        var formData = new FormData($form[0]);
        formData.append('img', $form.find('input[name="img"]')[0].files[0]);

        // Check if all fields are not empty
        if (title !== '' && author !== '' && year_pub !== '' && price !== '') {
          $.ajax({
            url: 'process_form.php',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              $("#myModal").css("display", "block");
            }
          });

          $.ajax({
            url: 'process_form.php',
            method: 'post',
            data: {
              title: title,
              author: author,
              category: category,
              year_pub: year_pub,
              price: price
            },
            success: function(response) {
              $("#myModal").css("display", "block");
            }
          });
        }

        // If all validations pass, display the success message
        displaySuccessMessage();
      });
    });

    function displaySuccessMessage() {
      var modal = document.getElementById("myModal");
      var span = document.getElementsByClassName("close")[0];

      // Add event listener to close button
      span.onclick = function() {
        modal.style.display = "none";
      };

      window.onclick = function(event) {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      };
    }
  </script>
  
</body>

</html>

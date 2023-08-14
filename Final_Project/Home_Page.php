<?php
  session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=0.56, minimum-scale=0.60 ">
  <title>Home Page</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' /> 
  <link rel="stylesheet" href="sstyle.css">


</head>
<body>

<body >
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : ?>
          <?php if ($_SESSION['id'] == 11 || $_SESSION['id'] == 7) : ?>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Admin</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="buy.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span>My Cart</a>
        </li>
        <?php if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : ?>
          <li class="nav-item">
            <a class="nav-link">Hello, <?php echo $_SESSION['user_name']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i>Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
</nav>


<br><br>
  
  <p style="text-align: center;   font-family:'Vivaldi', cursive; font-size: 100px; color: blue;">Tell Me a Story</p>
  <!-- <p style="text-align: center;   font-family:'Freestyle Script', cursive; font-size: 80px; color: blue;">Tell Me a Story</p> -->
  <p style="text-align: center; font-family:'Lucida Calligraphy', cursive; font-size: 20px; color: blue;">Online Store for New and Used Books</p>



  <div class="btn-container">
    <a href="buy.php">
      <button class="btn_buy" style="font-family:Lucida Calligraphy, cursive; vertical-align: middle;"><span>Buy a Book</span></button>
    </a>

    <a href="sell.php">
      <button class="btn_sell" style="font-family:Lucida Calligraphy, cursive;vertical-align:middle"><span>Sell a <br> Book</span></button>
    </a>
  </div>

  <div class="btn-container">
  <div class="btn-down">
  <a href="Contact.php" class="button">Contact Us</a>
  <a href="aboutus.php" class="button">About</a>
  <a href="quest&ans.php" class="button">Questions & Answers</a>
</div></div>


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
<footer>
<a>CopyRight &#169; Meital & Rim 2023</a></footer>
</footer>

 </body>
   
</html>

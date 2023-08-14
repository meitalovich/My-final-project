<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=0.56, minimum-scale=0.60 ">
  <title>About Us</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="sstyle.css">

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
          <a class="nav-link " href="buy.php"></i>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span>My Cart </a>
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

<br>
  <h3 style="text-align:center;" >About Us</h3 ><br><br>
  <p style="text-align:center;">
  <br>We are Meital Mandelovich and Rim Ibrahim, the creators of this final project.
  <br>We have built a system for buying and selling new and used books.
  <br>Following the COVID-19 pandemic, we discovered the advantages of online shopping, without the need for physical contact and with time-saving.
  <br>If you know of a book you would like to purchase or want to see what books we have to offer,
  <br>We invite you to visit our website to browse and explore our selection.
  <br>We have a variety of books available, such as textbooks, thrillers, comedy, drama, and children's books.
  <br>We wish you a pleasant and quick shopping experience, enjoyable reading, and may you never stop reading books.
  </p>
<br><br><br><br><br><br><br><br><br><br><br><br><br>


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
  <footer> 
  <a>CopyRight &#169; Meital & Rim 2023</a></footer>
 </body>
   
</html>

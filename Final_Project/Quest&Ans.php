<?php
  session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.56, minimum-scale=0.60">
  <title>FAQ</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="sstyle.css">

</head>
<body>
<div class="qa-container content-right">

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
<a class="navbar-brand" href="home_page.php"><i class="fas fa-home"></i>&nbsp;&nbsp;Back to Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-left: 50%;">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link " href="buy.php"></i>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span>My Cart</a>
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
  <div class="container1 my-3" >
    <div class="row offset-md-1  justify-content-center ">
      <div class="col-md-2 col-sm-12 mt-3" order="2"  >
            <marquee class="marquee" behavior="scroll" direction="down"  >
                </marquee>
           
              </div></div></div>
    <main >
    <p style="text-align: center; font-weight: bold; font-size: 80px; color: blue;">FAQ</p>
        <section class="faq-container">
            <div class="faq-one">         
                <h1 class="faq-page">Why should I register as a customer on the website?</h1>
                <div class="faq-body">
                    <p>Registered customers enjoy benefits such as discounts, recommendations, book sales, and more.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
<h1 class="faq-page">How can I know which book to choose?</h1>

                <!-- faq answer -->
                <div class="faq-body">
                    <p>Each book has recommendations from previous readers. Additionally, if you are a previous customer, you can see recommendations for new books.</p>
                </div>
            </div>


            <hr class="hr-line">
            <div class="faq-two">
                <!-- faq question -->
                <h1 class="faq-page">Can I place an order without registering on the website?</h1>

                <!-- faq answer -->

                <div class="faq-body">
                    <p>Of course! Anyone can enjoy purchasing a book.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
<h1 class="faq-page">How long will it take for the books to arrive?</h1>

                <!-- faq answer -->
                <div class="faq-body">
                    <p>Within 5 business days.</p>
                </div>
            </div>

            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
<h1 class="faq-page">Can I return the books?</h1>

                <!-- faq answer -->
                <div class="faq-body">
                    <p>Once the book is received, exchanges or returns are not possible. However, you can sell the book on the website if it meets the requirements.</p>
                </div>
            </div>


          
        </section>
    </main>

     
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

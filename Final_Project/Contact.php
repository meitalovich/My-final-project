<?php
session_start();
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
  
  <style>
body {
  font-family: Arial, Helvetica, sans-serif;}

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
  <link rel="stylesheet" href="style.css">
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
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger" style="background-color: #dc3545;"></span>My Cart</a>
        </li>
        <li class="nav-item">
          <?php if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : echo '<a class="nav-link" >Hello,' , $_SESSION['name'], '</a>' ?>
            <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </li>
          <?php else : ?>
            <a class="nav-link" href="login.php"></i>Login</a> <?php endif; ?></a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container1 my-3">
    <div class="row offset-md-1  justify-content-center ">
      <div class="col-md-2 col-sm-12 mt-3" order="2">
        <marquee class="marquee" behavior="scroll" direction="down"></marquee>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
      <h2 class="text-center text-info p-2">Contact Us</h2>
      <form action="" method="post" id="placeOrder" onsubmit="">
        <fieldset>
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Please enter first name and last name" required pattern="[a-zA-Z\s]+" title="Please enter letters only">
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Please enter email" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" pattern="[0-9]{1}[0-9]{9}" class="form-control" placeholder="Please enter phone number" required>
          </div>
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Content" required></textarea>
          </div>
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
        </fieldset>
        <br><br><br>

        <!-- Trigger/Open The Modal -->
        <button class="login_button" id="myBtn">Submit</button>

        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <p style="text-align: center;">Thank you for contacting us</p>
            <p style="text-align: center;">We will get back to you soon</p>
          </div>

</div>

          <br><br>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>


<script type="text/javascript">
  $(document).ready(function() {
  // Load total no.of items added in the cart and display in the navbar
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

      // Check if all required fields have values
      var name = $('#name').val();
      var email = $('#email').val();
      var phone = $('#phone').val();
      var address = $('#address').val();

      if (name === '' || email === '' || phone === '' || address === '') {
        alert('Please fill in all required fields');
        return;
      }

      // If all validations pass, display the success message
      displaySuccessMessage();
    });
  });

  function displaySuccessMessage() {
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
      modal.style.display = "block";
    };

    span.onclick = function() {
      modal.style.display = "none";
    };

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
    modal.style.display = "block";
  }
</script>



  <footer>
    <a>CopyRight &#169; Meital & Rim 2023</a>
  </footer>
</body>

</html>

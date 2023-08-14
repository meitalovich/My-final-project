<?php
session_start();
require 'db_conn.php';
$grand_total = 0;
$allItems = '';
$items = [];
if (isset($_GET['source']) && $_GET['source'] === 'pdf') {
  // Purchase made from "Buy Online PDF" button
  if (isset($_GET['item'])) {
    $item = $_GET['item']; // Retrieve the item name from the query parameters
   
  } else {
    $item = 'PDF Book'; // Set a default item name if it is not provided
  }

  if (isset($_GET['price'])) {
    $price = $_GET['price']; // Retrieve the price from the query parameters
  } else {
    $price = 9.99; // Set a default price if it is not provided
  }

  $items[] = $item;
  $grand_total += $price;
}
else {
  // Purchase made from the cart
  $sql = "SELECT CONCAT(product_name) AS ItemQty, total_price FROM cart WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_SESSION['id']);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
  }
}

$allItems = implode(', ', $items);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="style.css">
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
          <a class="nav-link" href="buy.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i> Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span>My Cart</a>
        </li>
        <li class="nav-item">
          <?php if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : echo '<a class="nav-link">Hello, ', $_SESSION['name'], '</a>' ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
          </li>
          <?php else : ?>
            <a class="nav-link" href="login.php">Login</a>
          <?php endif; ?></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete Your Order</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Items: </b><?= $allItems; ?></h6>
          <?php if (!isset($_GET['source'])) { ?>
  <h6 class="lead"><b>Delivery: </b>Free</h6>
<?php } ?>
          <h5><b>Total Amount: </b><?= number_format($grand_total, 2); ?>/-</h5>
        </div>

        <form action="" method="post" id="placeOrder" onsubmit="return validateForm()">
          <fieldset >
            <legend  style="text-align: left;" required>Personal Information:</legend>

            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Enter First and Last Name" required pattern="[a-zA-Zא-ת\s]+" title="Only letters are allowed">
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
              <input type="tel" name="phone" pattern="[0-9]{1}[0-9]{9}" class="form-control" placeholder="Enter Phone Number" required>
            </div>
            <div class="form-group">
              <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address" required></textarea>
            </div>
            <div class="form-group">

            </div>

            <input type="hidden" name="products" value="<?= $allItems; ?>">
            <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">

          </fieldset>
          <fieldset >
            <legend style="text-align: left;" required>Credit Card Details:</legend>
            <div class="form-group">
              <input type="text" name="card_owner" class="form-control" placeholder="Enter Cardholder's Name" required pattern="[a-zA-Zא-ת\s]+" title="Only letters are allowed">
            </div>
            <div class="form-group">
              <input type="text" name="id_number" class="form-control" placeholder="Cardholder's ID Number" required pattern="[0-9]{9}" title="Only digits are allowed">
            </div>
            <div class="form-group">
              <input type="text" name="card_number" class="form-control" placeholder="Credit Card Number" required pattern="[0-9]{9}" title="Only digits are allowed">
            </div>
            <div class="form-row">
              <div class="col">
                <label for="expiration_month">Expiration Month:</label>
                <select id="expiration_month" name="expiration_month" required>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>
              <div class="col">
                <label for="expiration_year">Expiration Year:</label>
                <select id="expiration_year" name="expiration_year">
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                </select>
              </div>
              <input type="text" name="card_number" placeholder="CVV" style="font-size: 13px; width: 50px;" required pattern="[0-9]{3}" title="Only 3 digits are allowed">
            </div>
            <img src="card1.png" alt="Image" width="200">
          </fieldset>
          <div class="form-group">
            <input type="submit" name="submit" id="submitBtn" value="Pay" class="btn btn-danger btn-block">
          </div>
        </form>

      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      // Load total number of items added in the cart and display it in the navbar
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

      var selectedYear = parseInt($('#expiration_year').val());
      var selectedMonth = parseInt($('#expiration_month').val());

      // Get the current date
      var currentDate = new Date();
      var currentYear = currentDate.getFullYear();
      var currentMonth = currentDate.getMonth() + 1; // Months are zero-based

      // Compare the expiration date with the current date
      if (selectedYear < currentYear || (selectedYear === currentYear && selectedMonth < currentMonth)) {
        alert('Invalid expiration date');
        return;
      }

      // Check if all required fields have values
      var cardNumber = $('#card_number').val();
      var cvv = $('#cvv').val();
      var name = $('#name').val();
      var address = $('#address').val();

      if (cardNumber === '' || cvv === '' || name === '' || address === '') {
        alert('Please fill in all required fields');
        return;
      }

      // Prevent multiple form submissions
      $('#placeOrder input[type="submit"]').attr('disabled', 'disabled');

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
          displaySuccessMessage();
        },
        error: function() {
          alert('An error occurred. Please try again later.');
        }
      });
    });
  });

  function displaySuccessMessage() {
   

    var width = 400;
    var height = 200;
    var left = (window.innerWidth - width) / 2;
    var top = (window.innerHeight - height) / 2;

    var successWindow = window.open('', '_blank', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

    successWindow.document.write('<style>body { background-color: #ffdeb0; text-align: center; font-family: Arial, sans-serif; }</style>');
    successWindow.document.write('<h1 style="margin-top: 50px;">Payment Successful!</h1>');
    successWindow.document.write('<p>Thank you for your purchase.</p>');
    successWindow.document.write('<p>You will return to the home page in a few seconds.</p>');
    successWindow.document.write('<button onclick="window.close();" style="margin-top: 20px; padding: 10px 20px; font-size: 16px;">Close</button>');

    // Redirect to the homepage after a delay
    setTimeout(function() {
      window.location.href = "home_page.php";
    }, 4000);
    displaypdf();
  }
</script>
<script>
    function displaypdf() {
   if (window.location.search.includes('source=pdf')) {
      var item = "<?= $item ?>";
      var trimmedItem = item.trim().toLowerCase();
      var fileName;

      switch (trimmedItem) {
        case 'the adventures of tom sawyer':
          fileName = 'The Adventures of Tom Sawyer.pdf';
          break;
        case 'heidi':
          fileName = 'Heidi.pdf';
          break;
        case 'black beauty':
          fileName = 'Black Beauty.pdf';
          break;
        case 'in the days of the comet':
          fileName = 'IN THE DAYS OF THE COMET.pdf';
          break;
        case 'the invisible man':
          fileName = 'THE INVISIBLE MAN.pdf';
          break;
        case 'the life of the bee':
          fileName = 'The Life of the Bee.pdf';
          break;
        case 'the count of monte cristo':
          fileName = 'THE COUNT OF MONTE CRISTO.pdf';
          break;
        case 'treasure island':
          fileName = 'Treasure Island.pdf';
          break;
        case 'tarzan of the apes':
          fileName = 'Tarzan of the Apes.pdf';
          break;
        case 'the secret garden':
          fileName = 'THE SECRET GARDEN.pdf';
          break;
        case 'the buried temple':
          fileName = 'The Buried Temple.pdf';
          break;
        case 'the inner beauty':
          fileName = 'The Inner Beauty.pdf';
          break;
        case 'the innocence of father brown':
          fileName = 'THE INNOCENCE OF FATHER BROWN.pdf';
          break;
        case 'the story of doctor dolittle':
          fileName = 'The Story of Doctor Dolittle.pdf';
          break;
        case 'anna karenina':
          fileName = 'Anna Karenina.pdf';
          break;
        case 'emma':
          fileName = 'Emma.pdf';
          break;
        case 'jane eyre':
          fileName = 'Jane Eyre.pdf';
          break;
        case 'a soldier\'s sketches under fire':
          fileName = 'A Soldier Sketches Under Fire.pdf';
          break;
        case 'admiral jellicoe':
          fileName = 'Admiral Jellicoe.pdf';
          break;
        case 'a short history of the world':
          fileName = 'A Short History of the World.pdf';
          break;
        case 'bullets & billets':
          fileName = 'Bullets & Billets.pdf';
          break;
        case 'dracula':
          fileName = 'Dracula.pdf';
          break;
        default:
          // Handle unknown items
          alert('Unknown item: ' + item);
          return;
      }

      var filePath = '/Final_Project/';
      var pdfUrl = filePath + fileName;

      // Open the PDF in a new window
      var successWindow = window.open(pdfUrl, '_blank');
      if (successWindow) {
        successWindow.focus();
      } else {
        // Handle the case where the window couldn't be opened
        alert('The PDF could not be opened.');
      }
    }
  }
    </script>
</body>

</html>

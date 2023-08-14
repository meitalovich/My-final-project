<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "Book_Store");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete_product_id'])) {
    $product_id = $_GET['delete_product_id'];
    $delete_sql = "DELETE FROM products WHERE productid = '$product_id'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>אדמין</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
      body{
        background-color:#b7d4e4;
      }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color:#accde0;
        }
        .edit-form {
            display: inline-block;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-delete {
    display: inline-block;
    padding: 0;
    border: none;
    background: none;
    color: red;
    cursor: pointer;
}

.btn-delete i {
    font-size: 18px;
}

    </style>
    <script>
        // JavaScript function to toggle the visibility of the modal
        function toggleModal(product_id, product_status, product_title, product_price) {
            var modal = document.getElementById('myModal');
            var form = document.getElementById('editForm');

            if (modal.style.display === "block") {
                modal.style.display = "none";
                form.reset();
            } else {
                modal.style.display = "block";
                document.getElementById('product_id').value = product_id;
                document.getElementById('status').value = product_status;
                document.getElementById('title').value = product_title;
                document.getElementById('price').value = product_price;
            }
        }
  
    </script>
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
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : ?>
          <?php if ($_SESSION['id'] == 11 || $_SESSION['id'] == 7) : ?>
            <li class="nav-item">
            <a class="navbar-brand" href="home_page.php">
    <i class="fas fa-home"></i>Home</a>  </li>

          
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

    <!-- <h1 style="direction: rtl;">אדמין</h1> -->

    <?php
    // PHP code to fetch and display the products
    if ($result->num_rows > 0) {
        echo "<table >
        <tr >
        <th>Book Name</th>
        <th>Book Status</th>
        <th>Price</th>
        <th>Book Image</th>
        <th></th>
        <th></th>
    </tr>";
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['productid'];
            $product_name = $row['title'];
            $product_status = $row['status1'];
            $product_price = $row['price'];
            $product_image = $row['book_image'];

            echo "<tr>
                   
                    <td>$product_name</td>
                    <td>$product_status</td>
                    <td>$product_price</td>
                    <td><img src='$product_image' alt='Product Image' width='100'></td>
                    <td>
                    <a href='admin.php?delete_product_id=$product_id' class='btn-delete'>
                        <i class='fas fa-trash'></i>
                    </a>
                </td>
                
                <td>
                <button onclick='toggleModal(\"$product_id\", \"$product_status\", \"$product_name\", \"$product_price\")'>
                    <i class='fas fa-edit'></i>
                </button>
            </td>                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No products found.";
    }

    $conn->close();
    ?>

    <!-- Modal HTML -->
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="toggleModal()">&times;</span>
        <h2 style="text-align: center;">Product Update</h2>
        <form id="editForm" action="update_product.php" method="POST" >
    <input type="hidden" name="product_id" id="product_id">
    <label for="status">Status:</label>
    <input type="number" name="status" id="status" min="0" max="1" style="width: 200px;"><br><br>
    <label for="title">Book Name:</label>
    <input type="text" name="title" id="title" style="width: 200px;"><br><br>
    <label for="price">Price:</label>
    <input type="price" name="price" id="price" style="width: 200px;"><br><br>
    <div >
        <input type="submit" value="Update">
    </div>
</form>

    </div>
</div>

</body>
</html>
<?php
	session_start();
	require 'db_conn.php';

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $user_id = intval($_POST['user_id']);
	  $total_price = $pprice * $pqty;
		
	  $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=? AND user_id=?');
	  $stmt->bind_param('ss', $pcode, $user_id);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';
	 
	  if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart (product_name, product_price, product_image, qty, total_price, product_code, user_id) VALUES (?,?,?,?,?,?,?)');
	    $query->bind_param('sssssss', $pname, $pprice, $pimage, $pqty, $total_price, $pcode, $user_id);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get the number of items available in the cart table
	if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
		require 'db_conn.php';
		$user_id = $_SESSION['id'];
	  
		$stmt = $conn->prepare('SELECT COUNT(*) AS total_items FROM cart WHERE user_id = ?');
		$stmt->bind_param('i', $user_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
	  
		echo $row['total_items'];
	}

	// Remove single items from the cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i', $id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:orders.php');
	}

	// Remove all items at once from the cart
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All items have been removed from the cart!';
	  header('location:orders.php');
	}

	// Set the total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi', $qty, $tprice, $pid);
	  $stmt->execute();
	}

	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	
	  $name = $_POST['name'];
	 
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];

		
	  $data = '';

	  $stmt = $conn->prepare('INSERT INTO orders (name1, email, phone, address1, products, amount_paid) VALUES (?,?,?,?,?,?)');  
	  
	  $stmt->bind_param('ssssss', $name, $email, $phone, $address, $products, $grand_total);
	
	  $stmt->execute();
	
	  $stmt2 = $conn->prepare('DELETE FROM cart');
	  $stmt2->execute();
	  
	}
?>

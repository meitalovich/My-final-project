<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=0.56, minimum-scale=0.60 ">
  <title>Connect</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
</nav>

<div class="container1 my-3">
  <div class="row offset-md-1 justify-content-center">
    <div class="col-md-2 col-sm-12 mt-3" order="1">
      <marquee class="marquee" behavior="scroll" direction="down">
      </marquee>
    </div>
  </div>
</div>

<form style="margin: auto; width: 500px" action="signup-check.php" method="post">
  <h2 style="text-align: center;">Sign Up Now</h2>

  <?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
  <?php } ?>

  <?php if (isset($_GET['success'])) { ?>
    <p class="success"><?php echo $_GET['success']; ?></p>
  <?php } ?>

  <p class="user">Please enter your First and Last Name:</p>
  <?php if (isset($_GET['name'])) { ?>
    <input type="text" 
           name="name" 
           placeholder="First and Last Name"
           value="<?php echo $_GET['name']; ?>"><br>
  <?php }else{ ?>
    <input type="text" 
           name="name" 
           placeholder="First and Last Name"><br>
  <?php }?>

  <p class="user">Please enter your Username:</p>
  <?php if (isset($_GET['uname'])) { ?>
    <input type="text" 
           name="uname" 
           placeholder="Username"
           value="<?php echo $_GET['uname']; ?>"><br>
  <?php }else{ ?>
    <input type="text" 
           name="uname" 
           placeholder="Username"><br>
  <?php }?>

  <p class="user">Please enter your email:</p>
  <?php if (isset($_GET['mail'])) { ?>
    <input type="email" 
           name="email" 
           placeholder="Enter your email" 
           required 
           value="<?php echo $_GET['mail']; ?>"><br>
  <?php }else{ ?>
    <input type="email" 
           name="email" 
           placeholder="Enter your email" 
           required ><br>
  <?php }?>

  <p class="user">Please enter your password:</p>
  <input type="password" 
         name="password" 
         placeholder="Enter your password"><br>

  <p class="user">Please enter your password again:</p>
  <input type="password" 
         name="re_password" 
         placeholder="Enter your password again"><br>

  <button style="text-align: center;" type="submit">Sign Up</button><br>
  <a href="connect.php" class="ca">Already have an account?</a>
</form>

<br>
<footer><a>CopyRight &#169; Meital & Rim 2023</a></footer>

</body>
</html>

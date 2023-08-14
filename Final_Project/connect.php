<?php 
session_start();

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=0.56, minimum-scale=0.60 ">
  <title>connect</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' /> 
  <!-- <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="sstyle.css"> -->
  <link rel="stylesheet" href="style.css">


</head>
<body dir="ltr">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
</nav>

  <div class="container1 my-3" >
    <div class="row offset-md-1  justify-content-center ">
      <div class="col-md-2 col-sm-12 mt-3" order="1"  >
            <marquee class="marquee" behavior="scroll" direction="down"  >
                </marquee>
              </div></div></div>

<!--  -->
   <form style="margin: auto; width: 500px" class="login" action="login.php" method="post">
     	<h2  style="text-align: center;">Login</h2>
    
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
    <p style="text-align: left;" class="user">Username:</p>
   	<input type="text" name="uname" placeholder="Username"><br>
       
    <p style="text-align: left;" class="user">Password:</p>
   	<input type="password" name="password" placeholder="Password"><br>

  	<button style="text-align: center;" color:white; class="login_button" type="submit">Login</button>
    <a href="signup.php" class="ca">Create a new account</a>
     </form>
<br><br><br><br><br><br><br><br><br>
    
    <footer> <a>CopyRight &#169; Meital & Rim 2023</a></footer>

 </body>
   
</html>

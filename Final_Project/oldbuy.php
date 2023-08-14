<?php
$connect = mysqli_connect("localhost", "root", "", "test_db");
$tab_query = "SELECT * FROM category ORDER BY cat_id ASC";
$tab_result = mysqli_query($connect, $tab_query);
$tab_menu = '';
$tab_content = '';
$i = 0;
while($row = mysqli_fetch_array($tab_result))
{
 if($i == 0)
 {
  $tab_menu .= '
   <li class="active"><a href="#'.$row["cat_id"].'" data-toggle="tab">'.$row["name"].'</a></li>
  ';
  $tab_content .= '
   <div id="'.$row["cat_id"].'" class="tab-pane fade in active">
  ';
 }
 else
 {
  $tab_menu .= '
   <li><a href="#'.$row["cat_id"].'" data-toggle="tab">'.$row["name"].'</a></li>
  ';
  $tab_content .= '
   <div id="'.$row["cat_id"].'" class="tab-pane fade">
  ';
 }
 $product_query = "SELECT * FROM products WHERE cat_id = '".$row["cat_id"]."'";
 $product_result = mysqli_query($connect, $product_query);
 while($sub_row = mysqli_fetch_array($product_result))
 {
  $tab_content .= '
  <div class="col-md-3" style="margin-bottom:36px;">
  <img src="'.$sub_row["image"].'" class="img-responsive img-thumbnail" />

   <h2>'.$sub_row["title"].'</h2>
   <h4>'.$sub_row["author"].'</h4>
   <h12>'.$sub_row["description"].'</h12>
   <h4>'.$sub_row["new_old"].'</h4>
   <h4>'.$sub_row["price"].'</h4>
   <button class="buy_button" type="submit">קנה</button>

  </div>
  ';
 }
 $tab_content .= '<div style="clear:both"></div></div>';
 $i++;
}
?>

<!DOCTYPE html>
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="s.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="s.css">
 </head>
 <body>

 
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a  dir="rtl" style="float:right" class="navbar-brand" href="home_page.php"></i>&nbsp;&nbsp;Books</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item">
          <a class="nav-link"  href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orders.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
        <li class="nav-item">
           <?php  if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) : echo '<a class="nav-link" >hello,' , $_SESSION['name'],'</a>' ?>
           <li class="nav-item">
          <a class="nav-link" href="logout.php"></i>Logout </a>
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
            <marquee class="marquee" behavior="scroll" direction="down"></marquee>
                
           
              </div></div></div>
          

              
  <div class="container">
   <br />
   <ul class="nav nav-tabs">
   <?php
   echo $tab_menu;
   ?>
   </ul>
   <div class="tab-content">
   <br />
   <?php
   echo $tab_content;
   ?>
   </div>
  </div>

  
  <footer> 
   <a class="nav-link"  href="AboutUs.php"></i>אודות</a>
   <a class="nav-link" href="Contact.php"></i>צור קשר</a>
   <a class="nav-link" href="Quest&Ans.php"><i class="fa-solid fa-person"></i></i>שאלות ותשובות</a>
  <a>CopyRight &#169; Meital & Rim 2023</a></footer>
 </body>
</html>
 </body>

</html>

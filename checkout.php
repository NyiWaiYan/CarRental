<?php

include 'configuration.php';

session_start();

$userId = $_SESSION['userId'];

if(!isset($userId)){
   header('location:login.php');
}

if(isset($_POST['bookbtn'])){

   $name = mysqli_real_escape_string($connect, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($connect, $_POST['email']);
   $method = mysqli_real_escape_string($connect, $_POST['method']);
   $address =  $_POST['address'];
   $placed_on = date('d-M-Y');
$pickupdate=$_POST['pickupdate'];  ;
$dropoffdate=$_POST['dropoffdate'];

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($connect, "SELECT * FROM `show_detail` WHERE userId = '$userId'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){



         $cart_products[] = $cart_item['name'];



         $sub_total = $cart_item['price'];




         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($connect, "SELECT * FROM `booking` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND bookcar = '$total_products' AND price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{



        mysqli_query($connect,"INSERT INTO `booking`( `userId`, `name`, `bookcar`, `number`, `email`, `method`, `address`, `placed_on`, `pickupdate`, `dropoffdate`, `price`) VALUES ('$userId','$name','$total_products','$number','$email','$method','$address','$placed_on','$pickupdate','$dropoffdate','$cart_total')");


//mysqli_query($connect, "INSERT INTO `booking`(user_id, name, number, email, method, address, total_products, price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($connect, "DELETE FROM `show_detail` WHERE userId = '$userId'") or die('query failed');
      }

      
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'headpartial.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="index.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($connect, "SELECT * FROM `show_detail` WHERE userId = '$userId'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'];
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?></span>


</p>

<p> <?php echo $fetch_cart['price']; ?></span>


</p>

<p> <?php echo $fetch_cart['suitcase'].'suitcase'; ?></span>


</p>
<p> <?php echo $fetch_cart['passenger'].'passenger'; ?></span>


</p>
<p> <?php echo $fetch_cart['door'].'door'; ?></span>


</p>

<p>
<?php echo 'day price:'.$fetch_cart['priceperday'].'USD'; ?>

</p>
   <?php
      }
   }else{
      echo '<p class="empty">your booking is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span> $<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         
         <div class="inputBox">
            <span>Address:</span>
            <input type="text" name="address" required placeholder="Address">
         </div>
         <div class="inputBox">
            <span>PICK UP DATE:</span>
            <input type="date" name="pickupdate" required placeholder="D/M/Y">
         </div>
         <div class="inputBox">
            <span>DROP OFF DATE:</span>
            <input type="date" name="dropoffdate" required placeholder="D/M/Y">
         </div>

        

      </div>
      <input type="submit" value="book now" class="btn" name="bookbtn">
   </form>

</section>









<?php include 'footpartial.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
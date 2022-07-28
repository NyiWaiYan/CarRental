<?php

include 'configuration.php';

session_start();

$userId = $_SESSION['userId'];

if(!isset($userId)){
   header('location:login.php');
}

// if(isset($_POST['update_cart'])){
//    $cart_id = $_POST['cart_id'];
//     $cart_quantity = $_POST['cart_quantity'];
//     mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
//     $message[] = 'cart quantity updated!';
//  }

  if(isset($_GET['delete'])){
     $delete_id = $_GET['delete'];
     mysqli_query($connect, "DELETE FROM `show_detail` WHERE id = '$delete_id'") or die('query failed');
     header('location:tobook.php');
  }
//  $check_cart_numbers = mysqli_query($connect, "SELECT * FROM `show_detail` WHERE name = '$car_name' AND userId = '$userId'") or die('query failed');
//    if($check_cart_numbers['carname']==$car_name){
//      header('location:index.php');
//  }


 

//  if(isset($_GET['delete_all'])){
//     mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
//     header('location:cart.php');
 //};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'headpartial.php'; ?>

<div class="heading">
   <h3>BOOKING</h3>
   <p> <a href="index.php"> BACK TO HOME </p>
</div>

<section class="shopping-cart">

 

   <div class="box-container">
      <?php
          $total = 0;
          $select_cart = mysqli_query($connect, "SELECT * FROM `show_detail` WHERE userId = '$userId'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
          while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="tobook.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');">X</a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" width="250px">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price">$<?php echo $fetch_cart['price']; ?></div>
         <span class="label"> <?php echo $fetch_cart['passenger'];?> Passenger</span> <br>
      <span class="label"> <?php echo $fetch_cart['suitcase'];?> Suitcase</span> <br>
      <span class="label"> <?php echo $fetch_cart['door'];?> Doors</span> <br>
      <span class="label"> <?php echo $fetch_cart['priceperday'];?> Per Day</span> <br>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
          
          
         </form>
     
      </div>


      <?php



      
         }
      }else{
         echo '<p class="empty">EMPTY BOOKING!!! </p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
    
   </div>

   <div class="cart-total">
    
      <div class="flex">
         
         <a href="checkout.php" class="btn ">proceed to checkout</a>
      </div>
   </div>

</section>



<style>
    .label{
        font-size: 20px;
       color:green;
       text-transform: uppercase;
       
       
    }
</style>





<?php include 'footpartial.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
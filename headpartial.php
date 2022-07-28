<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>

         <p> new <a href="login.php">login</a> | <a href="registeration.php">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="index.php" class="logo">CARENT.</a>

         <nav class="navbar">
            <a href="index.php">home</a>
            <a href="about.php">about</a>
            <a href="shop.php">Car</a>
            <a href="contact.php">contact</a>
            <a href="booking.php">booking</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
             <?php
               //$select_cart_number = mysqli_query($connect, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               //$cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?> 

            <style>
                .booking {
                    background-color: yellow;
                    display: inline-block;
                    padding: 10px;
                    border-radius: 8%;
                }
            </style>
            <a href="tobook.php"> <i ></i> <span class="booking">YOUR BOOKING</span> </a>
         </div>

         <div class="userbox">
            <p>username : <span><?php echo $_SESSION['userName']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['userEmail']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>
<style>

    .userbox{
        display: inline-block;
        background-color: white;
        padding: 10px;
        
    }
</style>
</header>
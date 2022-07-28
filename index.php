

<?php include 'configuration.php';
session_start();



$userId=$_SESSION['userId'];
if(!isset($userId)){
    header('location:login.php');


 }  






?>

<?php
if(isset($_POST['booknow'])){

$car_name = $_POST['product_name'];

$car_img= $_POST['product_image'];
$car_passenger=$_POST['passenger'];
$car_suitcase=$_POST['suitcase'];
$car_door=$_POST['door'];
$car_dayprice=$_POST['dayprice'];
$car_price = $_POST['product_price'];

$check_cart_numbers = mysqli_query($connect, "SELECT * FROM `show_detail` WHERE name = '$car_name' AND userId = '$userId'") or die('query failed');
$check_name=mysqli_query($connect,"SELECT * FROM `show_detail`");
if(mysqli_num_rows($check_cart_numbers) >= 1){
   $message[] = 'pls proceed first';
}
// if(mysqli_num_rows($check_name)>=1){
//    $message[]='one cart item';

else{
   mysqli_query($connect, "INSERT INTO `show_detail`(userId, name,passenger,suitcase,door,priceperday, price, image) VALUES('$userId', '$car_name', '$car_passenger', '$$car_suitcase','$car_door','$car_dayprice','$car_price','$car_img')") or die('query failed');
   header('location:tobook.php');
}

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'headpartial.php'; ?>

<section class="home">

   <div class="content">
      <h3>CATCHY SLOGAN </h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quod? Reiciendis ut porro iste totam.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest car</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($connect, "SELECT * FROM `car` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" width="270px" height="12`0px">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
       <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                
      
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image"  value="<?php echo $fetch_products['image']; ?>">
      <span class="label"> <?php echo $fetch_products['passenger'];?> Passenger</span> <br>
      <span class="label"> <?php echo $fetch_products['suitcase'];?> Suitcase</span> <br>
      <span class="label"> <?php echo $fetch_products['door'];?> Doors</span> <br>
      <span class="label"> <?php echo $fetch_products['dayprice'];?> USD Per Day</span> <br>
      <input type="hidden" name="passenger" id="" value="<?php echo $fetch_products['passenger'];?>">
      
      <input type="hidden" name="suitcase" id="" value="<?php echo $fetch_products['suitcase'];?>">
      
      <input type="hidden" name="door" id="" value="<?php echo $fetch_products['door'];?>">
      <input type="hidden" name="dayprice" id="" value="<?php echo $fetch_products['dayprice'];?>">
     
      

            <input type="submit" value="book now" name="booknow" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
      <a href="contact.php" class="white-btn">contact us</a>
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
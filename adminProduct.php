<?php include 'configuration.php'; ?>
<?php
session_start();
$adminId = $_SESSION['adminId'];

if(!isset($adminId)){
   header('location:login.php');
};
//adding car
if(isset($_POST['add_car'])){
   $name = mysqli_real_escape_string($connect, $_POST['name']);
   $passenger = $_POST['passenger'];
   $suitcase = $_POST['suitcase'];
   $door=$_POST['door'];
   $priceperday=$_POST['priceperday'];
 
   $price = $_POST['price'];
   
   


   $image = $_FILES['image']['name'];

   //for uploading image
   $imageSize = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $selectProductName = mysqli_query($connect, "SELECT name FROM `car` WHERE name = '$name'") or die('query failed');
   if(mysqli_num_rows($selectProductName) > 0){
      $message[] = 'product name already added';
   }else{
      
      $addProductQuery = mysqli_query($connect, "INSERT INTO `car` (name, passenger,suitcase,door,dayprice,price, image) VALUES('$name', '$passenger','$suitcase','$door','$priceperday','$price', '$image')") or die('query failed');

      if($addProductQuery){





         if($imageSize > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}


//delete session

 if(isset($_GET['delete'])){
   $deleteId = $_GET['delete'];


    $deleteImgQuery = mysqli_query($connect, "SELECT image FROM `car` WHERE id = '$deleteId'") or die('query failed');
    $fetchDeleteImg = mysqli_fetch_assoc( $deleteImgQuery);
    unlink('uploaded_img/'.$fetchDeleteImge['image']);


    mysqli_query($connect, "DELETE FROM `car` WHERE id = '$deleteId'") or die('query failed');
    header('location:adminProduct.php');
 }

 //update or edit
 if(isset($_POST['update_product'])){

   //  $update_p_id = $_POST['update_p_id'];
   //  $update_name = $_POST['update_name'];
   //  $update_price = $_POST['update_price'];

    $update_p_id = $_POST['update_p_id'];
    $updatename = $_POST['updatename'];
    $updatepassenger = $_POST['updatepassenger'];
    $updatesuitcase = $_POST['updatesuitcase'];
    $updatedoor = $_POST['updatedoor'];
    $updatepriceperday=$_POST['updatepriceperday'];
    $update_price = $_POST['updateprice'];
    mysqli_query($connect, "UPDATE `car` SET name = '$updatename', passenger='$updatepassenger', suitcase='$updatesuitcase', door='$updatedoor', dayprice='$updatepriceperday', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');
    $update_image = $_FILES['update_image']['name'];
  
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/'.$update_image;
    $update_old_image = $_POST['update_old_image'];
    if(!empty($update_image)){



      
       if($update_image_size > 2000000){
          $message[] = 'image file size is too large';
       }else{
          mysqli_query($connect, "UPDATE `car` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
          move_uploaded_file($update_image_tmp_name, $update_folder);
          unlink('uploaded_img/'.$update_old_image);
       }
    }

    header('location:adminproduct.php');

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CARS</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/adminstyle.css">

</head>
<body>
<?php include 'adminnavbar.php'; ?>


<section class="add-products">
   <h1 class="title">CARS</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <h3>add cars</h3>
      <input type="text" name="name" class="box" placeholder="enter car name" required>
      <input type="number" min="0" name="passenger" class="box" placeholder="enter passenger" required>
      <input type="number" min="0" name="suitcase" class="box" placeholder="enter suitcase" required>
      <input type="number" name="door" class="box" placeholder="enter door" required>
     <input type="text" name="priceperday" class="box" placeholder="price per day" required>
     <input type="text" name="price" class="box" placeholder="Enter Price" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="addcar" name="add_car" class="btn">
   </form>

</section>

<style>
   .co{
      color:green;
   }

   .name{
      font-size: 30px;

   }


</style>




<section class="show-products">

   <div class="box-container">

      <?php
      //showing products
         $selectProducts = mysqli_query($connect, "SELECT * FROM `car`") or die('query failed');
         if(mysqli_num_rows($selectProducts) > 0){
            while($fetchProducts = mysqli_fetch_assoc($selectProducts)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetchProducts['image']; ?>" alt="" width="270" height="20px"> 
         <div class="name" > <?php echo $fetchProducts['name']; ?></div>
         <div class="price"> <?php echo $fetchProducts['dayprice']; ?> <span class="co">  PER DAY</span></div>
         <div class="price"> 
            <span class="co">SUITCASE: </span> <?php echo $fetchProducts['suitcase']; ?><span class="co">  </span></div>
         <div class="price"> <span class="co"> PERSON : </span><?php echo $fetchProducts['passenger']; ?></div>
         <div class="price"> <?php echo $fetchProducts['door']; ?> <span class="co"> DOORS </span></div>
         <div class="price"> <?php echo $fetchProducts['price']; ?>  </div>
         <a href="adminproduct.php?update=<?php echo $fetchProducts['id']; ?>" class="option-btn">update</a>
         <a href="adminproduct.php?delete=<?php echo $fetchProducts['id']; ?>" class="delete-btn" onclick="return confirm('are you delete this car?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">
<!-- UPDATE OR EDIT CAR DETAIL -->
   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $updateQuery = mysqli_query($connect, "SELECT * FROM `car` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($updateQuery) > 0){
            while($fetch_update = mysqli_fetch_assoc($updateQuery)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <!-- <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="" width="20px" height="0px"> -->
      <input type="text" name="updatename" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter car name">
      <input type="text" name="updatepassenger" value="<?php echo $fetch_update['passenger']; ?> "  class="box" required placeholder="enter passenger">
      <input type="text" name="updatesuitcase" value="<?php echo $fetch_update['suitcase']; ?>" class="box" required placeholder="enter suitcase">
      <input type="text" name="updatedoor" value="<?php echo $fetch_update['door']; ?>" class="box" required placeholder="enter door   ">

      <input type="text" name="updateprice" value="<?php echo $fetch_update['price']; ?>"  class="box" required placeholder="enter price">
      <input type="text" name="updatepriceperday" value="<?php echo $fetch_update['dayprice']; ?>" class="box" required placeholder="enter day rent price">

      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
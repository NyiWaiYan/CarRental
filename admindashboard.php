
<?php include 'configuration.php';
session_start();

$adminId=$_SESSION['adminId'];
if(!isset($adminId)){
    header('location:login.php');
 }

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/adminstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    
 <?php include 'adminnavbar.php'; ?>


<section>







<section class="dashboard">



<div class="box-container">


      <div class="box">
         <?php 
            $select_orders = mysqli_query($connect, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>order placed</p>
      </div>

      <div class="box">
         <?php 
            $select_cars = mysqli_query($connect, "SELECT * FROM `car`") or die('query failed');
            $number_of_cars = mysqli_num_rows($select_cars);
         ?>
         <h3><?php echo $number_of_cars; ?></h3>
         <p>cars added</p>
      </div>

      <div class="box">
         <?php 
            $select_users = mysqli_query($connect, "SELECT * FROM `user` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>normal users</p>
      </div>

      <div class="box">
         <?php 
            $select_admins = mysqli_query($connect, "SELECT * FROM `user` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php 
            $select_account = mysqli_query($connect, "SELECT * FROM `user`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>


   </div>
        </div>
        <div>




</section>


</body>
</html>
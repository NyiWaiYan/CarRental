  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/adminstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<header class="header">
<div class="flex">

<a href="admindashboard.php" class="logo">Admin Dashboard</span></a>





<nav class="navbar">
   <a href="admindashboard.php">home</a>
   <a href="adminProduct.php">cars</a>
   <a href="adminOrder.php">orders</a>
   
   <a href="adminContact.php">messages</a>
</nav>




<div class="icons">
   <div id="menu-btn" class="fas fa-bars"></div>
   <div id="user-btn" class="fas fa-user"></div>
   
</div>






<div class="user1">


<p>username : <span><?php echo $_SESSION['adminName']; ?></span></p>
   <p>email : <span><?php echo $_SESSION['adminEmail']; ?></span></p>

</div>


  
<a href="logout.php" class="delete-btn">logout</a>

</header>



<div style="color:BLUE" class="new">new <a href="login.php">login</a> | <a href="register.php">register</a></div>


</div>
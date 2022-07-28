<?php
include 'configuration.php';
session_start();

if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($connect, $_POST['email']);

        $password = mysqli_real_escape_string($connect, md5($_POST['password']));

               //one stage before fetching

        $selectUsers= mysqli_query($connect, "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'") or die('query failed');

               

if(mysqli_num_rows($selectUsers) > 0){

   $row = mysqli_fetch_assoc($selectUsers);

   if($row['user_type'] == 'admin'){


        //checking admin log in
      $_SESSION['adminName'] = $row['name'];
      $_SESSION['adminEmail'] = $row['email'];
      $_SESSION['adminId'] = $row['id'];
      header('location:admindashboard.php');
   }elseif($row['user_type'] == 'user'){


  //checking user log in
    $_SESSION['userName'] = $row['name'];
    $_SESSION['userEmail'] = $row['email'];
    $_SESSION['userId'] = $row['id'];
    header('location:index.php');
    
   }
 }else{
    $message[] = 'SOMETHING IS WRONG!';
 

   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
 
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
<div class="f-container">



   <form  action=""   method="post" >



      <h3>LOGIN</h3>
      <input type="email" name="email"  class="box" placeholder="EMAIL"  required>
      <input type="password" name="password" class="box" required   placeholder="PASSWORD">
      <input type="submit" name="submit" class="btn" value="login" >
      <p> IF YOU DON'T HAVE ACCOUNT <a href="regeisteration.php">
          REGEISTER NOW
      </a></p>
   </form>

</div>

  

</body>
</html>
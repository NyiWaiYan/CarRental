
<?php
include 'configuration.php';
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $pass = mysqli_real_escape_string($connect, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($connect, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];
    //user selecting from database
    $selectUsers = mysqli_query($connect, "SELECT * FROM  `user` WHERE email = '$email' AND password = '$pass'")
     or die('Failed');



        //checking user already existed or not
     if(mysqli_num_rows($selectUsers)>0){
         $message[]="USER EXIST";

     }else{


         //checking password
        if($pass!=$cpass){
            $message[] = ' Passwords are not matched!';
         }else{
            mysqli_query($connect, "INSERT INTO  `user`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'Regeisteration Complete!';
         
            header('location:login.php');
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
    <title>REGEISERATION</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
    
        <form action="" method="post">
        <h3>register Here</h3>
            <input type="text" name="name" class="box" placeholder="YOUR NAME" required >


            <input type="email" name="email"  class="box" placeholder="YOUR EMAIL " required >


            <input type="password" name="password"   class="box" placeholder="PASSWORD" required>


             <input type="password" name="cpassword"  class="box" placeholder="CONFIRM PASSWORD" required >


            <select name="user_type" class="box">

            <option value="admin">ADMIN</option>

            <option value="user">USER</option>

            </select>


             <input type="submit" name="submit" value="register now" class="btn">

              <p> If you already have account <a href="login.php">login now</a></p>
   </form>
        </form>
    </div>
</body>
</html>

<!-- PHP CODE HERE -->

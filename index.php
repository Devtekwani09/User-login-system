<?php

include 'conn.php';
session_start();
$user_id = $_SESSION['uname'];

if(!isset($user_id)){
   header('location:login.html');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style2.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->


</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM users WHERE uname = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['pp'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="images/'.$fetch['pp'].'">';
         }
      ?>
      <h3><?php echo $fetch['fname']; ?></h3>
      <a href="update.php" class="btn">update profile</a>
      <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      <p>new <a href="login.html">login</a> or <a href="register.html">register</a></p>
   </div>

</div>

</body>
</html>
<?php
session_start();

include 'conn.php';

$uname = $_POST['uname'];
$password = $_POST['password'];

if($uname == NULL || $password == NULL){
  echo "<script>alert('username or password cannot be null');</script>";
  echo "<script>window.location.href = 'login.html';</script>";
}

else{
$q = "SELECT * FROM users WHERE uname = '$uname' AND password = '$password'";

$res = mysqli_query($conn, $q);
$num = mysqli_num_rows($res);

if ($num == 1) {
    $_SESSION['uname'] = $uname;
    header('location:index.php');
} else {
  echo "<script>alert('Invalid username or password');</script>";
  echo "<script>window.location.href = 'login.html';</script>";
}
}

$conn->close();
?>

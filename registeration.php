<?php
session_start();

include 'conn.php';

$fname = $_POST['fname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$password = $_POST['password'];

if( $fname == NULL || $uname == NULL || $email == NULL || $password == NULL){
    echo "<script>alert('Enteries cannot be  null');</script>";
    echo "<script>window.location.href = 'register.html';</script>";
  }

// Check if the user already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? || uname = ?");
$stmt->bind_param("ss", $ename, $uname);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    echo "<script>alert('User already exists');</script>";
} else {
    // Insert the new user if they don't exist
    $stmt = $conn->prepare("INSERT INTO users (fname, uname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $uname, $email, $password);
    
    if ($stmt->execute()) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>

<script>
    window.location.href = 'register.html';
</script>

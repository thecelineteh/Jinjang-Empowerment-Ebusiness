<?php
  session_start();
  include 'dbConnection.php';
  
  $username = mysqli_real_escape_string($connection, $_SESSION['userName']);
  
  $password = stripcslashes($_POST['Spassword']);
  $fullName = stripcslashes($_POST['Sfullname']);
  $email = stripcslashes($_POST['Semail']);
  $phone = stripcslashes($_POST['Sphone']);
  $address = stripcslashes($_POST['Saddress']);
  $fullName = stripcslashes($_POST['Sfullname']);

  $password = mysqli_real_escape_string($connection, $password);
  $email = mysqli_real_escape_string($connection, $email);
  $phone = mysqli_real_escape_string($connection, $phone);
  $address = mysqli_real_escape_string($connection, $address);
  $fullName = mysqli_real_escape_string($connection, $fullName);

  // update user attributes
  $update_user = "UPDATE user SET password = '$password', address = '$address', phone='$phone', email = '$email' WHERE username = '$username'";
  $result_user = mysqli_query($connection, $update_user);

  // update jobseeker attribute
  $update_s = "UPDATE jobseeker SET fullName = '$fullName' WHERE username = '$username'";
  $result_s = mysqli_query($connection, $update_s);

  mysqli_close($connection);
?>

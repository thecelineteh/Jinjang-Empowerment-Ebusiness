<?php
  session_start();
  include 'dbConnection.php';

  $username = mysqli_real_escape_string($connection, $_SESSION['userName']);

  $password = stripcslashes($_POST['Cpassword']);
  $phone = stripcslashes($_POST['Cphone']);
  $address = stripcslashes($_POST['Caddress']);
  $email = stripcslashes($_POST['Cemail']);
  $companyName = stripcslashes($_POST['CcompanyName']);
  $companyDescription = stripcslashes($_POST['CcompanyDescription']);

  $password = mysqli_real_escape_string($connection, $password);
  $phone = mysqli_real_escape_string($connection, $phone);
  $address = mysqli_real_escape_string($connection, $address);
  $email = mysqli_real_escape_string($connection, $email);
  $companyName = mysqli_real_escape_string($connection, $companyName);
  $companyDescription = mysqli_real_escape_string($connection, $companyDescription);

  // update user attributes
  $update_user = "UPDATE user SET password = '$password', address = '$address', phoneNo='$phone', email = '$email' WHERE username = '$username'";
  $result_user = mysqli_query($connection, $update_user);

  // update client attributes
  $update_c= "UPDATE client SET companyName = '$companyName', companyDescription = '$companyDescription' WHERE username = '$username'" ;
  $result_c = mysqli_query($con, $update_c);

  if ($result_user && $result_c) {
    echo "<script>alert('Update profile successful.');</script>";
    header("Refresh: 1; url= jProfile.php");
  } else {
    echo "<script>alert('Unable to update profile.');</script>";
    header("Refresh: 1; url= jProfile.php");
  }

  mysqli_close($connection);
?>

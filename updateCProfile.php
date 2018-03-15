<?php
  /* requires editing */
  session_start();
  include 'dbConnection.php';
  
  $username = $_SESSION['userName'];
  // update job seeker profile
  if ($_SESSION['userType'] == 'Job Seeker'){
    $password = stripcslashes($_POST['Spassword']);
    $fullName = stripcslashes($_POST['Sfullname']);
    $email = stripcslashes($_POST['Semail']);
    $phone = stripcslashes($_POST['Sphone']);
    $address = stripcslashes($_POST['Saddress']);

   
    $fullName = mysqli_real_escape_string($connection, $fullName);

    // update jobseeker attribute
    $update_s= "UPDATE jobseeker SET fullName = '$fullName' WHERE username = '$username'" ;
    $result_s = mysqli_query($con, $update_s);

  } else {
    $password = stripcslashes($_POST['Cpassword']);
    $companyName = stripcslashes($_POST['CcompanyName']);
    $companyDescription = stripcslashes($_POST['CcompanyDescription']);
    $phone = stripcslashes($_POST['Cphone']);
    $address = stripcslashes($_POST['Saddress']);

    $companyName = mysqli_real_escape_string($connection, $companyName);
    $companyDescription = mysqli_real_escape_string($connection, $companyDescription);

    // update client attributes
    $update_c= "UPDATE client SET companyName = '$companyName', companyDescription = '$companyDescription' WHERE username = '$username'" ;
    $result_c = mysqli_query($con, $update_c);
  }
  
  $password = mysqli_real_escape_string($connection, $password);
  $email = mysqli_real_escape_string($connection, $email);
  $phone = mysqli_real_escape_string($connection, $phone);
  $address = mysqli_real_escape_string($connection, $address);

  // update user attributes
  $update_user= "UPDATE user SET password = '$password', address = '$address', phone='$phone', email = '$email' WHERE username = '$username'" ;
  $result_user = mysqli_query($con, $update_user);
  

  mysqli_close($connection);
?>

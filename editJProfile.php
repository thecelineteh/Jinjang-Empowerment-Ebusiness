<?php
  session_start();
  include 'dbConnection.php';

  $userName = stripcslashes($_POST['Susername']);
  $password = stripcslashes($_POST['Spassword']);
  $fullName = stripcslashes($_POST['Sfullname']);
  $email = stripcslashes($_POST['Semail']);
  $phone = stripcslashes($_POST['Sphone']);
  
  $userName = mysqli_real_escape_string($connection, $userName);
  $password = mysqli_real_escape_string($connection, $password);
  $fullName = mysqli_real_escape_string($connection, $fullName);
  $email = mysqli_real_escape_string($connection, $email);
  $phone = mysqli_real_escape_string($connection, $phone);

  $query = "SELECT * FROM user WHERE username = '$userName' and
          password = '$password'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);

  if ($row['username'] == $userName && $row['password'] == $password) {
    header('Location: jobs.html');
    $_SESSION['userName'] = $row['username'];
    if (isset($remember)) {
      $_SESSION['remember'] = $row['username'];
    }
    else {
      unset($_SESSION['remember']);
    }
  }
  else {
    header('Location: index.php');
    $_SESSION['userName'] = "failed";
  }

   mysqli_close($connection);
 ?>

<?php
  session_start();
  $serverName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "jee";
  $connection = new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

  $userName = stripcslashes($_POST['Cusername']);
  $password = stripcslashes($_POST['Cpassword']);
  $companyName = stripcslashes($_POST['Ccompanyname']);
  $email = stripcslashes($_POST['Cemail']);
  $phone = stripcslashes($_POST['Cphone']);
  $userType = stripcslashes($_POST['userType']);
  $userName = mysqli_real_escape_string($connection, $userName);
  $password = mysqli_real_escape_string($connection, $password);
  $companyName = mysqli_real_escape_string($connection, $companyName);
  $email = mysqli_real_escape_string($connection, $email);
  $phone = mysqli_real_escape_string($connection, $phone);
  $userType = mysqli_real_escape_string($connection, $userType);

  $query = "SELECT * FROM user WHERE userName = '$userName'";
  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('sign up failed');</script>";
    $_SESSION['SignUp'] = "failed";
    header("Location: index.php");
  }
  else {
    $query = "INSERT INTO  user (username, password, address, phoneNo, email, userType) VALUES
    ('$userName','$password','','$email', '$phone','$userType')";
    $query2 = "INSERT INTO  client (username, companyName, companyDescription) VALUES
    ('$userName', '$companyName', '')";
    mysqli_query($connection, $query);
    mysqli_query($connection, $query2);
    header("Location: index.php");
    unset($_SESSION['SignUp']);
  }

  mysqli_close($connection);
?>

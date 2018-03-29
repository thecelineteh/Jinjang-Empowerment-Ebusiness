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

  unset($_SESSION['userName']);
  if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('sign up failed');</script>";
    $_SESSION['SignUp'] = "failed";
    header("Location: index.php");
  }
  else {
    $query = "INSERT INTO  user (userID, username, password, address, phoneNo, email, userType) VALUES
    (NULL, '$userName','$password','','$phone', '$email','$userType')";
    mysqli_query($connection, $query);
    $query3 = "SELECT userID from user where userName='$userName'";
    $result = mysqli_query($connection, $query3);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $userID = $row['userID'];
      }
    }
    $query2 = "INSERT INTO  client (userID, companyName, companyDescription) VALUES
    ('$userID', '$companyName', '')";
    mysqli_query($connection, $query2);

    header("Location: index.php");
    $_SESSION['SignUp'] = "success";
  }
  echo $_SESSION['SignUp'];

  mysqli_close($connection);
?>

<?php
  session_start();
  include 'dbConnection.php';

  $userName = stripcslashes($_POST['username']);
  $password = stripcslashes($_POST['password']);
  $remember = $_POST['remember'];

  $query = "SELECT * FROM user WHERE username = '$userName' and
          password = '$password'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);

  unset($_SESSION['SignUp']);

  if ($row['username'] == $userName && $row['password'] == $password) {
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['userName'] = $row['username'];
    $_SESSION['userType'] = $row['userType'];
    if ($row['userType'] == 'Job Seeker') {
      header('Location: jobs.php');
    } else if ($row['userType'] == 'Client') {
      header('Location: cJobPositions.php');
    }
    if (isset($remember)) {
      $_SESSION['remember'] = $row['username'];
    }
    else {
      unset($_SESSION['remember']);
    }

    echo $_SESSION['userName'];
  }
  else {
    header('Location: index.php');
    $_SESSION['userName'] = "failed";
  }

  mysqli_close($connection);
 ?>

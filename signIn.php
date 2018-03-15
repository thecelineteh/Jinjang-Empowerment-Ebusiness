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

  if ($row['username'] == $userName && $row['password'] == $password) {
    $_SESSION['userName'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['phone'] = $row['phoneNo'];
    $_SESSION['address'] = $row['address'];

    if ($row['userType'] == 'Job Seeker') {
      $query_S = "SELECT * FROM jobseeker WHERE username = '$userName'";
      $result_S = mysqli_query($connection, $query_S);
      $row_S = mysqli_fetch_assoc($result_S);
      $_SESSION['Sfullname'] = $row_S['fullName'];
      header('Location: jobs.html');
    } else {
      header('Location: postJob.html');
    }

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

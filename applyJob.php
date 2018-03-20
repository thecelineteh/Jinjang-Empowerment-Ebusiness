<?php
  session_start();
  $serverName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "jee";
  $connection = new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

  $jobID = $_POST['jobID'];
  $userID = $_SESSION['userID'];

  $query = "SELECT * FROM jobapplication WHERE jobID = '$jobID'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['apply'] = "failed";
    header("Location: jobDetails.php");
  }
  else {
    $query = "INSERT INTO  jobapplication (applicationID, jobID, theJobSeeker, status) VALUES
    (NULL, '$jobID','$userID','PENDING')";
    mysqli_query($connection, $query);
    $_SESSION['apply'] = "success";
    header("Location: jobDetails.php");
  }
  $_SESSION['jobID'] = $jobID;
  mysqli_close($connection);
 ?>

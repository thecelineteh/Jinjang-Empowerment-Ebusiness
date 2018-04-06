<?php
  session_start();
  $serverName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "jee";
  $connection = new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

  $theApplicant = $_SESSION['userID'];
  $applicationID = $_POST['applicationID'];

  if (isset($_POST['cancelAppBtn'])) {
    $delete_app = "DELETE FROM jobapplication WHERE applicationID = $applicationID";
    $result_delete_app = mysqli_query($connection, $delete_app);

  }

  if ($result_delete_app) {
    echo "<script>alert('Job application has been successfully cancelled.');</script>";
    header("Refresh: 1; url= jobApplications.php");
  } else {
    echo "<script>alert('Unable to cancel application.');</script>";
    header("Refresh: 1; url= jobApplications.php");
  }

  mysqli_close($connection);
 ?>

<?php
  session_start();
  $serverName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "jee";
  $connection = new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

  $theClient = $_SESSION['userID'];
  $applicationID = $_POST['applicationID'];

  if (isset($_POST['acceptBtn'])) {
    $updated_status = $_POST['acceptBtn'];
  } else if (isset($_POST['declineBtn'])) {
    $updated_status = $_POST['declineBtn'];
  }

  $query_application = "UPDATE jobapplication SET status = '$updated_status' WHERE applicationID = $applicationID";
  $result_application = mysqli_query($connection, $query_application);

  if ($result_application) {
    echo "<script>alert('Job application " . $updated_status . ".');</script>";
    header("Refresh: 1; url= jobApplications.php");
  } else {
    echo "<script>alert('Unable to accept/decline application.');</script>";
    header("Refresh: 1; url= jobApplications.php");
  }

  mysqli_close($connection);
 ?>

<?php
  session_start();
  $serverName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "jee";
  $connection = new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

  $theClient = $_SESSION['userID'];
  $applicationID = $_POST['applicationID'];
  $jobID = $_POST['jobID'];
  $theEmployee = $_POST['theEmployee'];

  $_SESSION['jobID'] = $jobID;

  if (isset($_POST['acceptBtn'])) {
    // accept an application for a particular jobID
    $updated_status = $_POST['acceptBtn'];
    $query_employee = "UPDATE jobposition SET theEmployee = $theEmployee, status = 'NOT AVAILABLE' WHERE jobID = $jobID";
    $result_employee = mysqli_query($connection, $query_employee);

    // for all other applications with the same jobID
    $q_app_for_same_job = "SELECT * FROM jobapplication WHERE jobID = $jobID";
    $result_q = mysqli_query($connection, $q_app_for_same_job);

    if (mysqli_num_rows($result_q) > 0) {
      while($row_q = mysqli_fetch_array($result_q))
      {
        // auto set status to declined
        $q_autoset_status = "UPDATE jobapplication SET status = 'DECLINED' WHERE jobID = $jobID";
        $result_autoset = mysqli_query($connection, $q_autoset_status);
      }
    }

  } else if (isset($_POST['declineBtn'])) {
    $updated_status = $_POST['declineBtn'];
  }

  $query_application = "UPDATE jobapplication SET status = '$updated_status' WHERE applicationID = $applicationID";
  $result_application = mysqli_query($connection, $query_application);

  if ($result_application && isset($result_employee)) {
    echo "<script>alert('Job application " . $updated_status . ", employee name and job position status updated.');</script>";
    if (isset($result_autoset)) {
      echo "<script>alert('The status of other applications for the same job have been automatically set to declined.');</script>";
    }
    header("Refresh: 1; url= jobApplications.php");
  } else if ($result_application) {
    echo "<script>alert('Job application " . strtolower($updated_status) . ".');</script>";
    if (isset($result_autoset)) {
      echo "<script>alert('The status of other applications for the same job have been automatically set to declined.');</script>";
    }
    header("Refresh: 1; url= jobApplications.php");
  } else {
    echo "<script>alert('Unable to accept/decline application.');</script>";
    header("Refresh: 1; url= jobApplications.php");
  }

  mysqli_close($connection);
 ?>

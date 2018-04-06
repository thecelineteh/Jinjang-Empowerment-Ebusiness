<?php
  session_start();
  include 'dbConnection.php';

  $theClient = $_SESSION['userID'];
  $jobID = $_POST['delJob'];

  if (isset($_POST['deleteBtn'])) {
    $delete_job = "DELETE FROM jobposition WHERE jobID = $jobID AND theEmployee = 0";
    $result_delete_job = mysqli_query($connection, $delete_job);

    if (mysqli_num_rows($result_delete_job) > 0) {
      echo "<script>alert('Job position deleted successfully.');</script>";
      header("Refresh: 1; url= jobPositions.php");
    } else {
      echo "<script>alert('Unable to delete job which has an existing employee.');</script>";
      header("Refresh: 1; url= jobPositions.php");
    }

  }

  mysqli_close($connection);
?>

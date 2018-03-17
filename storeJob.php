<?php
  session_start();
  include 'dbConnection.php';

  if (!isset($_SESSION['jobID'])) {
    $_SESSION['jobID'] = 'J1';
  }

  $title = stripcslashes($_POST['jobTitle']);
  $desc = stripcslashes($_POST['jobDescription']);
  $address = stripcslashes($_POST['jobAddress']);
  $city = stripcslashes($_POST['jobCity']);
  $salary = stripcslashes($_POST['jobSalary']);
  $hours = stripcslashes($_POST['jobHours']);
  $weeks = stripcslashes($_POST['jobDuration']);
  $reqSkillSet = $_POST['reqSkillSet'];

  $title = mysqli_real_escape_string($connection, $title);
  $desc = mysqli_real_escape_string($connection, $desc);
  $address = mysqli_real_escape_string($connection, $address);
  $city = mysqli_real_escape_string($connection, $city);
  $salary = mysqli_real_escape_string($connection, $salary);
  $hours = mysqli_real_escape_string($connection, $hours);
  $weeks = mysqli_real_escape_string($connection, $weeks);

  $status = 'AVAILABLE';
  $theClient = mysqli_real_escape_string($connection, $_SESSION['userName']);

  $query_storeJob = "INSERT INTO jobposition (title, description, salaryPerHour, hoursPerWeek, durationInWeeks, address, city, status, theClient) VALUES
  ('$title','$desc','','$salary', '$hours', '$weeks', '$address','$city', '$status', '$theClient')";
  $result_storeJob = mysqli_query($connection, $query_storeJob);
/*
  // find jobID of created job
  $query_findJob = "SELECT * FROM jobposition WHERE theClient = '$theClient' AND title = '$title'";
  $result_findJob = mysqli_query($connection, $query_findJob);
  while($row_jobPositions = mysqli_fetch_assoc($result_findJob)) {
    $jobID = $row_jobPositions['jobID'];
  }

  // Based on skillName, find skills required in skill table
  foreach ($reqSkillSet as $skillName) {
    $req_skills = "SELECT * FROM skill WHERE skillName = '$skillName'";
    $result_req_skills = mysqli_query($connection, $req_skills);

    while ($row_req_skills = mysqli_fetch_assoc($result_req_skills)) {
      $skillID = $row_req_skills['skillID'];
    }
      $add_reqskillset = "INSERT INTO jobrequiredskill VALUES('$jobID', '$skillID')";
      $result_add_reqskillset = mysqli_query($connection, $add_reqskillset);

  }

*/


  if ($result_storeJob ) {
    echo "<script>alert('Job position created successfully.');</script>";
    header("Refresh: 1; url= cJobPositions.php");
  } else {
    //echo $result_add_reqskillset;
    echo mysqli_error($connection);
    //echo "<script>alert('Unable to create job.');</script>";
    //header("Refresh: 1; url= createJob.php");
  }

  mysqli_close($connection);
?>

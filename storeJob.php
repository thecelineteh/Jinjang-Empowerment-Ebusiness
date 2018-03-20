<?php
  session_start();
  include 'dbConnection.php';

  $title = stripcslashes($_POST['jobTitle']);
  $desc = stripcslashes($_POST['jobDescription']);
  $address = stripcslashes($_POST['jobAddress']);
  $city = stripcslashes($_POST['jobCity']);
  $salary = stripcslashes($_POST['jobSalary']);
  $hours = stripcslashes($_POST['jobHours']);
  $weeks = stripcslashes($_POST['jobDuration']);

  $title = mysqli_real_escape_string($connection, $title);
  $desc = mysqli_real_escape_string($connection, $desc);
  $address = mysqli_real_escape_string($connection, $address);
  $city = mysqli_real_escape_string($connection, $city);

  if (!isset($jobStatus)) {
    $jobStatus = 'AVAILABLE';
  }

  if (!isset($theEmployee_userID)) {
    $theEmployee_userID = 0;
  }

  $theClient = $_SESSION['userID'];

  // create new job position
  if (isset($_POST['createJobBtn'])) {
    $reqSkillSet = $_POST['reqSkillSet'];

    $query_storeJob = "INSERT INTO jobposition (title, description, salaryPerHour, hoursPerWeek, durationInWeeks, address, city, status, theClient, theEmployee) VALUES ('$title','$desc', '$salary', '$hours', '$weeks', '$address','$city', '$jobStatus', $theClient, $theEmployee_userID)";
    $result_storeJob = mysqli_query($connection, $query_storeJob);

    // find jobID of created job
    $query_findJob = "SELECT * FROM jobposition WHERE theClient = $theClient AND title = '$title'";
    $result_findJob = mysqli_query($connection, $query_findJob);
    while($row_jobPositions = mysqli_fetch_assoc($result_findJob)) {
      $jobID = $row_jobPositions['jobID'];


      // Based on skillName, find skills required in skill table
      foreach ($reqSkillSet as $skillName) {
        $req_skills = "SELECT * FROM skill WHERE skillName = '$skillName'";
        $result_req_skills = mysqli_query($connection, $req_skills);

        while ($row_req_skills = mysqli_fetch_assoc($result_req_skills)) {
          $skillID = $row_req_skills['skillID'];
        }
          $add_reqskillset = "INSERT INTO jobrequiredskill VALUES($jobID, $skillID)";
          $result_add_reqskillset = mysqli_query($connection, $add_reqskillset);

      }
    }

    if ($result_storeJob && $result_add_reqskillset) {
      echo "<script>alert('Job position created successfully.');</script>";
      header("Refresh: 1; url= jobPositions.php");
    } else {
      echo "<script>alert('Unable to create job.');</script>";
      header("Refresh: 1; url= jobPositions.php");
    }
  }

  // update existing job position
  if (isset($_POST['updateJobBtn'])){
    $existing_jobID = $_SESSION['jobID'];
    $jobStatus = stripcslashes($_POST['jobStatus']);
    $jobStatus = mysqli_real_escape_string($connection, $jobStatus);
    $empName = stripcslashes($_POST['empName']);
    $empName = mysqli_real_escape_string($connection, $empName);

    if (!isset($_POST['jobReqSkills'])) {
      $jobReqSkills = array();
    } else {
      $jobReqSkills = $_POST['jobReqSkills'];
    }

    $findEmp_userID = "SELECT * FROM jobseeker WHERE fullName = '$empName'";
    $result_findEmployee_userID = mysqli_query($connection, $findEmp_userID);

    //if (mysqli_num_rows($result_findEmployee_userID) > 0) {
      while ($row_findEmp_userID = mysqli_fetch_assoc($result_findEmployee_userID)) {
        $theEmployee_userID = $row_findEmp_userID['userID'];
      }
    //}

    $update_jobpos = "UPDATE jobposition SET title = '$title', description = '$desc', salaryPerHour = '$salary', hoursPerWeek = '$hours', durationInWeeks = '$weeks', address = '$address', city = '$city', status = '$jobStatus', theClient = '$theClient', theEmployee = $theEmployee_userID WHERE jobID = $existing_jobID";
    $result_update_jobpos = mysqli_query($connection, $update_jobpos);


    // update job position required skills
    $clear_skillsreq = "DELETE FROM jobrequiredskill WHERE jobID = $existing_jobID";
    $result_clear_skillsreq = mysqli_query($connection, $clear_skillsreq);

    // Based on skillName, find job required skills in skill table
    foreach ($jobReqSkills as $skillName) {
      $req_skills = "SELECT * FROM skill WHERE skillName = '$skillName'";
      $result_req_skills = mysqli_query($connection, $req_skills);

      while ($row_req_skills = mysqli_fetch_assoc($result_req_skills)) {
        $skillID = $row_req_skills['skillID'];
        $update_skillsreq = "INSERT INTO jobrequiredskill VALUES($existing_jobID, $skillID)";
        $result_update_skillsreq = mysqli_query($connection, $update_skillsreq);
      }
    }

    if ($result_update_jobpos && $result_update_skillsreq){
      echo "<script>alert('Job position details updated successfully.');</script>";
      header("Refresh: 1; url= jobPositions.php");
    } else {
      //echo mysqli_error($connection);
      echo "<script>alert('Unable to update job.');</script>";
      header("Refresh: 1; url= jobPositions.php");

    }
  }

  unset($jobStatus);
  unset($theEmployee_userID);


  mysqli_close($connection);
?>

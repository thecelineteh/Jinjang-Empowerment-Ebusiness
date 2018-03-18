<?php
  session_start();
  include 'dbConnection.php';

  $userID = $_SESSION['userID'];
  $username = mysqli_real_escape_string($connection, $_SESSION['userName']);

  $password = stripcslashes($_POST['password']);
  $email = stripcslashes($_POST['email']);
  $phone = stripcslashes($_POST['phone']);
  $address = stripcslashes($_POST['address']);

  $password = mysqli_real_escape_string($connection, $password);
  $email = mysqli_real_escape_string($connection, $email);
  $phone = mysqli_real_escape_string($connection, $phone);
  $address = mysqli_real_escape_string($connection, $address);

  // update user attributes
  $update_user = "UPDATE user SET password = '$password', address = '$address', phoneNo='$phone', email = '$email' WHERE username = '$username'";
  $result_user = mysqli_query($connection, $update_user);

  if ($_SESSION['userType'] == 'Job Seeker') {
    // job seeker attributes
    $fullName = stripcslashes($_POST['Sfullname']);
    $skillset = $_POST['sSkillSet'];

    $fullName = mysqli_real_escape_string($connection, $fullName);

    // update jobseeker attribute
    $update_s = "UPDATE jobseeker SET fullName = '$fullName' WHERE userID = $userID";
    $result_s = mysqli_query($connection, $update_s);

    // update skillset
    /*$s_skillset = "SELECT * FROM skillset WHERE username = '$username'";
    $result_s_skillset = mysqli_query($connection, $result_s_skillset);*/
    $clear_skillset = "DELETE FROM skillsets WHERE theJobSeeker = $userID";
    $result_clear_skillset = mysqli_query($connection, $clear_skillset);

    // Based on skillName, find user selected skills in skill table
    foreach ($skillset as $skillName) {
      $selected_skills = "SELECT * FROM skill WHERE skillName = '$skillName'";
      $result_selected_skills = mysqli_query($connection, $selected_skills);

      while ($row_selected_skills = mysqli_fetch_assoc($result_selected_skills)) {
        $skillID = $row_selected_skills['skillID'];
        $add_skillset = "INSERT INTO skillsets VALUES('$skillID', $userID)";
        $result_add_skillset = mysqli_query($connection, $add_skillset);
      }
    }

    if ($result_user && $result_s && $result_add_skillset) {
      echo "<script>alert('Update job seeker profile successful.');</script>";
      header("Refresh: 1; url= profile.php");
    } else {
      echo "<script>alert('Unable to update job seeker profile.');</script>";
      header("Refresh: 1; url= profile.php");
    }


  } else if ($_SESSION['userType'] == 'Client') {
    // client attributes
    $companyName = stripcslashes($_POST['CcompanyName']);
    $companyDesc = stripcslashes($_POST['CcompanyDescription']);

    $companyName = mysqli_real_escape_string($connection, $companyName);
    $companyDesc = mysqli_real_escape_string($connection, $companyDesc);

    // update client attributes
    $update_c = "UPDATE client SET companyName = '$companyName', companyDescription = '$companyDesc' WHERE userID = $userID";
    $result_c = mysqli_query($connection, $update_c);

    if ($result_user && $result_c) {
       echo "<script>alert('Update client profile successful.');</script>";
       header("Refresh: 1; url= profile.php");
     } else {
       echo "<script>alert('Unable to update client profile.');</script>";
       header("Refresh: 1; url= profile.php");
     }

  }


  mysqli_close($connection);
?>

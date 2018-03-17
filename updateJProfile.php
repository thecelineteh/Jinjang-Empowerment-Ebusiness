<?php
  session_start();
  include 'dbConnection.php';

  $userID = $_SESSION['userID'];
  $username = mysqli_real_escape_string($connection, $_SESSION['userName']);

  $password = stripcslashes($_POST['Spassword']);
  $fullName = stripcslashes($_POST['Sfullname']);
  $email = stripcslashes($_POST['Semail']);
  $phone = stripcslashes($_POST['Sphone']);
  $address = stripcslashes($_POST['Saddress']);
  $fullName = stripcslashes($_POST['Sfullname']);
  $skillset = $_POST['sSkillSet'];

  $password = mysqli_real_escape_string($connection, $password);
  $email = mysqli_real_escape_string($connection, $email);
  $phone = mysqli_real_escape_string($connection, $phone);
  $address = mysqli_real_escape_string($connection, $address);
  $fullName = mysqli_real_escape_string($connection, $fullName);

  // update user attributes
  $update_user = "UPDATE user SET password = '$password', address = '$address', phoneNo='$phone', email = '$email' WHERE username = '$username'";
  $result_user = mysqli_query($connection, $update_user);

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
    echo "<script>alert('Update profile successful.');</script>";
    header("Refresh: 1; url= profile.php");
  } else {
    echo "<script>alert('Unable to update profile.');</script>";
    header("Refresh: 1; url= profile.php");
  }

  mysqli_close($connection);
?>

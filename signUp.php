<?php
  session_start();
  include 'dbConnection.php';

  $userType = $_POST['userType'];
  $userName = stripcslashes($_POST['username']);
  $password = stripcslashes($_POST['password']);
  $fullName = $_POST['fullName'];
  $email = $_POST['email'];
  $phoneNo = $_POST['phone'];
  $skill_weave = $_POST['chk_weave'];
  $skill_knit = $_POST['chk_knit'];
  $skill_bake = $_POST['chk_bake'];

  // check if username already exists in user table
  $query_username_exists = "SELECT * FROM user WHERE username = '$userName'";
  $result = mysqli_query($connection, $query_username_exists);
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) > 0)
   {
     echo "This username has been taken. Please choose another username.";
   }
   else {
      // Add record
      $query_registerS = "INSERT INTO  user (username,password,fullName,email,phoneNo) VALUES ('$username','$password','$fullName','$email','$phoneNo')";
      //result
      $result_registerS = mysqli_query($connection, $query_registerS);
      //print output
      if ($result_registerS) {
        echo "Job Seeker ".$username. " successfully registered.<br>";
        echo "Redirecting back to login page...";
        header("Refresh: 5; url= index.php");
      }
      else {
         echo "Error adding job seeker : " . mysqli_error($connection);
         mysqli_error($connection);
       }
   }

   mysqli_close($connection);
 ?>

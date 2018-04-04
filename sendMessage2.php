<?php
  session_start();
  include 'dbConnection.php';
  $sender = $_SESSION['userID'];
  $receiver = $_POST['receiverName'];
  $subject = $_POST['subject'];
  $content = $_POST['content'];
  //$query = "SELECT * FROM user WHERE username = '$userName' and
          //password = '$password'";
  $query = "INSERT INTO message VALUES (NULL, '$subject', '$content', NULL,
    '$sender', 2)";
  $result = mysqli_query($connection, $query);
  header("Location: message.php");
 ?>

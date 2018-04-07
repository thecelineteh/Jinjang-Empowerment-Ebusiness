<?php
  session_start();
  include 'dbConnection.php';

  $messageID = $_POST['messageID'];

  $query = "DELETE FROM message where messageID = '$messageID'";
  $result2 = mysqli_query($connection, $query);

  header('Location: message.php')
?>

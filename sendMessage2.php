<?php
  session_start();
  include 'dbConnection.php';
  $sender = $_SESSION['userID'];
  $receiver = $_POST['receiverName'];
  $subject = $_POST['subject'];
  $content = $_POST['content'];
  $receiverID = "unknown";

  $query = "SELECT * FROM client WHERE companyName='$receiver'";
  $result = mysqli_query($connection, $query);

  $query2 = "SELECT * FROM jobseeker WHERE fullName='$receiver'";
  $result2 = mysqli_query($connection, $query2);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $receiverID = $row['userID'];
    }
  }
  else if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
      $receiverID = $row2['userID'];
    }
  }

  $query3 = "INSERT INTO message VALUES (NULL, '$subject', '$content', NULL,
    '$sender', '$receiverID')";
  $result3 = mysqli_query($connection, $query3);
  echo "<script>window.close();</script>"
 ?>

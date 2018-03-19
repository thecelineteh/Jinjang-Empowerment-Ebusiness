<?php
  if (isset($_SESSION['searchValue'])) {
    unset($_SESSION['searchValue']);
  }
  echo "<script>alert('" . $_SESSION['searchValue'] . "')</script>";
  header("Location: jobs.php");
?>

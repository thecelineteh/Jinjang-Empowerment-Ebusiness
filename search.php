<?php
session_start();
$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "jee";
$connection = new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

if (isset($_POST['search'])) {
  $searchValue = $_POST['search'];
}
else {
  $searchValue = "allJobs";
}

$_SESSION['searchValue'] = strtolower($searchValue);
echo $_SESSION['searchValue'];
header('Location: jobs.php');
 ?>

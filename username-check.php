<?php

  $host="localhost";
  $user="root";
  $pass="";
  $dbname="jee";

  $dbcon = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);

  if($_POST)
  {
      $name     = strip_tags($_POST['receiverName']);

	  $stmt=$dbcon->prepare("SELECT username FROM user WHERE username=:name");
	  $stmt->execute(array(':name'=>$name));
	  $count=$stmt->rowCount();

	  if($count>0)
	  {
	  }
	  else
	  {
		  echo "<span style='color:white; text-align:center; font-size:1em;'>There is no such user!</span>";
	  }
  }
?>

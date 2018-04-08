<?php

  $host="localhost";
  $user="root";
  $pass="";
  $dbname="jee";

  $dbcon = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);

  if($_POST)
  {
      $name     = strip_tags($_POST['receiverName']);


	  $stmt=$dbcon->prepare("SELECT fullName FROM jobseeker WHERE fullName=:name");
	  $stmt->execute(array(':name'=>$name));
	  $count=$stmt->rowCount();

		$stmt2=$dbcon->prepare("SELECT companyName FROM client WHERE companyName=:name");
	  $stmt2->execute(array(':name'=>$name));
	  $count2=$stmt2->rowCount();

	  if($count>0 || $count2>0)
	  {
	  }
	  else
	  {
		  echo "<span style='color:white; text-align:center; font-size:1em;'>There is no such user!</span>";
	  }
  }
?>

<?php
	session_start();
	include 'dbConnection.php';

	$userName = $_SESSION['userName'];

	$query = "SELECT * FROM user WHERE username = '$userName'";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);

	$query_S = "SELECT * FROM jobseeker WHERE username = '$userName'";
	$result_S = mysqli_query($connection, $query_S);
	$row_S = mysqli_fetch_assoc($result_S);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>My Profile</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

	<!-- Magnific Popup -->
	<link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		* {
			margin: 0;
			padding: 0;
		}
		.navbar{
			border-radius: 0;
			margin: 0;
		}
		.navbar-brand {
			font-size: 25px;
		}
		.profile-img{
			margin-top: -5px;
			margin-right: 5px;
			float: left;
			background: url(img/person-flat.png) 50% 50% no-repeat; /* 50% 50% centers image in div */
			background-size: auto 100%; /* Interchange this value depending on prefering width vs. height */
			width: 30px;
			height: 30px;
			}
		#background{
			background-color: #677077;
			background-image: url(img/picture1.jpg);
			background-size: cover;
			height: 30em;
		}
		@media (max-width: 767px){
			#background{
				height: 30em;
			}
		}
		.middle {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				text-align: center;
		}
		.card {
				/* Add shadows to create the "card" effect */
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
				transition: 0.3s;
				padding: 20px;
		background-color: white;
		}
		</style>
</head>
<body style="background-color: #F4F4F4;">
<script src = "js/fileUpload.js"></script>
	<!-- Nav -->
	<nav id="nav" class="navbar">
		<div class="container">

			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
					<a href="index.html">
						<img class="logo" src="img/logo.png" alt="logo">
						<img class="logo-alt" src="img/logo-alt.png" alt="logo">
					</a>
				</div>
				<!-- /Logo -->

				<!-- Collapse nav button -->
				<div class="nav-collapse">
					<span></span>
				</div>
				<!-- /Collapse nav button -->
			</div>

			<!--  Main navigation  -->
			<ul class="main-nav nav navbar-nav navbar-right">
				<li><a href="#home"><i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li><a href="#profile"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="#message"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li><a href="#application"><i class="fa fa-suitcase"></i>&nbsp;Application</a></li>
				<li><a href="index.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>
			<!-- /Main navigation -->

		</div>
	</nav>
	<!-- /Nav -->
	<form action="updateJProfile.php" method="post">
	<div style = "margin: 0; padding: 0;">
		<div class = "container-fluid">
			<div class = "row">
				<div class = "col-sm-12 col-xs-12" style = "padding:0;">
					<div id = "background">
						<div class = "row" style = "margin: 0;">
							<div class="middle">
								<h2 style="margin:0; color:white;">Edit Profile</h2><br />
								<div id="dvPreview">
                    <img src="img/person-flat.png" height=200 width=200 alt="profile-img"/>
                </div><br />
								<label class="btn btn-default btn-file">
										Browse <input id="fileupload" type="file" style="display: none;">
								</label>
							</div>
					</div>
				</div>
			</div>
		</div><br /><br />

		</div>
	</div>

	<div class = "container">
		<div class="container" style="max-width:500px;">
			<div class="row">
				<div class="col-xs-12">
					<div class ="card">
						<br>
						  <div class = "form-group">
						    <label for = "Susername">Username:</label>
						    <?php
						      echo "<h4>" . $row['username'] . "</h4>";
						    ?>
						  </div>
						        <br>
						  <div class = "form-group">
						    <label for = "Spassword">Password:</label>
						    <?php
						      echo "<input type='password' class='form-control' id='Spassword'
						        name='Spassword' value='" .
						        $row['password'] . "' required>";
						    ?>
						  </div>
						        <br>
						  <div class = "form-group">
						    <label for = "Sfullname">Full Name:</label>
						      <?php
						        echo "<input type = 'text' class = 'form-control' id = 'Sfullname' name = 'Sfullname' value='" . $row_S['fullName'] . "' required>";
						      ?>
						  </div>
						  <br>
						  <div class = "form-group">
						    <label for = "Semail">Email:</label>
						      <?php
						        echo "<input type = 'email' class = 'form-control' id = 'Semail' name = 'Semail' value='" . $row['email'] . "' required>";
						      ?>
						  </div>
						  <br>
						  <div class = "form-group">
						    <label for = "Sphone">Phone No:</label>
						      <?php
						        echo "<input type = 'text' class = 'form-control' id = 'Sphone' name = 'Sphone' value='" . $row['phoneNo'] . "' required>";
						      ?>
						  </div>
						  <br>
						  <div class="form-group">
						    <label for = "Saddress">Address:</label>
						      <?php
						        echo "<textarea name='Saddress' rows='4' cols='50' required>" . $row['address'] . "</textarea>";
						      ?>
						  </div>
						  <br>
							<div class="form-group">
						    <label for = "SskillSet">Skill Sets:</label>
									<div class="checkbox">
										<?php
										/*
											$query_skills = "SELECT * FROM skill";
											$result_skills = mysqli_query($connection, $query_skills);

											while($row_skills = mysqli_fetch_assoc($result_skills)) {
												$skills_array = array();
												array_push($skills_array, $row_skills['skillName']);
											}
											*/


// find all skillset of this job seeker
											$query_skillset = "SELECT * FROM skillset ss, skill s WHERE username = '$userName' AND ss.skillID = s.skillID";
											$result_skillset = mysqli_query($connection, $query_skillset);

// skillset array
											// store all selected skills in array
											while($row_skillset = mysqli_fetch_assoc($result_skillset)) {
												$skillset_array = array();
												array_push($skillset_array, $row_skillset['skillName']);
											}

// skills array
											while ($row_skill)
											foreach ($skillset_array as $s_skill) {
												foreach ($skills_array as $aSkill) {
													if ($s_skill == $aSkill) {
														echo "<label><input type='checkbox' name='sSkillSet[]' class='checkbox' value='" . $aSkill . "' checked>" . $aSkill. "</label><br>";
													} else {
														echo "<label><input type='checkbox' name='sSkillSet[]' class='checkbox' value='" . $aSkill . "'>" . $aSkill. "</label><br>";
													}
												}
											}
foreach ( $skillset_array as $ss) {
	echo $ss;
}
foreach ( $skills_array as $s) {
	echo $s;
}
											//$notSelectedSkills = explode(',', $skillset_array);
// all skills not selected
											$query_notSelected_skills = "SELECT * FROM skill WHERE skillName NOT IN($notSelectedSkills)";





/*
											while($row_skillset = mysqli_fetch_assoc($result_skillset)){
												//while($row_skills = mysqli_fetch_assoc($result_skills)) {
													//if($row_skillset['skillID'] == $row_skills['skillID']){
														echo "<label><input type='checkbox' name='sSkillSet[]' class='checkbox' value='" . $row_skillset['skillName'] . "' checked>" . $row_skillset['skillName']. "</label><br>";
													//} else {

														echo "<label><input type='checkbox' name='sSkillSet[]' class='checkbox' value='" . $row_skillset['skillName'] . "'>" . $row_skillset['skillName']. "</label><br>";
													}

												//}
											//}
											*/
											?>
								</div>
						  </div>
							<br>
						  <div style="text-align:center;">
						    <input type="submit" class="btn btn-default" value="Update"></input>
						  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
	<br>
	<script>
	$(function () {
		 $("#fileupload").change(function () {
			 if (typeof (FileReader) != "undefined") {
				 var dvPreview = $("#dvPreview");
				 dvPreview.html("");
				 var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
				 $($(this)[0].files).each(function () {
					 var file = $(this);
					 if (regex.test(file[0].name.toLowerCase())) {
						 var reader = new FileReader();
						 reader.onload = function (e) {
							 var img = $("<img />");
							 img.attr("style", "height:200px;width: 200px; border-radius: 50%;");
							 img.attr("src", e.target.result);
							 dvPreview.append(img);
						 }
						 reader.readAsDataURL(file[0]);
					 } else {
						 alert(file[0].name + " is not a valid image file.");
						 dvPreview.html("<img src=img/person-flat.png height=200px width=200px/>");
						 return false;
					 }
				 });
			 } else {
				 alert("This browser does not support HTML5 FileReader.");
			 }
		 });
	});
	</script>

	<!-- Back to top -->
	<div id="back-to-top"></div>
	<!-- /Back to top -->

	<!-- Preloader -->
	<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<!-- /Preloader -->

	<!-- jQuery Plugins -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>

<?php
	session_start();
	include 'dbConnection.php';

	$userID = $_SESSION['userID'];
	$userName = $_SESSION['userName'];

?>
<!DOCTYPE>
<html>
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

	<!-- Custom stylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		.footer-follow li a i{
		  display: inline-block;
		  width: 50px;
		  height: 50px;
		  line-height: 50px;
		  text-align: center;
		  border-radius: 3px;
		  background-color: #6195FF;
		  color:#FFF;
		}

    .bg-img .overlay2 {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        opacity: .8;
        background: #181818;
    }

    input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="date"], input[type="url"], input[type="tel"], textarea {
      border-radius: 3px;
			border-color: black;
			background-color: #DCDCDC;
    }

		.checkbox {
			margin-left: 20px;
		}

		label {
			color: black;
		}

    .form-title {
      font-family: "Britannic Bold";
      color: black;
      font-size: 25pt;
      margin-top: 30px;
      margin-bottom: 40px;
    }
    .form-control-big {
      width: 90%;
    }
    .form-control-small {
      width:40%;
    }

    .white-btn {
      margin-right:50px;
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
<body style="background-color: #ecf0f1;">
	<!-- Nav -->
	<nav id="nav" class="navbar">
		<div class="container">

			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
					<a href="index.php">
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
				<li>
				<?php
					if ($_SESSION['userType'] == 'Job Seeker') {
						echo '<a href="jobs.php">';
					} else if ($_SESSION['userType'] == 'Client') {
						echo '<a href="jobPositions.php">';
					}
				 ?>
				<i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li class="active"><a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="message.php"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li><a href="jobApplications.php"><i class="fa fa-suitcase"></i>&nbsp;Applications</a></li>
				<li><a href="index.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>
			<!-- /Main navigation -->

		</div>
	</nav>
	<!-- /Nav -->
	<form action="updateProfile.php" method="post">
	<div class = "container-fluid">
		<div class = "row">
			<div class = "col-sm-12 col-xs-12" style = "padding:0;">
				<div id = "background">
					<div class = "row" style = "margin: 30px;">
						<div class="middle">
							<div class="bg-img" style="background-image: url('./img/picture1.jpg');">
                <div class="overlay2">
                </div>
              </div>
							<div class="row">
                <div class="col-sm-offset-3 col-sm-6 col-xs-12">
									<div class ="card">
										<h2 style="margin:0; color:	#696969;">Edit Profile</h2><br />

										  <div class = "form-group">
										    <label for = "Susername">Username:</label>
										    <?php
													$query = "SELECT * FROM user WHERE username = '$userName'";
													$result = mysqli_query($connection, $query);
													$row = mysqli_fetch_assoc($result);

													// job seeker
													$query_S = "SELECT * FROM jobseeker WHERE userID = $userID";
													$result_S = mysqli_query($connection, $query_S);
													$row_S = mysqli_fetch_assoc($result_S);

													// client
													$query_C = "SELECT * FROM client WHERE userID = $userID";
													$result_C = mysqli_query($connection, $query_C);
													$row_C = mysqli_fetch_assoc($result_C);


										      echo "<h4>" . $row['username'] . "</h4>";
										    ?>
										  </div>
										        <br>
										  <div class = "form-group">
										    <label for = "password">Password:</label>
										    <?php
										      echo "<input type='password' class='form-control' id='password'
										        name='password' value='" .
										        $row['password'] . "' required>";
										    ?>
										  </div>
										        <br>

										      <?php
														if ($row['userType'] == 'Job Seeker') {
											        echo "<div class = 'form-group'>
														    <label for = 'Sfullname'>Full Name:</label>
																<input type = 'text' class = 'form-control' id = 'Sfullname' name = 'Sfullname' value='" . $row_S['fullName'] . "' required>
																</div>
					 										  <br>";
															}

															if ($row['userType'] == 'Client') {
																echo "<div class = 'form-group'>
															    <label for = 'CcompanyName'>Company Name:</label>
																	<input type = 'text' class = 'form-control' id = 'CcompanyName' name = 'CcompanyName' value='" . $row_C['companyName'] . "' required>
																	</div>
						 										  <br>";

																echo "<div class = 'form-group'>
															    <label for = 'CcompanyDescription'>Company Description:</label>
																	<textarea name='CcompanyDescription' rows='4' cols='50' required>" . $row_C['companyDescription'] . "</textarea>
																	</div>
						 										  <br>";
															}
										      ?>

										  <div class = "form-group">
										    <label for = "email">Email:</label>
										      <?php
										        echo "<input type = 'email' class = 'form-control' id = 'email' name = 'email' value='" . $row['email'] . "' required>";
										      ?>
										  </div>
										  <br>
										  <div class = "form-group">
										    <label for = "phone">Phone No:</label>
										      <?php
										        echo "<input type = 'text' class = 'form-control' id = 'phone' name = 'phone' value='" . $row['phoneNo'] . "' required>";
										      ?>
										  </div>
										  <br>
										  <div class="form-group">
										    <label for = "address">Address:</label>
										      <?php
										        echo "<textarea name='address' rows='4' cols='50' required>" . $row['address'] . "</textarea>";
										      ?>
										  </div>
										  <br>
											<?php
													if ($row['userType'] == 'Job Seeker') {
														echo "<div class='form-group'>
													    <label for = 'SskillSet'>Skill Sets:</label>
																<div class='checkbox'>";

																$useriD = $_SESSION['userID'];
																$query = "SELECT * FROM skillsets ss, skill s where theJobSeeker = $userID AND ss.skillID = s.skillID";
																$result = mysqli_query($connection, $query);
																$skill = array();
																if (mysqli_num_rows($result) > 0) {
																	while ($row = mysqli_fetch_assoc($result)) {
																		$skillName = $row['skillName'];
																		array_push($skill, $skillName);
																	}
																}

																$check = false;
																$updateSkill = array();
																$query = "SELECT * FROM skill";
																$result = mysqli_query($connection, $query);
																if (mysqli_num_rows($result) > 0) {
																	while ($row = mysqli_fetch_assoc($result)) {
																		$skillName = $row['skillName'];
																		for ($i = 0; $i < count($skill); $i++ ) {
																			$check = false;
																			if ($skillName == $skill[$i]) {
																				$check = true;
																				break;
																			}
																		}
																		if ($check) {
																			echo "<input type='checkbox' class='checkbox' name='updateSkillArray[]' value='" . $skillName . "' checked>" . $skillName . "<br>";
																		}
																		else {
																			echo "<input type='checkbox' class='checkbox' name='updateSkillArray[]' value='" . $skillName . "'>" . $skillName . "<br>";

																		}
																	}
																}

														}
														echo "</div> <br>";
														?>
														<div style="text-align:center;">
															<input type="submit" class="btn btn-default" value="Update"></input>
														</div>
										  </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<!-- Footer -->
	<footer id="footer" class="sm-padding bg-dark">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<div class="col-md-12">

					<!-- footer logo -->
					<div class="footer-logo">
						<a href="index.php"><img src="img/logo-alt.png" alt="logo"></a>
					</div>
					<!-- /footer logo -->

					<!-- footer follow -->
					<ul class="footer-follow">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-youtube"></i></a></li>
					</ul>
					<!-- /footer follow -->

					<!-- footer copyright -->
					<div class="footer-copyright">
						<p>Copyright © <?php echo date("Y");?> AGN. All Rights Reserved.</p>
					</div>
					<!-- /footer copyright -->

				</div>

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</footer>
	<!-- /Footer -->

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

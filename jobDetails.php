<?php
  session_start();
	include 'dbConnection.php';

	if (isset($_SESSION['apply']) && $_SESSION['apply']=="success")  {
		echo "<script>alert('Thanks For Your Application!" .
			" Your application has been sent!');</script>";
		$_POST['jobID'] = $_SESSION['jobID'];
	}
	else if (isset($_SESSION['apply']) && $_SESSION['apply']=="failed") {
		echo "<script>alert('You have applied for this job before!');</script>";
		$_POST['jobID'] = $_SESSION['jobID'];
	}
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Job Details</title>

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

	.center {
    height: 70%;
    position: relative;
	}

	.center h1 {
	    margin: 0;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    -ms-transform: translate(-50%, -50%);
	    transform: translate(-50%, -50%);
	}
	</style>
</head>
<body style="background-color: ecf0f1;">
	<!-- Nav -->
	<nav id="nav" class="navbar">
		<div class="container">

			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
          <?php
  					if ($_SESSION['userType'] == 'Job Seeker') {
  						echo '<a href="jobs.php">';
  					} else if ($_SESSION['userType'] == 'Client') {
  						echo '<a href="jobPositions.php">';
  					}
  				 ?>
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
				<li><?php
					if ($_SESSION['userType'] == 'Job Seeker') {
						echo '<a href="jobs.php">';
					} else if ($_SESSION['userType'] == 'Client') {
						echo '<a href="jobPositions.php">';
					}
				 ?><i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li><a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="message.php"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li><a href="jobApplications.php"><i class="fa fa-suitcase"></i>&nbsp;Application</a></li>
				<li><a href="index.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>
			<!-- /Main navigation -->

		</div>
	</nav>
	<!-- /Nav -->
	<!-- JobTitle background -->
	<div id="numbers" class="section sm-padding">
		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('./img/background2.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->
		<!-- Container -->
		<div class="container">
			<!-- Row -->
			<div class="row">
				<!-- job title -->
				<div style="height: 15%;" class="col-sm-12 col-xs-6 center">
					<?php
						$jobID = $_POST['jobID'];
						$query = "SELECT * FROM jobposition WHERE jobID='$jobID'";
						$result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<h1 style='color:white;'>" . $row['title'] . "</h1>";
							}
						}
					?>
				</div>
				<!-- /job title -->
			</div>
			<!-- /Row -->
		</div>
		<!-- /Container -->

	</div>
	<!-- /JobTitle background -->
	<!-- Job Description -->
	<div class="container">
		<div class="row" style="margin-bottom: 5em; margin-top: 2em">
			<div class="col-sm-6 col-xs-12" style="background-color: white; border: 1em solid #ecf0f1;">
				<div class="row" style="margin:2em;">
					<div class="col-sm-12">
						<div class="section-header" style="margin:1em;">
							<h4><i class="fa fa-newspaper-o"></i>&nbsp;JOB DESCRIPTION</h4>
						</div>
						<div>
							<ul style="margin-left:1em;">
								<?php
								$jobID = $_POST['jobID'];
								$query = "SELECT * FROM jobposition WHERE jobID='$jobID'";
								$result = mysqli_query($connection, $query);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										echo "<p style='text-align: justify'>". $row['description'] . "</p>";
									}
								}
								?>
							</ul><br /><br />
						</div>
					</div>
					<div class="col-sm-12" >
						<div class="section-header" style="margin:1em;">
							<h4><i class="fa fa-briefcase"></i>&nbsp;JOB DETAILS</h4>
						</div>
						<div>
							<ul style="margin-left:1em;">
								<?php
                $jobID = $_POST['jobID'];
                $query2 = "SELECT skill.skillName FROM jobrequiredskill, skill WHERE jobID = '$jobID'
    											AND jobrequiredskill.skillID=skill.skillID";
    						$result2 = mysqli_query($connection, $query2);

    						if (mysqli_num_rows($result2) > 0) {
    							echo "Skills Required: ";
    							$counter = 0;
    							while ($row = mysqli_fetch_assoc($result2)) {
    								$counter += 1;
    								echo "
    								<li>&nbsp;<i class='fa fa-check-circle' style='font-size:18px;color:green'></i>&nbsp;&nbsp;&nbsp;" . $row['skillName'] . "</li>
    								";
    							}
    						}

                echo "<br>";

								$query = "SELECT * FROM jobposition WHERE jobID='$jobID'";
								$result = mysqli_query($connection, $query);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
                    $startDate = $row['startDate'];
                    $endDate = $row['endDate'];
                    $startTime = $row['startTime'];
                    $endTime = $row['endTime'];

                    // convert startDate format
                    $startDateDisplay = date("j M Y", strtotime($startDate));
                    // convert endDate format
                    $endDateDisplay = date("j M Y", strtotime($endDate));
                    // convert startTime format
                    $startTimeDisplay = date('g:i A', strtotime($startTime));
                    // convert endTime format
                    $endTimeDisplay = date('g:i A', strtotime($endTime));

                    echo '<li>
                      <i class="fa fa-calendar-check-o"></i>&nbsp;Start date: '. $startDateDisplay .'
                      <br>
                      <i class="fa fa-calendar-check-o"></i>&nbsp;End date: '. $endDateDisplay .'
                    </li>
                    <li>
                      <i class="fa fa-clock-o"></i>&nbsp;Start time: '. $startTimeDisplay .'
                      <br>
                      <i class="fa fa-clock-o"></i>&nbsp;End time: '. $endTimeDisplay .'
                    </li>
                    <br>';

										$totalSalary = $row['salaryPerHour'];
										echo "<li>Salary per hour:&nbsp;&nbsp;RM";
										echo $totalSalary;
										echo "</li>";

										echo "<li>City:&nbsp;&nbsp;";
										echo $row['city'];
										echo "</li><br />";

										echo "<li>Address:<br />";
										echo $row['address'];
										echo "</li>";
									}
								}
								?>
							</ul><br />
							<div style="text-align:center;">
								<form action="applyJob.php" method="post">
                  <?php
                    $jobID = $_POST['jobID'];
                    echo "<input type='hidden' value='$jobID' name='jobID'/>";
                  ?>
									<input class="main-btn" type="submit" value="Apply">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12" style="background-color: white; border: 1em solid #ecf0f1;">
				<div class="row">
					<div class="col-sm-12">
						<div style="margin:2em;">
							<div class="section-header" style="margin:1em;">
								<h4><i class="fa fa-building"></i>&nbsp;COMPANY DETAILS</h4>
							</div>
							<div>
								<ul style="margin-left:1em;">
									<?php
									$jobID = $_POST['jobID'];
									$query = "SELECT * FROM jobposition, user, client
														WHERE jobID='$jobID'
														AND jobposition.theClient = user.userID
														AND user.userID = client.userID";
									$result = mysqli_query($connection, $query);
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
											$_SESSION['companyName'] = $row['companyName'];

											echo "<li style='text-align: center;'><h5>";
											echo $row['companyName'];
											echo "</h5></li>";

											echo "<li>Phone No:&nbsp;&nbsp;";
											echo $row['phoneNo'];
											echo "</li>";

											echo "<li>Email:&nbsp;&nbsp;";
											echo $row['email'];
											echo "</li><br />";

											echo "<li>Company Description:<br />";
											echo $row['companyDescription'];
											echo "</li><br />";

											echo "<li>Address:<br />";
											echo $row['address'];
											echo "</li>";
										}
									}
									?>
								</ul><br />
								<div style="text-align:center;">
									<form action="sendMessage.php" method="post">
										<?php
											echo "
											<input type='hidden' value='" . $_SESSION['companyName']
											. "' name='senderName'>";
										?>
										<input class="main-btn" type="submit" value="message">
									</form>
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
            <?php
    					if ($_SESSION['userType'] == 'Job Seeker') {
    						echo '<a href="jobs.php">';
    					} else if ($_SESSION['userType'] == 'Client') {
    						echo '<a href="jobPositions.php">';
    					}
    				 ?>
             <img src="img/logo-alt.png" alt="logo"></a>
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
						<p>Copyright © <?php echo date("Y");?> AGN. All Rights Reserved. Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
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
	<?php
		if (isset($_SESSION['apply']) && $_SESSION['apply']=="success")  {
			unset($_SESSION['apply']);
		}
		else if (isset($_SESSION['apply']) && $_SESSION['apply']=="failed") {
			unset($_SESSION['apply']);
		}
		else {
			echo "
			<!-- Preloader -->
			<div id='preloader'>
				<div class='preloader'>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
			<!-- /Preloader -->
			";
		}
	?>


	<!-- jQuery Plugins -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>

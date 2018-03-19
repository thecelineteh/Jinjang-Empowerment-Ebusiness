<?php
session_start();
include 'dbConnection.php';
if (isset($_POST['skill'])) {
	$_SESSION['searchValue'] = "filter";
}
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Search Job</title>

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
  <link type="text/css" rel="stylesheet" href="css/style2.css" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
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
	@media (max-width: 575.98px) {
		.sButton {
			position: relative;
			margin-left: 2.45em;
			margin-top: 1em;
		}
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
					<a href="jobs.html">
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
				<li class="active"><a href="#home"><i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li><a href="profile2.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="#message"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li><a href="#application"><i class="fa fa-suitcase"></i>&nbsp;Application</a></li>
				<li><a href="index.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>
			<!-- /Main navigation -->

		</div>
	</nav>
	<!-- /Nav -->
	<!-- Search Bar -->
	<div class="container" style="padding-top: 2em; padding-bottom: 0.5em;">
			<div class="row">
				<form style="width: 100%;" action="search.php" method="post">
					<div class="col-sm-offset-2 col-sm-7 col-xs-offset-1 col-xs-10" style="padding:0; margin:0 position:relative;">
	  				<input class="search" type="text" name="search" placeholder="Search..">
	  			</div>
	  			<div class="col-sm-1 col-xs-10" style="padding:0; margin:0;">
	  				<input class="button sButton" type="submit" value="Search">
	  			</div>
				</form>
			</div>

			<div class="row">
				<form id="theform" action="jobs.php" method="post">
					<div class="col-sm-offset-10 col-xs-12" style="padding-top: 2em">
						Filter By:
						<select id="mySelect" name="skill" size="1" onchange="this.form.submit()">
							<option value="default">
								Default
							</option>
							<?php
								$query = "SELECT * FROM skill";
								$result = mysqli_query($connection, $query);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										if (isset($_POST['skill']) &&
												$_POST['skill'] == $row['skillName']) {
													echo "<option selected='selected' value='" . $row['skillName'] . "'>" .
													$row['skillName'] . "</option>";
										}
										else {
											echo "<option value='" . $row['skillName'] . "'>" .
											$row['skillName'] . "</option>";
										}
									}
								}
							 ?>
					  </select>
					</div>
				</form>
			</div>

	</div>


		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">
				<!-- pricing -->
				<?php
				if (!isset($_SESSION['searchValue']) || $_SESSION['searchValue'] == "allJobs") {
					$query = "SELECT * FROM jobposition WHERE status='AVAILABLE'";
				}
				else if (isset($_SESSION['searchValue']) && $_SESSION['searchValue'] != "filter"){
					$searchValue = $_SESSION["searchValue"];
					$query = "SELECT * FROM jobposition WHERE title LIKE '%$searchValue%'
										AND status='AVAILABLE'";
				}
				else if (!isset($_POST['skill']) || $_POST['skill'] == "default") {
					$query = "SELECT * FROM jobposition WHERE status='AVAILABLE'";
				}
				else if (isset($_POST['skill']) && $_POST['skill'] != "Default") {
					$skillFilter = $_POST['skill'];
					$query = "SELECT * FROM jobposition, jobrequiredskill, skill
									WHERE status='AVAILABLE'
									AND jobposition.jobID = jobrequiredskill.jobID
									AND jobrequiredskill.skillID = skill.skillID
									AND skillName='$skillFilter'";
				}
				$result = mysqli_query($connection, $query);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
            $totalSalary = $row['salaryPerHour'] * $row['hoursPerWeek'] * $row['durationInWeeks'];
						$jobID = $row['jobID'];
						$query2 = "SELECT skill.skillName FROM jobrequiredskill, skill WHERE jobID = '$jobID'
											AND jobrequiredskill.skillID=skill.skillID";
						$result2 = mysqli_query($connection, $query2);
						echo "
            <div class='col-sm-3'>
              <div class='pricing'>
                <div class='price-head'>
						";
						echo
                  "<span class='price-title'>" .
									$row['title'] . "</span>"
					  ;
						echo "
                  <div class='price'>
                    <h3>$" . $totalSalary . "</h3>
                  </div> ";
						$link='"jobDetails.php"';
						echo "
                </div>
                <ul class='price-content'>";

						if (mysqli_num_rows($result2) > 0) {
							echo "Skills Required: ";
							$counter = 0;
							while ($row = mysqli_fetch_assoc($result2)) {
								$counter += 1;
								echo "
								<li>" . $row['skillName'] . "</li>
								";
							}
							$rowPrint = 4 - $counter;
							for ($i = 0; $i <= $rowPrint; $i++) {
								echo "<br />";
							}
						}
						else {
							echo "No skills required";
							for ($i = 0; $i <= 5; $i++) {
								echo "<br />";
							}
						}
            echo "<div class='price-btn'>
									<form action='jobDetails.php' method='post'  target='_blank'>
										<input type=hidden name='jobID' value='" . $jobID .
										"'>
										<input class='outline-btn' type='submit' value='Details'>
									</form>
                </div>
              </div>
            </div>
						";
					}
				}
				else {
					echo "<div class='center'>";
					echo "<h1>No Results Found!</h1>";
					echo "</div>";
				}
				 ?>
				<!-- /pricing -->
			</div>
			<!-- Row -->

		</div>
		<!-- /Container -->
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
						<p>Copyright © 2017 AGN. All Rights Reserved. Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
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
	<script>

</body>
</html>

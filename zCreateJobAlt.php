<?php
  session_start();
  include 'dbConnection.php';
 ?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Create New Job</title>

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
    }

    label {
      color: #F8F8F8;
    }
    .form-title {
      font-family: "Britannic Bold";
      color: #F8F8F8;
      font-size: 25pt;
      margin-top: 20px;
      margin-bottom: 40px;
    }
    .form-control-big {
      width: 90%;
    }
    .form-control-small {
      width:40%;
    }

    .white-btn {
      background-color: #F8F8FF;
      opacity: 0.8;
    }

    .main-btn {
      margin-right:50px;
      background-color: #0073e6;
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
				<li><a href="jobPositions.php"><i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li><a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="#message"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li><a href="#application"><i class="fa fa-suitcase"></i>&nbsp;Applications</a></li>
				<li><a href="index.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>
			<!-- /Main navigation -->

		</div>
	</nav>
	<!-- /Nav -->

	<div class = "container-fluid">
		<div class = "row">
			<div class = "col-sm-12 col-xs-12" style = "padding:0;">
				<div id = "background">
					<div class = "row" style = "margin: 20px;">
						<div class="middle">
							<div class="bg-img" style="background-image: url('./img/bg-createJob.jpg');">
                <div class="overlay2">
                </div>
              </div>
              <form name="postJobForm" action="storeJob.php" method="post">
                <div class="row">
                  <div class="col-sm-offset-3 col-sm-6">
                    <h4 class="form-title">Create Job Position</h4>
                    <div class="form-group">
                      <label>Job Title: </label>
                      <div class="form-control-big">
                        <input type="text" name="jobTitle" class="form-control" required>
                      </div>
                      <div id="jobTitle_error" style="color:red;"></div>
                    </div>

                    <div class="form-group">
                      <label>Job Description: </label>
                      <div class="form-control-big">
                        <textarea name='jobDescription' rows='6' cols='50' required></textarea>
                      </div>
                      <div id="jobDescription_error" style="color:red;"></div>
                    </div>

                    <div class="form-group">
                      <label>Address: </label>
                      <div class="form-control-big">
                        <textarea name='jobAddress' rows='4' cols='50' required></textarea>
                      </div>
                      <div id="jobAddress_error" style="color:red;"></div>
                    </div>

                    <div class="form-group">
                      <label>City: </label>
                        <div class="form-control-small">
                          <input type="text" name="jobCity" class="form-control" required>
                        </div>
                        <div id="jobCity_error" style="color:red;"></div>
                    </div>

                    <div class="form-group">
                        <label>Start date: </label>
                        <div class="form-control-small">
                        <input type="date" name="startDate" class="form-control" id="startDate"
                               placeholder="Enter Date (e.g. DD-MM-YYY)" required>
                        </div>
                        <div id="jobStartDate_error" style="color:red;"></div>
                        <label>End date: </label>
                        <div class="form-control-small">
                        <input type="date" name="endDate" class="form-control" id="endDate"
                               placeholder="Enter Date (e.g. DD-MM-YYY)" required>
                        </div>
                        <div id="jobEndDate_error" style="color:red;"></div>
                    </div>


                  <div class="form-group">
                      <label>Salary per hour ($): </label>
                      <div class="form-control-small">
                        <input type="number"  name="jobSalary" class="form-control-small" min = "1" value="1.00" step="0.25" required>
                      </div>
                      <div id="jobSalary_error" style="color:red;"></div>
                  </div>

                  <div class="form-group">
                    <label>Hours per week: </label>
                    <div class="form-control-small">
                        <input type="number" name="jobHours" class="form-control-small" min = "1" value="1" required>
                    </div>
                    <div id="jobHours_error" style="color:red;"></div>
                  </div>

                  <div class="form-group">
                      <label>Duration (weeks): </label>
                      <div class="form-control-small">
                        <input type="number" name="jobDuration" class="form-control-small" min = "1" value = "1" required>
                      </div>
                      <div id="jobDuration_error" style="color:red;"></div>
                  </div>

                  <div class="form-group">
                    <label>Skills Required: </label>
                      <div class="checkbox">
                        <?php
                          $query_skills = "SELECT * FROM skill s";
                          $result_skills = mysqli_query($connection, $query_skills);

                          while($row_skills = mysqli_fetch_assoc($result_skills)) {
    												echo "<label><input type='checkbox' name='reqSkillSet[]'' class='checkbox' value='" . $row_skills['skillName'] . "'>" . $row_skills['skillName'] . "</label><br>";
    											}
                         ?>
                    </div>
                  </div>

    							<div style="text-align:right; margin-top:50px">
                    <a class="white-btn" href="jobPositions.php">Cancel</a>
    								<button type="submit" name="createJobBtn" class=" main-btn">Create</button>
    							</div>

                  </div>
                </div>
              </form>
						</div>
					</div>
				</div>
        <br><br><br>
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
	<!--<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
  -->
	<!-- /Preloader -->

	<!-- jQuery Plugins -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>

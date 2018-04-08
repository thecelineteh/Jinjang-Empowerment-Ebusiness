<?php
  session_start();
  include 'dbConnection.php';

  $theClient = $_SESSION['userID'];
 ?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Job Applications Summary</title>

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

    .form-title {
      font-family: "Britannic Bold";
      color: black;
      font-size: 25pt;
      margin-top: 10px;
      margin-bottom: 30px;
      margin-left: 10px;
    }

    .card {
				/* Add shadows to create the "card" effect */
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
				transition: 0.3s;
				padding: 20px;
		    background-color: #F8F8FF;
        padding: 25px;
		}

    table, th, td {
      border: 0 !important;
    }

    th {
      color: #101010;
    }
    td {
      color: #080808;
      border-width: 0;
    }

    .assess {
      color: #8B008B;
      font-weight: bold;
    }
    .assess:hover {
      color: blue;
      text-decoration: none;
    }
    .assess:focus {
      color: #8B4513;
      text-decoration: none;
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
					<a href="jobPositions.php">
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
				<li><a href="message.php"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li class="active"><a href="jobApplicationsSummary.php"><i class="fa fa-suitcase"></i>&nbsp;Applications</a></li>
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
              <br>
              <div class="row">
                <div class="col-xs-12">
                  <div class ="card" style="margin:35px">
                    <h4 class="form-title" style="text-align:center">Job Applications Summary</h4>
                    <p style="text-align:center; color:black">Select a job title to review the applications for that job.</p>
                    <?php
                      // display all pending applications according to jobID
                      $pending_app = "SELECT ja.jobID, title, COUNT(ja.jobID) AS numOfPending, ja.status FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID AND theClient = $theClient AND ja.status = 'PENDING' GROUP BY ja.jobID ORDER BY COUNT(ja.jobID) DESC, title";
                      $result_pending_app = mysqli_query($connection, $pending_app);

                      $accepted_app = "SELECT ja.jobID, title, ja.status FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID AND theClient = $theClient AND ja.status = 'ACCEPTED' ORDER BY title";
                      $result_accepted_app = mysqli_query($connection, $accepted_app);


                      /*$jobapp_jobpos = "SELECT ja.jobID AS jobID, title, COUNT(ja.jobID) AS numOfApplications FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID GROUP BY ja.jobID"; */

                      if (mysqli_num_rows($result_pending_app) > 0 || (mysqli_num_rows($result_accepted_app) > 0)) {
                        echo '
                        <div class="table-responsive">
                        <table class="table table-hover table-condensed" style="width:80%;" align="center">
                            <tr class="info">
                              <th class="text-center" width="35%">&nbsp;Job Title</th>
                              <th class="text-center" width="25%">Number of Applications</th>
                              <th class="text-center" width="25%">Status</th>
                            </tr>';
                        } else {
                          echo '<span style="margin-left:30px">No applications to be shown.</span>
                          <br><br><br><br><br><br><br><br><br><br><br><br><br>';
                        }

                        if (mysqli_num_rows($result_pending_app) > 0) {
                        // fetch PENDING applications from database
                        while($row_pending_app = mysqli_fetch_array($result_pending_app) )
                        {
                          $jobID = $row_pending_app['jobID'];
                          $title = $row_pending_app['title'];
                          $numOfPending = $row_pending_app['numOfPending'];
                          $status = $row_pending_app['status'];

                          echo '
                          <form action="jobApplications.php" method="post">
                          <tr>
                            <td align="center">
                              <input type="hidden" name="job" value="'; echo $jobID; echo '">
                              <button type="submit" name="jobTitle" class="assess btn-link" value="'. $title .'">'
                              .$title.'
                              </button>
                            </td>
                            <td align="center"> '.$numOfPending.'</td>
                            <td align="center"> <span style="color: #FF8C00; font-weight: bold;">'.$status. '</span></td>
                          </tr>
                          </form>
                          ';

                          }
                        }

                        if (mysqli_num_rows($result_accepted_app) > 0) {
                          // fetch ACCEPTED applications from database
                          while($row_accepted_app = mysqli_fetch_array($result_accepted_app) )
                          {
                            $jobID = $row_accepted_app['jobID'];
                            $title = $row_accepted_app['title'];
                            $numOfApp = "1";
                            $status = $row_accepted_app['status'];

                            echo '
                            <form action="jobApplications.php" method="post">
                            <tr>
                              <td align="center">
                                <input type="hidden" name="job" value="'; echo $jobID; echo '">
                                <button type="submit" name="jobTitleAccepted" class="assess btn-link" value="'. $title .'">'
                                .$title.'
                                </button>
                              </td>
                              <td align="center"> '.$numOfApp.'</td>
                              <td align="center"><span style="color: green; font-weight: bold;"> '.$status. '</span></td>
                            </tr>
                            </form>
                            ';
                        }
                      }

                      if (mysqli_num_rows($result_pending_app) > 0 || (mysqli_num_rows($result_accepted_app) > 0)) {
                        echo '</table></div>';
                      }

                      ?>
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
						<a href="jobPositions.php"><img src="img/logo-alt.png" alt="logo"></a>
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

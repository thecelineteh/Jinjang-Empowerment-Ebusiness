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

	<title>Job Applications</title>

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
        height: 40em;
        padding: 25px;
		}

    th {
      color: #101010;
    }
    td {
      color: #080808;
    }

    .edit {
      color: #C71585;
    }
    .edit:hover {
      color: blue;
      text-decoration: none;
    }
    .edit:focus {
      color: #8B4513;
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
				<li class="active"><a href="jobPositions.php"><i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
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
              <br>
              <div class="row">
                <div class="col-sm-offset-1 col-sm-10 col-xs-12">
                  <div class ="card">
                    <h4 class="form-title">Job Appications</h4>
                    <div style="margin-top:20px;">
                      <a class="btn btn-primary" href="createJob.php"><i class="fa fa-plus"></i>&nbsp; Create</a>
                    </div>
                    <?php
                      $client_jobapp = "SELECT * FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID AND theClient = $theClient";
                      $result_client_jobpos = mysqli_query($connection, $client_jobpos);

                      if (mysqli_num_rows($result_client_jobpos) > 0) {
                        echo '

                        <div class="table-responsive">
                        <table class="table table-hover table-condensed table-bordered table-striped">
                            <tr class="info">
                              <th></th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Salary per hour</th>
                              <th>Hours per week</th>
                              <th>Number of weeks</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>Status </th>
                              <th>Employee Name</th>
                            </tr>';

                        // fetch data from database
                        while($row_client_jobpos = mysqli_fetch_array($result_client_jobpos) )
                        {
                          // declaration
                          $jobID = $row_client_jobpos['jobID'];
                          $title = $row_client_jobpos['title'];
                          $desc = $row_client_jobpos['description'];
                          $salary = $row_client_jobpos['salaryPerHour'];
                          $hours = $row_client_jobpos['hoursPerWeek'];
                          $weeks = $row_client_jobpos['durationInWeeks'];
                          $address = $row_client_jobpos['address'];
                          $city= $row_client_jobpos['city'];
                          $status= $row_client_jobpos['status'];
                          $theEmployee = $row_client_jobpos['theEmployee'];

                          // display employee's full name
                          $job_emp = "SELECT * FROM jobseeker WHERE userID = $theEmployee";
                          $result_job_emp = mysqli_query($connection, $job_emp);
                          if (mysqli_num_rows($result_job_emp) > 0){
                            while($row_job_emp = mysqli_fetch_assoc($result_job_emp) ) {
                              $empName = $row_job_emp['fullName'];
                            }
                          } else {
                              $empName = '-';
                          }
                          //echo $jobID;
                          // print out the output
                          echo '
                          <form action="editJob.php" method="post">
                          <tr>
                          <td align="center">
                          <input type="hidden" name="job" value="'; echo $jobID; echo '">
                          <input type="hidden" name="empName" value="'; echo $empName; echo '">
                          <button type="submit" name="' .$jobID. '" class="edit btn-link"><i class="fa fa-pencil-square-o"></i>&nbsp; Edit</button>

                          </td>';
                          echo '
                          <td align="center"> '.$title.'</td>
                          <td align="center"> '.$desc. '</td>
                          <td align="center"> '.$salary.'</td>
                          <td align="center"> '.$hours.'</td>
                          <td align="center"> '.$weeks.'</td>
                          <td align="center"> '.$address.'</td>
                          <td align="center"> '.$city.'</td>
                          <td align="center"> '.$status.'</td>
                          <td align="center"> '.$empName.'</td>
                          </tr>
                          </form>
                          ';

                        }
                      } else {
                        echo '<span style="margin-left:10px">No job positions created yet.</span>';
                      }
                      ?>

                    </table>
                    </div>

                  </div>
                </div>
  						</div>
  					</div>
  				</div>
          <br><br>
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
						<p>Copyright © 2017 AGN. All Rights Reserved.</p>
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

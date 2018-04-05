<?php
  session_start();
  include 'dbConnection.php';

  if ($_SESSION['userType'] == 'Job Seeker') {
    $theJobSeeker = $_SESSION['userID'];
  } else if ($_SESSION['userType'] == 'Client') {
    $theClient = $_SESSION['userID'];
  }

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

    .form-title-white {
      font-family: "Britannic Bold";
      color: white;
      font-size: 25pt;
      margin-top: 10px;
      margin-bottom: 30px;
      margin-left: 30px;
    }

    .applications {
      margin: 10px;
    }

    .pricing {
      color: #696969;
    }

    .pricing:hover {
      color: white;
    }

    .pricing .price h3 {
      font-size: 36px;
    }

    .price-title, .price-title-applicant {
        color: black;
    }

    .pricing .price-title-applicant {
      display: block;
      padding: 30px 0px 0px;
      text-transform: uppercase;
      -webkit-transition: 0.2s color;
      transition: 0.2s color;
    }

    .pricing .price-btn-applicant {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .pricing:hover .price-title-applicant {
        color: #6195FF;
    }
    .pricing:hover .price-btn-applicant {
        color: #6195FF;
    }

    .accept {
        background: transparent;
        color: green !important;
        border-color: green;
    }

    .decline {
      background: transparent;
      color: #FF3300 !important;
      border-color: #FF3300;
    }

    .app-detail {
      font-weight: bold;
      text-transform: capitalize;
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
				 ?>
         <i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li><a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="message.php"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li class="active"><a href="jobApplications.php"><i class="fa fa-suitcase"></i>&nbsp;Applications</a></li>
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
					<div class = "row" style = "margin: 10px;">
						<div class="middle">
							<div class="bg-img" style="background-image: url('./img/bg-createJob.jpg');">
                <div class="overlay2">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="applications col-xs-12">
                    <h4 class="form-title-white">Job Applications</h4>
                    <?php
                    if ($_SESSION['userType'] == 'Job Seeker') {
                      $applicant_jobapp = "SELECT applicationID, title, ja.jobID AS jobID, ja.status AS status FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID AND theJobSeeker = $theJobSeeker ORDER BY applicationID";
                      $result_applicant_jobapp = mysqli_query($connection, $applicant_jobapp);

                      if (mysqli_num_rows($result_applicant_jobapp) > 0) {
                        // fetch data from database
                        while($row_applicant_jobapp = mysqli_fetch_array($result_applicant_jobapp) )
                        {
                          // declaration
                          $applicationID = $row_applicant_jobapp['applicationID'];
                          $jobID = $row_applicant_jobapp['jobID'];
                          $title = $row_applicant_jobapp['title'];
                          $status= $row_applicant_jobapp['status'];

                          echo '
                          <div class="col-sm-4">
                            <div class="container-fluid">
                              <div class="pricing">
                                <div class="price-head">
                                  <span class="price-title-applicant">
                                  Application #A00<span class="app-detail">'. $applicationID .'</span><br><br>
                                  </span>
                                  Job Position: <span class="app-detail">'. $title .'</span><br>
                                  <div class="price-btn">
                                    <form method="post" target="_blank" action="jobDetails.php">
                                      <button type="submit" id="jobDetails'. $applicationID .'" name="jobID" value="'.$jobID.'" class="outline-btn">Job Details</button>
                                    </form>
                                  </div>
                                  </span>
                                  ';

                                  if ($status == 'ACCEPTED') {
                                    echo 'Status: <span style="color: green; font-weight: bold;">' . $status . '</span>
                                    <br><br><br><br>';
                                  } else if ($status == 'PENDING') {
                                    echo 'Status:
                                    <span style="color: #FF8C00; font-weight: bold;">' . $status . '</span><br><br>
                                    <form method="post" action="cancelApplication.php">
                                    <input type="hidden" name="applicationID" value="'; echo $applicationID; echo '">
                                    <button type="submit" id="cancelAppBtn" name="cancelAppBtn" value="CANCELLED" class="outline-btn decline">Cancel</button>
                                    </form>';
                                  } else if ($status == 'DECLINED') {
                                    echo '<br><br>Sorry, your application was declined.<br><br>';
                                  } else {
                                    echo '<br><br>';
                                  }

                                  echo '
                                </div>
                              </div>
                            </div>
                          </div>';

                        }
                      }

          					} else if ($_SESSION['userType'] == 'Client') {
                        $client_jobapp = "SELECT applicationID, ja.jobID AS jobID, theJobSeeker, ja.status AS status, title, description, salaryPerHour, startDate, endDate, startTime, endTime, address, city FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID AND theClient = $theClient ORDER BY applicationID";
                        $result_client_jobapp = mysqli_query($connection, $client_jobapp);

                        if (mysqli_num_rows($result_client_jobapp) > 0) {
                          // fetch data from database
                          while($row_client_jobapp = mysqli_fetch_array($result_client_jobapp) )
                          {
                            // declaration
                            $applicationID = $row_client_jobapp['applicationID'];
                            $jobID = $row_client_jobapp['jobID'];
                            $title = $row_client_jobapp['title'];
                            /*
                            $desc = $row_client_jobapp['description'];
                            $salary = $row_client_jobapp['salaryPerHour'];
                            $startDate = $row_client_jobapp['startDate'];
                            $endDate = $row_client_jobapp['endDate'];
                            $startTime = $row_client_jobapp['startTime'];
                            $endTime = $row_client_jobapp['endTime'];
                            $address = $row_client_jobapp['address'];
                            $city= $row_client_jobapp['city'];
                            */
                            $status= $row_client_jobapp['status'];
                            $theApplicant = $row_client_jobapp['theJobSeeker'];

                            // get applicant's full name
                            $applicant = "SELECT * FROM jobseeker WHERE userID = $theApplicant";
                            $result_applicant = mysqli_query($connection, $applicant);
                            if (mysqli_num_rows($result_applicant) > 0){
                              while($row_applicant = mysqli_fetch_assoc($result_applicant) ) {
                                $applicantName = $row_applicant['fullName'];
                              }
                            } else {
                                $applicantName = '-';
                            }

                            // get applicant profile details
                            $applicant_profile = "SELECT * FROM user WHERE userID = $theApplicant";
                            $result_applicant_profile = mysqli_query($connection, $applicant_profile);
                            if (mysqli_num_rows($result_applicant_profile) > 0){
                              while($row_applicant_profile = mysqli_fetch_assoc($result_applicant_profile) ) {
                                $applicantUsername = $row_applicant_profile['username'];
                                $applicantEmail = $row_applicant_profile['email'];
                                $applicantPhone = $row_applicant_profile['phoneNo'];
                                $applicantAdd = $row_applicant_profile['address'];
                              }
                            }

                            /*
                            // convert startDate format
                            $startDateDisplay = date("j M Y", strtotime($startDate));
                            // convert endDate format
                            $endDateDisplay = date("j M Y", strtotime($endDate));
                            // convert startTime format
                            $startTimeDisplay = date('g:i A', strtotime($startTime));
                            // convert endTime format
                            $endTimeDisplay = date('g:i A', strtotime($endTime));
                            */

                            // display application details
                            if ($status != "DECLINED") {
                              echo '
                              <div class="col-sm-4">
                              <div class="container-fluid">
                      					<div class="pricing">
                      						<div class="price-head">
                                    <span class="price-title">Application #A00<span class="app-detail">'. $applicationID .'</span>
                                    </span>

                                    Applicant:
                                    <span class="app-detail">'. $applicantName .'</span>

                                    <br>

                                    <ul>
                                    <li>
                                      <button class="outline-btn"data-toggle="modal" data-target="#myModal'. $applicationID . '">View Profile</button>
                                    </li>
                                    <li>
                                    <br>
                                     Job Position: <span class="app-detail">'. $title .'</span>
                                     </li>';
  /*
                                     echo '
                      							<div class="price">
                      								<h3>RM'. round($salary,2) .'<span class="duration">/ hour</span></h3>
                      							</div>
                      						</div>
                      						<ul class="price-content">
                                    <li>
                      								<p>Skills Required: </p>';


                              $reqSkills = "SELECT skill.skillName FROM jobrequiredskill, skill WHERE jobID = $jobID
                  											AND jobrequiredskill.skillID=skill.skillID";
                  						$result_reqSkills = mysqli_query($connection, $reqSkills);

                              if (mysqli_num_rows($result_reqSkills) > 0) {
                                echo '<div class="row">';
                                while ($row_reqSkills = mysqli_fetch_assoc($result_reqSkills)) {
                                  echo '<div class="col-lg-offset-4 col-md-offset-3 col-md-12"><p style="text-align:left; margin-left:15px;"><i class="fa fa-check-circle" style="font-size:20px;color:green"></i> &nbsp;&nbsp;' . $row_reqSkills['skillName'] . '</p></div>';
                                }
                                echo '</div>';
                                if (mysqli_num_rows($result_reqSkills) < 5){
                                  echo '<br><br><br>';
                                  if (mysqli_num_rows($result_reqSkills) == 3){
                                    echo '<br>';
                                  } else if (mysqli_num_rows($result_reqSkills) == 2){
                                    echo '<br><br>';
                                  } else if (mysqli_num_rows($result_reqSkills) == 1){
                                    echo '<br><br><br>';
                                  }
                                }
                              } else {
                                echo '<p>No skills required.</p>';
                              }

                              echo '
                              </li>
                              <li>
                                <br>
                                <p><i class="fa fa-calendar-check-o"></i>&nbsp;Start date: '. $startDateDisplay .'</p>
                                <p><i class="fa fa-calendar-check-o"></i>&nbsp;End date: '. $endDateDisplay .'</p>
                              </li>
                              <li>
                                <p><i class="fa fa-clock-o"></i>&nbsp;Start time: '. $startTimeDisplay .'</p>
                                <p><i class="fa fa-clock-o"></i>&nbsp;End time: '. $endTimeDisplay .'</p>
                              </li>
  <!--------- ----->
  */
                              echo '
                              <li>
                              <form method="post" target="_blank" action="jobDetails.php">
                              <button type="submit" id="jobDetails'. $applicationID .'" name="jobID" value="'.$jobID.'" class="outline-btn">Job Details</button>
                              </form>
                              </li>
  <!--------- ----->
                              <li>
                                <br>
                                <p>Status: ';
                                if ($status == 'ACCEPTED') {
                                  echo '<span style="color: green; font-weight: bold;">';
                                } else if ($status == 'PENDING') {
                                  echo '<span style="color: #FF8C00; font-weight: bold;">';
                                }
                                echo $status . '</span></p>
                              </li>
                            </ul>';

                              if ($status == 'PENDING') {
                                  echo '
                                  <form method="post" action="assessApplication.php">
                                  <table style="margin:30px; width:85%; text-align:center">
                                    <tr>
                                      <td>
                                        <input type="hidden" name="applicationID" value="'; echo $applicationID; echo '">
                                        <input type="hidden" name="theEmployee" value="'; echo $theApplicant; echo '">
                                        <input type="hidden" name="jobID" value="'; echo $jobID; echo '">
                                        <button type="submit" id="acceptBtn" name="acceptBtn" value="ACCEPTED" class="outline-btn accept">Accept</button>
                                      </td>
                                      <td>
                                        <button type="submit" id="declineBtn" name="declineBtn" value="DECLINED" class="outline-btn decline">Decline</button>
                                      </td>
                                    </tr>
                                  </table>
                                  </form>';

                              } else {
                                echo '<br><br><br>';
                              }

                              if ($applicantEmail == "") {
                                $applicantEmail = "-";
                              }

                              if ($applicantPhone == "") {
                                $applicantPhone = "-";
                              }

                              if ($applicantAdd == "") {
                                $applicantAdd = "-";
                              }

                              // get applicant skillsets
                              $skillsets = "SELECT skill.skillName FROM skillsets, skill WHERE theJobSeeker = $theApplicant AND skillsets.skillID = skill.skillID";
                              $result_skillsets = mysqli_query($connection, $skillsets);

                              echo '
                              </div>
                            </div>
                            </div>

                            <!-- Modal -->
                          	<div id="myModal' . $applicationID . '" class="modal fade" role="dialog">
                          	  <div class="modal-dialog">
                          	    <!-- Modal content-->
                          	    <div class="modal-content">
                          	      <div class="modal-header" style="text-align: center;">
                          	        <button type="button" class="close" data-dismiss="modal">&times;</button>
                          	        <h4 class="modal-title">' . $applicantUsername . '\'s Profile</h4>
                          	      </div>
                          	      <div class="modal-body">
                          						<div class="container">
                          							<div class="row">
                          								<div class="col-sm-offset-1 col-sm-4">
                          									<div class="form-group">

                          								    <label for="fullName">Full Name:</label>
                                              <h4>'. $applicantName .'</h4>

                          								  </div>

                          								  <div class="form-group">
                          								    <label for="email">Email:</label>
                                              <h5>' .  $applicantEmail . '</h5>
                          								  </div>

                                            <div class="form-group">
                          								    <label for="phoneNo">Contact no:</label>
                                              <h5>' .  $applicantPhone . '</h5>
                          								  </div>

                                            <div class="form-group">
                                              <label for="address">Address:</label>
                                              <h5>' .  $applicantAdd . '</h5>
                                            </div>

                                            <div class="form-group">
                                              <label for="skillset">Skill Sets:</label>';

                                            if (mysqli_num_rows($result_skillsets) > 0){
                                              while($row_skillsets = mysqli_fetch_assoc($result_skillsets) ) {
                                                echo '
                                                <p style="text-align:left; margin-left:15px;"><i class="fa fa-check-circle" style="font-size:18px;color:green"></i> &nbsp;&nbsp;' . $row_skillsets['skillName'] . '</p>';
                                              }
                                            } else {
                                              echo '<h5>-</h5>';
                                            }

                                            echo '</div>

                          								</div>
                          							</div>
                          						</div>
                                      <div class="modal-footer">
                          							<div style="text-align: center;">
                          								<button type="submit" class="btn btn-default">Message</button>
                          							</div>
                          						</div>
                          	      </div>
                          	    </div>
                          	  </div>
                          	</div>
                            <!-- End of Modal -->

  <!----->
                      </div>
  <!----->
                            ';
                            }

                          }

                        } else {
                          echo '<span style="margin-left:30px">No applications yet.</span>
                          <br><br><br><br><br><br><br><br><br><br><br><br><br>';
                        }
                      }
                      ?>
                      <br><br><br>

                    </div>

                  </div>
                </div>
  						</div>
  					</div>
            <br><br>
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

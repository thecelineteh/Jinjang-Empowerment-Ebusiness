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

    .jobDetails {
      margin-left: 30px;
      background: #f1f3f4;
      color: black !important;
      border-color: transparent;
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

    .message {
      color: #1a75ff;
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
         <i class="fa fa-suitcase"></i>&nbsp;Jobs</a>
       </li>
				<li><a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="message.php"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
          <?php
					if ($_SESSION['userType'] == 'Job Seeker') {
						echo '<li class="active"><a href="jobApplications.php">';
					} else if ($_SESSION['userType'] == 'Client') {
						echo '<li><a href="jobApplicationsSummary.php">';
					}
				 ?>
         <i class="fa fa-suitcase"></i>&nbsp;Applications</a>
       </li>
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
                    <?php
                    if ($_SESSION['userType'] == 'Job Seeker') {
                      echo '<h4 class="form-title-white">My Job Applications</h4>';
                      $applicant_jobapp = "SELECT applicationID, title, ja.jobID, ja.status FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID AND theJobSeeker = $theJobSeeker ORDER BY applicationID";
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
                      } else {
                        echo '
                        <span style="margin-left:30px">No job applications yet.</span>
                        <br>
                        <span style="margin-left:30px"> Go to Jobs to search and apply for a job now!</span>
                        <br><br><br><br><br><br><br><br><br><br><br>';
                      }

          					} else if ($_SESSION['userType'] == 'Client') {
                        if (isset($_POST['job'])) {
                          $_SESSION['jobID'] = $_POST['job'];
                        }

                        if (isset($_POST['jobTitle'])) {
                           echo '<h4 class="form-title-white">Job Applications for ' . $_POST['jobTitle'] .'</h4>';
                        } else if (isset($_POST['jobTitleAccepted'])){
                          echo '<h4 class="form-title-white">Job Applications for ' . $_POST['jobTitleAccepted'] .'</h4>';
                        } else {
                          echo '<h4 class="form-title-white">Job Applications for '. $_SESSION['title'] .'</h4>';
                        }

                        echo '
                        <div>
                        <form method="post" target="_blank" action="jobDetails.php">
                        <button type="submit" id="jobDetails" name="jobID" value="'.$_SESSION['jobID'].'" class="jobDetails outline-btn">Job Details</button>
                        </form>
                        </div>';

                        $jobID = $_SESSION['jobID'];

                        $client_jobapp = "SELECT applicationID, title, ja.jobID, theJobSeeker, ja.status FROM jobapplication ja, jobposition jp WHERE ja.jobID = jp.jobID AND ja.jobID = $jobID AND theClient = $theClient AND ja.status != 'DECLINED' ORDER BY applicationID";
                        $result_client_jobapp = mysqli_query($connection, $client_jobapp);

                        if (mysqli_num_rows($result_client_jobapp) > 0) {
                          // fetch data from database
                          while($row_client_jobapp = mysqli_fetch_array($result_client_jobapp) )
                          {
                            // declaration
                            $applicationID = $row_client_jobapp['applicationID'];
                            $jobID = $row_client_jobapp['jobID'];
                            $title = $row_client_jobapp['title'];

                            $_SESSION['title'] = $title;

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

                            // display application details
                              echo '
                              <div class="col-sm-4">
                              <div class="container-fluid">
                                <div class="pricing">
                                  <div class="price-head">
                                    <span class="price-title">Application #A00<span class="app-detail">'. $applicationID .'</span>
                                    </span>
                                        Status:
                                      ';

                                    if ($status == 'ACCEPTED') {
                                      echo '<span style="color: green; font-weight: bold;">';
                                    } else if ($status == 'PENDING') {
                                      echo '<span style="color: #FF8C00; font-weight: bold;">';
                                    }
                                    echo $status . '</span>

                                    <br><br>


                                    <table align="center" style="border-collapse:separate; border-spacing:10px; padding-left:15px">
                                      <tr>
                                        <td>
                                          Applicant:
                                        </td>

                                        <form method="post" target="_blank" action="sendMessage.php">
                                        <td>
                                          <input type="hidden" name="senderName" value="'. $applicantName .'">
                                          <input type="hidden" name="subject" value="'. $title .'">

                                          <span class="app-detail">'. $applicantName .'</span>
                                          <button type="submit" class="message btn-link"><i class="fa fa-envelope"></i></button>
                                        </td>
                                        </form>

                                      </tr>

                                      <tr>
                                        <td>
                                          Email:
                                        </td>
                                        <td>
                                          <span class="app-detail">' .  $applicantEmail . '</span>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Contact no:
                                        </td>
                                        <td>
                                          <span class="app-detail">' .  $applicantPhone . '</span>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Address:
                                        </td>
                                        <td>
                                          <span class="app-detail">' .  $applicantAdd . '</span>
                                        </td>
                                      </tr>
                                      ';

                                    if (mysqli_num_rows($result_skillsets) > 0){
                                      echo '
                                      <tr>
                                      <td valign="top" rowspan="'. mysqli_num_rows($result_skillsets)  .'">
                                        Skill Sets:
                                      </td>
                                      </tr>
                                      <td rowspan="'. mysqli_num_rows($result_skillsets)  .'">
                                      ';
                                      while($row_skillsets = mysqli_fetch_assoc($result_skillsets) ) {
                                        echo '
                                          <p style="text-align:left;"><i class="fa fa-check-circle" style="font-size:18px;  color:green"></i> &nbsp;&nbsp;' . $row_skillsets['skillName'] . '</p>
                                          ';
                                      }
                                      echo '
                                      </td>
                                      </tr>
                                      </table>
                                      ';

                                    } else {
                                      echo '
                                      <tr>
                                        <td>
                                          Skill Sets:
                                        </td>
                                        <td>
                                        <span class="app-detail">-</span>
                                        </td>
                                      </tr>
                                      </table>
                                      <br><br><br><br>';
                                    }



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



                              echo '
                              </div>
                              </div>
                            </div>
                            </div>';

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

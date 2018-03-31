<?php
  session_start();
  include 'dbConnection.php';

  $theClient = $_SESSION['userID'];
  $jobID = $_POST['job'];
  $_SESSION['jobID'] = $jobID;
  $empName = $_POST['empName'];


 ?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Edit Job Position</title>

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

    .checkbox {
			margin-left: 20px;
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

    select {
      color: black;
      background-color: lightgrey;
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
                    <h4 class="form-title">Edit Job Position</h4>
                    <div class="form-group">
                      <label>Job Title: </label>
                      <div class="form-control-big">
                        <?php
                          $query_jobpos = "SELECT * FROM jobposition WHERE theClient = $theClient AND jobID = $jobID";
                          $result_findJob = mysqli_query($connection, $query_jobpos);
                          while($row_jobPositions = mysqli_fetch_assoc($result_findJob)) {
                            echo '<input type="text" name="jobTitle" class="form-control" value = "' . $row_jobPositions['title'] .
                            '" required>
                              </div>
                              <div id="jobTitle_error" style="color:red;"></div>
                            </div>';

                            echo '
                            <div class="form-group">
                              <label>Job Description: </label>
                              <div class="form-control-big">
                                <textarea name="jobDescription" rows="6" cols="50" required>' .$row_jobPositions['description']. '</textarea>
                              </div>
                              <div id="jobDescription_error" style="color:red;"></div>
                            </div>

                            <div class="form-group">
                              <label>Address: </label>
                              <div class="form-control-big">
                                <textarea name="jobAddress" rows="4" cols="50" required>' .$row_jobPositions['address']. '</textarea>
                              </div>
                              <div id="jobAddress_error" style="color:red;"></div>
                            </div>

                            <div class="form-group">
                              <label>City: </label>
                                <div class="form-control-small">
                                  <input type="text" name="jobCity" class="form-control" value = "'
                                  . $row_jobPositions['city'] .
                                  '" required>
                                </div>
                                <div id="jobCity_error" style="color:red;"></div>
                            </div>


                          <div class="form-group">
                              <label>Salary per hour ($): </label>
                              <div class="form-control-small">
                                <input type="number"  name="jobSalary" class="form-control-small" min = "1" value="' .$row_jobPositions['salaryPerHour']. '" step="0.25" required>
                              </div>
                              <div id="jobSalary_error" style="color:red;"></div>
                          </div>';

                          // conversion of date and time

                          echo '
                          <div class="form-group">
                            <label>Start Date: </label>
                            <div class="form-control-small">
                                <input type="date" name="startDate" class="form-control-small" value="' .$row_jobPositions['startDate']. '" required>
                            </div>
                            <div id="startDate_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>End Date: </label>
                            <div class="form-control-small">
                                <input type="date" name="endDate" class="form-control-small" min = "<?php date("Y-m-d") ?>" required>
                            </div>
                            <div id="endDate_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>Start Time: </label>
                            <div class="form-control-small">
                                <input type="time" name="startTime" class="form-control" min = "<?php echo time(); ?>" required>
                            </div>
                            <div id="startTime_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>End Time: </label>
                            <div class="form-control-small">
                                <input type="time" name="endTime" class="form-control" min = "<?php echo time(); ?>" required>
                            </div>
                            <div id="endTime_error" style="color:red;"></div>
                          </div>


                          <div class="form-group">
                              <label>Status: </label>
                              <div class="form-control-small">
                                <select name="jobStatus">';
                                if ($row_jobPositions['status'] == 'AVAILABLE'){
                                  echo '<option value="AVAILABLE" selected>AVAILABLE</option>
                                  <option value="NOT AVAILABLE">NOT AVAILABLE</option>
                                  ';
                                } else if ($row_jobPositions['status'] == 'NOT AVAILABLE') {
                                  echo '<option value="AVAILABLE">AVAILABLE</option>
                                  <option value="NOT AVAILABLE" selected>NOT AVAILABLE</option>';
                                } else {
                                  echo '<option value="AVAILABLE">AVAILABLE</option>
                                  <option value="NOT AVAILABLE">NOT AVAILABLE</option>
                                  ';
                                }



                                echo '
                                </select>
                              </div>
                              <div id="jobStatus_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <div class="form-control-small">
                              <label>Employee Name: </label>
                              <input type="text" name="empName" class="form-control" value="' . $empName. '">
                            </div>
                            <div id="jobEmployee_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>Skills Required: </label>
                              <div class="checkbox">';

                              $query_jobreqskills = "SELECT * FROM jobrequiredskill jrs, skill s WHERE jrs.skillID = s.skillID AND jobID = $jobID";
                              $result_jobreqskills = mysqli_query($connection, $query_jobreqskills);

                              $jobReqSkills = array();
                              if (mysqli_num_rows($result_jobreqskills) > 0) {
                                while ($row_jobreqskills = mysqli_fetch_assoc($result_jobreqskills)) {
                                  $reqskillName = $row_jobreqskills['skillName'];
                                  array_push($jobReqSkills, $reqskillName);
                                }
                              }

                              $check = false;
                              $query = "SELECT * FROM skill";
                              $result = mysqli_query($connection, $query);
                              if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  $skillName = $row['skillName'];
                                  for ($i = 0; $i < count($jobReqSkills); $i++ ) {
                                    $check = false;
                                    if ($skillName == $jobReqSkills[$i]) {
                                      $check = true;
                                      break;
                                    }
                                  }
                                  if ($check) {
                                    echo "<input type='checkbox' class='checkbox' name='jobReqSkills[]' value='" . $skillName . "' checked>" . $skillName . "<br>";
                                    array_push($jobReqSkills, $skillName);
                                  }
                                  else {
                                    echo "<input type='checkbox' class='checkbox' name='jobReqSkills[]' value='" . $skillName . "'>" . $skillName . "<br>";

                                  }
                                }
                              }
                          }
                         ?>



                  <div style="text-align:right; margin-top:50px">
                    <a class="white-btn" href="jobPositions.php">Cancel</a>
    								<button type="submit" name="updateJobBtn" class=" main-btn">Update</button>
    							</div>

                  </div>
                </div>
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
  <!--
	<div id="preloader">
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

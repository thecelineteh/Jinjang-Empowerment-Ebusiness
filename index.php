<?php
	session_start();
	if (!isset($_SESSION['userName'])) {
	  $_SESSION['userName'] = "empty";
	}
	if (!isset($SESSION['SignUp'])) {
		$_SESSION['userName'] = "empty";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Jinjang E-Business</title>

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
		.modal {
	text-align: center;
	}

	@media screen and (min-width: 768px) {
	.modal:before {
		display: inline-block;
		vertical-align: middle;
		content: " ";
		height: 100%;
	}
	}

	.modal-dialog {
	display: inline-block;
	text-align: left;
	vertical-align: middle;
	}

	</style>
</head>

<body>
	<!-- Header -->
	<header id="home">
		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('./img/background1.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->

		<!-- Nav -->
		<nav id="nav" class="navbar nav-transparent">
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
					<li><a href="#home">Home</a></li>
					<li><a href="#about">About Us</a></li>
					<li><a href="#team">Team</a></li>
					<li><a href="#service">How You Can Help</a></li>
					<li><a href="#pricing">Sponsor</a></li>
					<li><a href="#portfolio">Gallery</a></li>
					<li><a href="#blog">News</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
				<!-- /Main navigation -->

			</div>
		</nav>
		<!-- /Nav -->

		<!-- home wrapper -->
		<div class="home-wrapper">
			<div class="container">
				<div class="row">

					<!-- home content -->
					<div class="col-md-10 col-md-offset-1">
						<div class="home-content">
							<h1 class="white-text">JinJang Empowerment E&nbsp;-&nbsp;Business</h1>
							<p class="white-text">
								"Impact a life, transform a community"
							</p>
							<button class="white-btn" data-toggle="modal" data-target="#myModal">
								Log In
							</button>
							<button class="main-btn" data-toggle="modal" data-target="#myModal2">
								Sign Up
							</button>
						</div>
					</div>
					<!-- /home content -->

				</div>
			</div>
		</div>
		<!-- /home wrapper -->

	</header>
	<!-- /Header -->

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="text-align: center;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Log In</h4>
	      </div>
	      <div class="modal-body">
					<br /><br />
					<form action="signIn.php" method="post">
						<div class="container">
							<div class="row">
								<div class="col-sm-offset-1 col-sm-4">
									<div class="form-group">
										<?php
										if ($_SESSION['userName'] == "failed") {
											echo "<div class='alert alert-danger'>";
											echo "Wrong username or passowd!";
											echo "</div><br />";
										}
										 ?>
								    <label for="email">Username:</label>
										<?php
										if (isset($_SESSION['remember'])) {
											echo "<input type='text' class='form-control' id='
												username' name='username' value='" .
												$_SESSION['remember'] . "' required>";
										}
										else {
											echo "<input type='text' class='form-control' id='
												username' name='username' required>";
										}
										?>
								  </div>
								  <div class="form-group">
								    <label for="pwd">Password:</label>
								    <input type="password" class="form-control" id="pwd"
										name="password" required>
								  </div>
									<?php
									if (isset($_SESSION['remember'])) {
										echo "
										<div class='checkbox'>
											<label><input type='checkbox' name='remember' checked> Remember me</label>
										</div>
										";
									}
									else {
										echo "
										<div class='checkbox'>
											<label><input type='checkbox' name='remember'> Remember me</label>
										</div>
										";
									}
									?>

								</div>
							</div>
						</div><br /><br>
						<div class="modal-footer">
							<div style='text-align: center;'>
								<button type="submit" class="btn btn-default">Log In</button>
							</div>
						</div>
					</form>
	      </div>
	    </div>
	  </div>
	</div>
  <!-- End of Modal -->

	<!-- Modal -->
	<div id="myModal2" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="text-align: center;">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Sign Up</h4>
	      </div>
		  <div class="modal-body">
        	<div class="container">
            <div class = "row">
              <div class = "col-xs-12 col-sm-6">
                <br />
                <ul class="nav nav-tabs nav-justified">
                  <li class="active"><a data-toggle="tab" href="#jobseeker">Job Seeker</a></li>
                  <li><a data-toggle="tab" href="#company">Company</a></li>
                </ul>
                <div class="tab-content">
                  <div id="jobseeker" class="tab-pane fade in active">
                    <form action="jSignUp.php" method="post">
                      <div class="row" style="margin-top: 50px;">
                        <div class="col-sm-offset-2 col-sm-8">
                          <div class="form-group">
                            <label>Username: </label>
                              <input type="text" name="Susername" class="form-control" required>
                            <div id="Susername_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>Password: </label>
                              <input type="password" name="Spassword" class="form-control" required>
                            <div id="Spassword_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>Full Name: </label>
                            <input type="text" name="Sfullname" class="form-control" required>
                            <div id="Sfullname_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>Email: </label>
                              <input type="email" name="Semail" required
                              pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" class="form-control">
                            <div id="Semail_error" style="color:red;"></div>
                          </div>

                          <div class="form-group">
                            <label>Phone No: </label>
                            <input type="text" name="Sphone" class="form-control" required>
                            <div id="Sphone_error" style="color:red;" ></div>
                          </div>

                          <br />
                      	</div>
						</div>

						<div class="modal-footer">
	                        <div style="text-align: center;">
	                          <br />
	                          <input type="submit" value="Get Started" name="registerS" id="jobseekersubmit" class="btn btn-default">
	                        </div>
                      	</div>

                      </form>
                     </div>

                  	<div id="company" class="tab-pane fade">
                    	<form action="cSignUp.php" method="post">
	                      <div class="row" style="margin-top:50px;">
	                        <div class="col-sm-offset-2 col-sm-8">
	                          <div class="form-group">
	                            <label>Username: </label>
	                              <input type="text" name="Cusername" class="form-control" required>
	                            <div id="Cusername_error" style="color:red;"></div>
	                          </div>

	                          <div class="form-group">
	                            <label>Password:</label>
	                              <input type="password" name="Cpassword" class="form-control" required>
	                            <div id="Cpassword_error" style="color:red;"></div>
	                          </div>

	                          <div class="form-group">
	                            <label>Company Name: </label>
	                              <input type="text" name="Ccompanyname" class="form-control" required>
	                            <div id="Ccompanyname_error" style="color:red;"></div>
	                          </div>
	                          <div class="form-group">
	                            <label>Email: </label>
	                            <input type="email" name="Cemail" required
								pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" class="form-control">
	                            <div id="Cemail_error" style="color:red;" ></div>
	                          </div>

							  <div class="form-group">
	                            <label>Phone No: </label>
	                            <input type="text" name="Cphone" class="form-control" required>
	                            <div id="Cphone_error" style="color:red;" ></div>
	                          </div>
	                          <br />
	                        </div>
	                      </div>
	                      <div class="modal-footer">
	                        <div style="text-align: center;">
	                          <br />
	                          <input type="submit" value="Get Started" name="registerC" id="companysubmit" class="btn btn-default">
	                        </div>
	                      </div>
                    	</form>
                   </div>
                </div>
               </div>
             </div>
             </div>
          </div>
          <!-- End of modal body-->
	    </div>
	  </div>
	</div>
  	<!-- End of Modal -->

	<!-- About -->
	<div id="about" class="section md-padding">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">About Us</h2>
					<br /><br /><br />
					<p style="font-size: x-large; text-align: justify">
						ACTS Global Networking (AGN) is a non-profit organisation mainly
						focusing on education and social concern activities. AGN has many
						success stories of these children having progressed to secondary
						education and a few are even completing their university education
						through the sponsorship of kind benefactors like HELP Education
						Group. AGN has been extending support, counseling and meeting the
						material needs of this needful community for over 15 years.
					</p>
				</div>
				<!-- /Section header -->


				<!--
				<div class="col-md-4">
					<div class="about">
						<i class="fa fa-cogs"></i>
						<h3>Fully Customizible</h3>
						<p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet.</p>
						<a href="#">Read more</a>
					</div>
				</div>

				<div class="col-md-4">
					<div class="about">
						<i class="fa fa-magic"></i>
						<h3>Awesome Features</h3>
						<p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet.</p>
						<a href="#">Read more</a>
					</div>
				</div>
>
				<div class="col-md-4">
					<div class="about">
						<i class="fa fa-mobile"></i>
						<h3>Fully Responsive</h3>
						<p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet.</p>
						<a href="#">Read more</a>
					</div>
				</div>
				-->


			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /About -->

	<!-- Team -->
	<div id="team" class="section md-padding bg-grey">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">Our Team</h2>
				</div>
				<!-- /Section header -->

				<!-- team -->
				<div class="col-sm-4">
					<div class="team">
						<div class="team-img">
							<img class="img-responsive" src="./img/team1.jpg" alt="">
							<div class="overlay">
								<div class="team-social">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-google-plus"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</div>
							</div>
						</div>
						<div class="team-content">
							<h3>Elon Musk</h3>
							<span>HR MANAGER</span>
						</div>
					</div>
				</div>
				<!-- /team -->

				<!-- team -->
				<div class="col-sm-4">
					<div class="team">
						<div class="team-img">
							<img class="img-responsive" src="./img/team2.jpg" alt="">
							<div class="overlay">
								<div class="team-social">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-google-plus"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</div>
							</div>
						</div>
						<div class="team-content">
							<h3>John Doe</h3>
							<span>CEO</span>
						</div>
					</div>
				</div>
				<!-- /team -->

				<!-- team -->
				<div class="col-sm-4">
					<div class="team">
						<div class="team-img">
							<img class="img-responsive" src="./img/team3.jpg" alt="">
							<div class="overlay">
								<div class="team-social">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-google-plus"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</div>
							</div>
						</div>
						<div class="team-content">
							<h3>Mark Zuckerburg</h3>
							<span>EVENT COORDINATOR</span>
						</div>
					</div>
				</div>
				<!-- /team -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Team -->

	<!-- Numbers -->
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

				<!-- number -->
				<div class="col-sm-3 col-xs-6">
					<div class="number">
						<i class="fa fa-users"></i>
						<h3 class="white-text"><span class="counter">451</span></h3>
						<span class="white-text">Volunteers</span>
					</div>
				</div>
				<!-- /number -->

				<!-- number -->
				<div class="col-sm-3 col-xs-6">
					<div class="number">
						<i class="fa fa-calendar-check-o"></i>
						<h3 class="white-text"><span class="counter">12</span></h3>
						<span class="white-text">Events</span>
					</div>
				</div>
				<!-- /number -->

				<!-- number -->
				<div class="col-sm-3 col-xs-6">
					<div class="number">
						<i class="fa fa-money"></i>
						<h3 class="white-text"><span class="counter">5234.32</span></h3>
						<span class="white-text">Donation Received</span>
					</div>
				</div>
				<!-- /number -->

				<!-- number -->
				<div class="col-sm-3 col-xs-6">
					<div class="number">
						<i class="fa fa-file"></i>
						<h3 class="white-text"><span class="counter">45</span></h3>
						<span class="white-text">Projects completed</span>
					</div>
				</div>
				<!-- /number -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Numbers -->

	<!-- Literacy and Numeracy Programme -->
	<div id="features" class="section md-padding bg-grey">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- why choose us content -->
				<div class="col-md-6">
					<div class="section-header">
						<h2 class="title">Jinjang Community</h2>
					</div>
					<p style='text-align: justify'>
							Jinjang Utara is littered with dilapidated rumah transit
							(supposed to be temporary housing). Currently, housing more than
							2000 people. These are forgotten people who became disillusioned
							and embittered. The inhabitants waited for 40 years to date, to
							be relocated to their new residence under Projek Perumahan (PPR)
							which has yet to happen. This is 38 years later than the promised
							duration by the government. Even if they are offered low cost
							housing tomorrow, they will not be able to afford it as they can
							hardly afford the RM40 per month rent even now. The average
							combined income per month for each family is less than RM1000.

					</p>
					<!--
					<div class="feature">
						<i class="fa fa-check"></i>
						<p>Quis varius quam quisque id diam vel quam elementum.</p>
					</div>
					<div class="feature">
						<i class="fa fa-check"></i>
						<p>Mauris augue neque gravida in fermentum.</p>
					</div>
					<div class="feature">
						<i class="fa fa-check"></i>
						<p>Orci phasellus egestas tellus rutrum.</p>
					</div>
					<div class="feature">
						<i class="fa fa-check"></i>
						<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
					</div>
				-->
				</div>
				<!-- /why choose us content -->



				<!-- About slider -->
				<div class="col-md-6">
					<div id="about-slider" class="owl-carousel owl-theme">
						<img class="img-responsive" src="./img/about_3.jpg" alt="">
						<img class="img-responsive" src="./img/about_4.jpg" alt="">
						<img class="img-responsive" src="./img/about_5.jpg" alt="">
						<img class="img-responsive" src="./img/about_6.jpg" alt="">
					</div>
				</div>
				<!-- /About slider -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Literacy and Numeracy Programme -->

	<!-- JinJang Community -->
	<div id="features" class="section md-padding bg-grey">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">
				<!-- About slider -->
				<div class="col-md-6">
					<div id="about-slider2" class="owl-carousel owl-theme">
						<img class="img-responsive" src="./img/about_1.jpg" alt="">
						<img class="img-responsive" src="./img/about_2.jpg" alt="">
						<img class="img-responsive" src="./img/about_1.jpg" alt="">
						<img class="img-responsive" src="./img/about_2.jpg" alt="">
					</div>
				</div>
				<!-- /About slider -->

				<!-- why choose us content -->
				<div class="col-md-6">
					<div class="section-header">
						<h2 class="title">Literacy and Numeracy Programme</h2>
					</div>
					<p style='text-align: justify'>
							Jinjang Numeracy Project is a project by the students and
							lecturers within Department of Management Studies. It is
							part of their community service.
							The students from HELP are preparing the curriculum to help
							teach basic mathematics to the children from Jinjang Utara
							Rumah Panjang. <br /> <br />
					</p>

				</div>
				<!-- /why choose us content -->


			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /JinJang Community -->




	<!-- Service -->
	<div id="service" class="section md-padding">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">How you can help</h2>
				</div>
				<!-- /Section header -->

				<!-- service -->
				<div class="col-md-4 col-sm-6">
					<div class="service">
						<i class="fa fa-handshake-o"></i>
						<h3>Volunteers</h3>
						<p>
							"Volunteer in helping the poor families send their children to
							school, helping the poor children in their studies and helping
							children learn new skills."
						</p><br />
					</div>
				</div>
				<!-- /service -->

				<!-- service -->
				<div class="col-md-4 col-sm-6">
					<div class="service">
						<i class="fa fa-book"></i>
						<h3>Learning Materials</h3>
						<p>
								"Helping in curriculum design/development, materials that we
								can use to teach these children. We need materials that can be
								used by teachers as well as workbooks for the children"
						</p>
					</div>
				</div>
				<!-- /service -->

				<!-- service -->
				<div class="col-md-4 col-sm-6">
					<div class="service">
						<i class="fa fa-child"></i>
						<h3>Sponsor A Child</h3>
						<p>"Sponsor at least RM150 per month which will cover the cost of
							school bus, daily lunch allowance and compulsory school fees"</p>
							<br /><br />
					</div>
				</div>
				<!-- /service -->

				<!-- service -->
				<div class="col-md-4 col-sm-6 col-md-offset-2">
					<div class="service">
						<i class="fa fa-female"></i>
						<h3>Empowering Mothers</h3>
						<p>"Empower mothers with the resources to work and earn a living
							without sacrificing their time with the family."</p>
							<br />
					</div>
				</div>
				<!-- /service -->

				<!-- service -->
				<div class="col-md-4 col-sm-6">
					<div class="service">
						<i class="fa fa-pencil"></i>
						<h3>Children School Supplies</h3>
						<p>"Donate school supplies such as beg, pencil case, water bottle
							to us."
						</p>
						<br />
					</div>
				</div>
				<!-- /service -->

				<!-- service -->
				<!--
				<div class="col-md-4 col-sm-6">
					<div class="service">
						<i class="fa fa-flask"></i>
						<h3>Brand Design</h3>
						<p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero.</p>
					</div>
				</div>
				-->
				<!-- /service -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Service -->

	<!-- Sponsor -->
	<div id="pricing" class="section md-padding bg-grey">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">Sponsor A Child</h2>
				</div>
				<!-- /Section header -->

				<!-- pricing -->
				<div class="col-sm-4">
					<div class="pricing">
						<div class="price-head">
							<span class="price-title">Basic sponsor plan</span>
							<div class="price">
								<h3>$100<span class="duration">/ month</span></h3>
							</div>
						</div>
						<ul class="price-content">
							<li>
								<p>Three meals (Breakfast, Lunch, Dinner)</p>
							</li>
							<li>
								<p><br /></p>
							</li>
							<li>
								<p><br /></p>
							</li>
						</ul>
						<div class="price-btn">
							<button class="outline-btn">Sponsor now</button>
						</div>
					</div>
				</div>
				<!-- /pricing -->

				<!-- pricing -->
				<div class="col-sm-4">
					<div class="pricing">
						<div class="price-head">
							<span class="price-title">Silver sponsor plan</span>
							<div class="price">
								<h3>$300<span class="duration">/ month</span></h3>
							</div>
						</div>
						<ul class="price-content">
							<li>
								<p>Three meals (Breakfast, Lunch, Dinner)</p>
							</li>
							<li>
								<p>School fees</p>
							</li>
							<li>
								<p><br /></p>
							</li>
						</ul>
						<div class="price-btn">
							<button class="outline-btn">Sponsor now</button>
						</div>
					</div>
				</div>
				<!-- /pricing -->

				<!-- pricing -->
				<div class="col-sm-4">
					<div class="pricing">
						<div class="price-head">
							<span class="price-title">Gold sponsor plan</span>
							<div class="price">
								<h3>$1000<span class="duration">/ month</span></h3>
							</div>
						</div>
						<ul class="price-content">
							<li>
								<p>Three meals (Breakfast, Lunch, Dinner)</p>
							</li>
							<li>
								<p>School fees</p>
							</li>
							<li>
								<p>Additional Expenses</p>
							</li>
						</ul>
						<div class="price-btn">
							<button class="outline-btn">Sponsor now</button>
						</div>
					</div>
				</div>
				<!-- /pricing -->

			</div>
			<!-- Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Pricing -->


	<!-- Testimonial -->
	<div id="testimonial" class="section md-padding">

		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('./img/background3.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Testimonial slider -->
				<div class="col-md-10 col-md-offset-1">
					<div id="testimonial-slider" class="owl-carousel owl-theme">

						<!-- testimonial -->
						<div class="testimonial">
							<div class="testimonial-meta">
								<img src="./img/perso1.jpg" alt="">
								<h3 class="white-text">Elon Musk</h3>
								<span>HR Manager</span>
							</div>
							<p class="white-text">Molestie at elementum eu facilisis sed odio. Scelerisque in dictum non consectetur a erat. Aliquam id diam maecenas ultricies mi eget mauris.</p>
						</div>
						<!-- /testimonial -->

						<!-- testimonial -->
						<div class="testimonial">
							<div class="testimonial-meta">
								<img src="./img/perso2.jpg" alt="">
								<h3 class="white-text">John Doe</h3>
								<span>CEO</span>
							</div>
							<p class="white-text">Molestie at elementum eu facilisis sed odio. Scelerisque in dictum non consectetur a erat. Aliquam id diam maecenas ultricies mi eget mauris.</p>
						</div>
						<!-- /testimonial -->

					</div>
				</div>
				<!-- /Testimonial slider -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Testimonial -->

	>

	<!-- Gallery -->
	<div id="portfolio" class="section md-padding bg-grey">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">Gallery</h2>
				</div>
				<!-- /Section header -->

				<!-- Work -->
				<div class="col-md-4 col-xs-6 work">
					<img class="img-responsive" src="./img/work_1.jpg" alt="">
					<div class="overlay"></div>
					<div class="work-content">
						<span>Category</span>
						<h3>Lorem ipsum dolor</h3>
						<div class="work-link">
							<a href="#"><i class="fa fa-external-link"></i></a>
							<a class="lightbox" href="./img/work_1.jpg"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
				<!-- /Work -->

				<!-- Work -->
				<div class="col-md-4 col-xs-6 work">
					<img class="img-responsive" src="./img/work_2.jpg" alt="">
					<div class="overlay"></div>
					<div class="work-content">
						<span>Category</span>
						<h3>Lorem ipsum dolor</h3>
						<div class="work-link">
							<a href="#"><i class="fa fa-external-link"></i></a>
							<a class="lightbox" href="./img/work_2.jpg"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
				<!-- /Work -->

				<!-- Work -->
				<div class="col-md-4 col-xs-6 work">
					<img class="img-responsive" src="./img/work_3.jpg" alt="">
					<div class="overlay"></div>
					<div class="work-content">
						<span>Category</span>
						<h3>Lorem ipsum dolor</h3>
						<div class="work-link">
							<a href="#"><i class="fa fa-external-link"></i></a>
							<a class="lightbox" href="./img/work_3.jpg"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
				<!-- /Work -->

				<!-- Work -->
				<div class="col-md-4 col-xs-6 work">
					<img class="img-responsive" src="./img/work_4.jpg" alt="">
					<div class="overlay"></div>
					<div class="work-content">
						<span>Category</span>
						<h3>Lorem ipsum dolor</h3>
						<div class="work-link">
							<a href="#"><i class="fa fa-external-link"></i></a>
							<a class="lightbox" href="./img/work_4.jpg"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
				<!-- /Work -->

				<!-- Work -->
				<div class="col-md-4 col-xs-6 work">
					<img class="img-responsive" src="./img/work_5.jpg" alt="">
					<div class="overlay"></div>
					<div class="work-content">
						<span>Category</span>
						<h3>Lorem ipsum dolor</h3>
						<div class="work-link">
							<a href="#"><i class="fa fa-external-link"></i></a>
							<a class="lightbox" href="./img/work_5.jpg"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
				<!-- /Work -->

				<!-- Work -->
				<div class="col-md-4 col-xs-6 work">
					<img class="img-responsive" src="./img/work_6.jpg" alt="">
					<div class="overlay"></div>
					<div class="work-content">
						<span>Category</span>
						<h3>Lorem ipsum dolor</h3>
						<div class="work-link">
							<a href="#"><i class="fa fa-external-link"></i></a>
							<a class="lightbox" href="./img/work_6.jpg"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
				<!-- /Work -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Gallery -->

	<!-- Blog -->
	<div id="blog" class="section md-padding bg-grey">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">Recent News</h2>
				</div>
				<!-- /Section header -->

				<!-- blog -->
				<div class="col-md-4">
					<div class="blog">
						<div class="blog-img">
							<img class="img-responsive" src="./img/blog_1.jpg" alt="">
						</div>
						<div class="blog-content">
							<ul class="blog-meta">
								<li><i class="fa fa-user"></i>Adeline Lum</li>
								<li><i class="fa fa-clock-o"></i>7 Jan 2015</li>
							</ul>
							<h3>Bringing the Plight of Children in Jinjang Utara to the
								Forefront: An Outdoor Christmas Party</h3>
							<p>On 3rd of January, Acts Global Networking (AGN) and Church of
								Acts threw an outdoor Christmas party for 1500 children at
								Padang Bolasepak</p>
							<a href="http://christianitymalaysia.com/wp/bringing-the-plight-of-children-in-jinjang-utara-to-the-forefront-an-outdoor-christmas-party/" target="_blank">Read more</a>
						</div>
					</div>
				</div>
				<!-- /blog -->

				<!-- blog -->
				<div class="col-md-4">
					<div class="blog">
						<div class="blog-img">
							<img class="img-responsive" src="./img/blog_2.jpg" alt="">
						</div>
						<div class="blog-content">
							<ul class="blog-meta">
								<li><i class="fa fa-user"></i>Adeline Lum</li>
								<li><i class="fa fa-clock-o"></i>24 Dec 2015</li>
							</ul>
							<h3>Liberating the Illiterate – Holiday Education for the Poor Children of Jinjang Utara</h3>
							<p>During this year-end school holiday, Acts Global Networking
								(AGN) launched a three-day English literacy programme from 7th
							</p>
							<a href="https://christianitymalaysia.com/wp/liberating-the-illiterate-holiday-education-for-the-poor-children-of-jinjang-utara/" target="_blank">Read more</a>
						</div>
					</div>
				</div>
				<!-- /blog -->

				<!-- blog -->
				<div class="col-md-4">
					<div class="blog">
						<div class="blog-img">
							<img class="img-responsive"  src="./img/blog_3.jpg" alt="">
						</div>
						<div class="blog-content">
							<ul class="blog-meta">
								<li><i class="fa fa-user"></i>Dereck Lim</li>
								<li><i class="fa fa-clock-o"></i>31 Dec 2017</li>
							</ul>
							<h3>Bringing Hope to Jinjang Utara</h3>
							<p>Jinjang, KL – 2 December – The children (and parents)
								of Jinjang Utara with great delight descended upon
								Padang Taman Aman Putra where a massive Christmas and
								Back-to-school party was organised especially for them.
								Anticipation filled the </p>
							<a href="https://christianitymalaysia.com/wp/bringing-hope-to-jinjang-utara/" target="_blank">Read more</a>
						</div>
					</div>
				</div>
				<!-- /blog -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Blog -->

	<!-- Contact -->
	<div id="contact" class="section md-padding">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section-header -->
				<div class="section-header text-center">
					<h2 class="title">Get in touch</h2>
				</div>
				<!-- /Section-header -->

				<!-- contact -->
				<div class="col-sm-4">
					<div class="contact">
						<i class="fa fa-phone"></i>
						<h3>Phone</h3>
						<p>+60 16-367-2568</p>
					</div>
				</div>
				<!-- /contact -->

				<!-- contact -->
				<div class="col-sm-4">
					<div class="contact">
						<i class="fa fa-envelope"></i>
						<h3>Email</h3>
						<p>agn@support.com</p>
					</div>
				</div>
				<!-- /contact -->

				<!-- contact -->
				<div class="col-sm-4">
					<div class="contact">
						<i class="fa fa-map-marker"></i>
						<h3>Address</h3>
						<p>1739 Bubby Drive</p>
					</div>
				</div>
				<!-- /contact -->

				<!-- contact form -->
				<div class="col-md-8 col-md-offset-2">
					<form class="contact-form">
						<input type="text" class="input" placeholder="Name">
						<input type="email" class="input" placeholder="Email">
						<input type="text" class="input" placeholder="Subject">
						<textarea class="input" placeholder="Message"></textarea>
						<button class="main-btn">Send message</button>
					</form>
				</div>
				<!-- /contact form -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Contact -->


	<!-- Footer -->
	<footer id="footer" class="sm-padding bg-dark">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<div class="col-md-12">

					<!-- footer logo -->
					<div class="footer-logo">
						<a href="index.html"><img src="img/logo-alt.png" alt="logo"></a>
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


	<?php
	if ($_SESSION['SignUp'] == "failed") {
		echo "<script>alert('sign up failed');</script>";
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

	<?php
	if (isset($_SESSION['searchValue'])) {
		unset($_SESSION['searchValue']);
	}
	?>
</body>

</html>

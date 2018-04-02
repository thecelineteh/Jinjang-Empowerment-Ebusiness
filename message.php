<?php
  session_start();
  include 'dbConnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>JinJang E-Business</title>

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
	.panel > .panel-heading {
		background-image: none;
		background-color: #6195FF;
		color: white;
	}
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
			<!-- for both Job Seeker and Client -->
			<ul class="main-nav nav navbar-nav navbar-right">
				<li><a href="#home" onclick='resetJob()'><i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li><a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li class="active"><a href="#message"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li><a href="#application"><i class="fa fa-suitcase"></i>&nbsp;Application</a></li>
				<li><a href="index.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>
			<!-- /Main navigation -->

		</div>
	</nav>
	<!-- /Nav -->


	<div class="container">
		<div class="row">
			<button style="margin-top: 2em;"class="btn btn-success" type="button"
      onclick="window.open(href='sendMessage.php')" target="_blank">New Message</button>
			<div class="panel panel-primary"  style='border-radius: 10px; margin-top:1em; border: none;'>
		    <div class="panel-heading" style = "text-align: center; font-size: 20px;
		    border-radius: 10px 10px 0 0;">Inbox</div>
		    <div class="panel-body" style="padding: 0;">
					<div id="myTable" class="table-responsive">
		        <table class="table table-hover">
		          <thead style="">
		            <tr>
		              <th class='col-xs-3'>Sender</th>
		              <th class='col-xs-5'>Subject</th>
		              <th class='col-xs-3'>Time</th>
									<th class='col-xs-2'>Actions</th>
		            </tr>
		          </thead>
							<tbody>
								<?php
									$userID = $_SESSION['userID'];
			            $query = "SELECT * FROM message, user WHERE
									message.sender = user.userID AND
									receiver = '$userID'";
			            $result = mysqli_query($connection, $query);
			            if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
											echo "<form id='myForm' action='' method='post' target='_blank'>";
											echo "<tr style='cursor:;'>";
											$_SESSION['senderID'] = $row['sender'];
											echo "<input type='hidden' value='" . $row['sender'] . "'
											name='senderID'/>";
											if ($row['userType'] == "Job Seeker") {
												$senderID = $_SESSION['senderID'];
												$query2 = "SELECT * FROM user, jobseeker WHERE
												user.userID = jobseeker.userID AND
												user.userID = '$senderID'";
												$result2 = mysqli_query($connection, $query2);

												if (mysqli_num_rows($result2) > 0) {
													while ($row2 = mysqli_fetch_assoc($result2)) {
														echo "<td>" . $row2['fullName'] . "</td>";
														echo "<input type='hidden' value='" . $row2['fullName'] . "'
														name='senderName'/>";
													}
												}

											}
											else if($row['userType'] == "Client") {
												$senderID = $_SESSION['senderID'];
												$query2 = "SELECT * FROM user, client WHERE
												user.userID = client.userID AND
												user.userID = '$senderID'";
												$result2 = mysqli_query($connection, $query2);

												if (mysqli_num_rows($result2) > 0) {
													while ($row2 = mysqli_fetch_assoc($result2)) {
														echo "<td>" . $row2['companyName'] . "</td>";
														echo "<input type='hidden' value='" . $row2['companyName'] . "'
														name='senderName'/>";
													}
												}
											}

											echo "<td>" . $row['subject'] . "</td>";
											echo "<input type='hidden' value='" . $row['subject'] . "'
											name='subject'/>";
											echo "<td>" . $row['date'] . "</td>";
											echo "
												<td>
												<button data-toggle='tooltip' data-placement='top' title='View Message' onclick='viewMessage()'
												style='border: none; padding: 0; background: none;'>
												<a><i class='fa fa-envelope-open-o'></i></a>
												</button>
												&nbsp;&nbsp;
												<button data-toggle='tooltip' data-placement='top' title='Reply' onclick='replyMessage()'
												style='border: none; padding: 0; background: none;'>
												<a><i class='fa fa-mail-reply'></i></a>&nbsp;&nbsp;
												</button>
												<a href='index.php' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-trash-o'></i></td>
											";

											echo "</tr>";
											echo "</form>";
										}
									}

								?>
						  </tbody>
						</table>
					</div>
				</div>

		</div>
	</div>

  <!-- End of Modal -->
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

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
  $(document).ready(function(){
    $('table tbody tr').click(function(){
      //var tableID = "t" + this.id;
      //document.getElementById(tableID).submit();
			//window.location.href = "job.php";
			//alert('hello world');
    });
  });
  </script>
	<script>
		form=document.getElementById("myForm");
		function viewMessage() {
		        form.action="showMessage.php";
		        form.submit();
		}
		function replyMessage() {
		        form.action="sendMessage.php";
		        form.submit();
		}

	</script>
</body>
</html>

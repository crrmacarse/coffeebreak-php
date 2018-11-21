<?php

	session_start();
	include('library/form/connection.php');
	$db = new db();
	
	if(isset($_SESSION['USER_USERNAME']) and isset($_SESSION['USER_GROUPID']))
	{
		if($_SESSION['USER_GROUPID'] !=  '1' AND $_SESSION['USER_GROUPID'] != '2')
		{
			
        header('location: login.php');

   
		}
	}
	else {
		header('location: login.php');
        exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coffeebreak Caf&eacute; International Inc. | CMS</title>

    <!-- Bootstrap core CSS -->
    <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 
    <!-- Custom fonts for this template -->
    <link href="library/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css">

    <!-- Custom styles for this template -->
	
    <link href="css/grayscale.min.css" rel="stylesheet">
	<link href="css/mystyles.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navbar Section -->
    <?php include('library/html/navbar.php'); ?>  

	  
<!--     CMS Section -->
    <section id="CMS" class="CMS-section text-center">
      <div class="container">
		   <div class="row">
			   <div class = "col-lg-12">
					<header class = "pull-right">
						<span style="font-family:'HelveticaBlkFile', sans-serif; font-size: 3.5em;; color:#d7933c;">coffee</span><span id="fadelogostretch" style="font-family:'Helvetica45File', sans-serif; font-size: 3.5em;;color:#d7933c;">break</span>
							<p>Content Management System</p>
					</header>
			   </div>
		  </div>
		  
		  <div class ="row">
			  <div class="col-lg-4">
				<div class="card" style = "margin-bottom: 10px;">
				  <div class="card-block">
					  <br>
					<h5 class="card-title">Menu Management</h5>
					<p class="card-text">Manage the Menu Profile</p>
					<a id="buttonMain" href="manage-menu.php" style="vertical-align:middle; margin-bottom: 35px; background-color: #ffb24a; border: 2px solid #ffb24a;" role="button"><span>Manage</span></a>
				  </div>
				</div>
			  </div>
			  <div class="col-lg-4">
				<div class="card" style = "margin-bottom: 10px;">
				  <div class="card-block">
					  <br>
					<h5 class="card-title">News Management</h5>
					<p class="card-text">Manage and Update News</p>
					<a id="buttonMain" href="manage-news.php" style="vertical-align:middle; margin-bottom: 35px; background-color: #004085 ; border: 2px solid #004085;" role="button"><span>Manage</span></a>
				  </div>
				</div>
			  </div>
			  <div class="col-lg-4">
				<div class="card" style = "margin-bottom: 10px;">
				  <div class="card-block">
					  <br>
					<h5 class="card-title">Advertisement Management</h5>
					<p class="card-text">Upload New Advertisement</p>
					<a id="buttonMain" href="manage-advert.php" style="vertical-align:middle; margin-bottom: 35px; background-color: #212529 ; border: 2px solid #212529;" role="button"><span>Manage</span></a>
				  </div>
				</div>
			  </div>
			  <div class="col-lg-4">
				<div class="card" style = "margin-bottom: 10px;">
				  <div class="card-block">
					  <br>
					<h5 class="card-title">Store Management</h5>
					<p class="card-text">Add or Update new Store to the System</p>
					<a id="buttonMain" href="manage-store.php" style="vertical-align:middle; margin-bottom: 35px;" role="button"><span>Manage</span></a>
				  </div>
				</div>
			  </div>
			</div>
		</div>
    </section>
	  
	<!-- Footer Section -->
    <?php include('library/html/footer.php'); ?>  
	  
    <!-- Bootstrap core JavaScript -->
    <script src="library/jquery/jquery.min.js"></script>
    <script src="library/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="library/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>
	<script src="js/mylibrary.js"></script>
	
	<!-- Font Awesome CDN for mini icons-->
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


  </body>

</html>

<script>

	
</script>

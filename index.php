<?php

	session_start();
	include('library/form/connection.php');
	$db = new db();

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coffeebreak Caf&eacute; International Inc.</title>

    <!-- Bootstrap core CSS -->
    <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 
    <!-- Custom fonts for this template -->
    <link href="library/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css">

    <!-- Custom styles for this template -->
	
    <link href="css/grayscale.min.css" rel="stylesheet">
	<link href="css/mystyles.css" rel="stylesheet">
	  
	<!-- Swiper Plug-in CSS -->
	<link rel="stylesheet" href="css/swiper.min.css">
	  
  </head>
	
	<!-- Modal -->
	 <div class="modal fade" id="advertisementModal" role="dialog">
		<div class="modal-dialog">

		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  
			  <h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
			  <p>Some text in the modal.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		  </div>

		</div>
  	</div>
  

	<!--	Container starts here -->
  <body id="page-top">

	<!-- Navigation -->
    <?php include('library/html/navbar.php'); ?>
	  
    <!-- Intro Header -->
    <header class="masthead">
      <div class="intro-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto">
              <a href="#carouselAdvertisement" class="btn btn-circle js-scroll-trigger mainButtonDown">
                <i class="fa fa-angle-double-down animated"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>
	
	<!--  Carousel Advertisement-->
	<div id="carouselAdvertisement" class="advertisement-section text-center carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators" id = "advertIndicatorList">
		  </ol>
		  <div class="carousel-inner" id = "advertImageList">
			
		  </div>
		  <a class="carousel-control-prev" href="#carouselAdvertisement" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselAdvertisement" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
	</div>
	  
	<!-- Menu Section -->
    <section id="menu" class="menu-section">
      <div class="container">
        <div class = "row">
		  <div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h4 id = "menuSectionTitle"> Menu Offerings</h4>
		  </div>  
			  <div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<span id = "menuSearchBar" class="input-group pull-right">	
					   <input type="search" name = "search" class="form-control" placeholder="Search Menu..." id="txtSearch"/>
						   <span class="input-group-btn">
									<button id = "searchBar" class="btn btn-primary" type="submit">
									<i class="fas fa-search"></i>
								</button>

						   </span>
				 </span> 
			 </div>
			</div>

			<div class = "row">
				<br />
				<div class = "col-lg-3">
				</div>
				<?php
				
					$sql = "SELECT product_item.ID, product_item.NAME AS MENUNAME, product_item.DESCRIPTION, product_item.IMAGE, product_item.RECOMMENDATION, product_group.NAME
					
					FROM product_item 
					
					INNER JOIN product_group 
					ON product_item.GROUPID = product_group.ID 
					ORDER BY RAND()  
					LIMIT 1";
					$result = $db->connection->query($sql);
					$count = mysqli_num_rows($result);
					while($row = $result->fetch_assoc())
					{
					?>
				
					<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
			  		<img class="img-fluid" src="img/menu/<?php echo $row['IMAGE'] ?>" alt="">
					</div>
					<div class = "col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<p id = "mainMenuTitle"><?php echo $row['MENUNAME'] ?></p>
						<p id = "mainMenuTitleLower"><?php echo $row['RECOMMENDATION'] ?></p>

						<p id = "mainMenuDescript"><?php echo $row['DESCRIPTION'] ?></p>
						<a href = "menu.php">
							<button role = "button" id = "mainMenuButtonSeemore" class = "btn btn-dark">More Choices</button>
						</a>
					</div>
				
					<?php
					}
						?>
				
    		</div>
		  		
		  </div>
    </section>
	  
	
	
	  
	<!-- Wifi Section -->
	<section id="wifiSection" class="wifiSection-section content-section text-center">
     <div class="container">
		 <div class = "row">
			 <div class = "col-lg-1">
			
			 </div>
			 <div class = "col-lg-8 col-md-12 col-sm-12 col-xs-12">
			 	<p id = "wifiMainTitle">
					At 
					<span style="font-family:'HelveticaBlkFile', sans-serif; font-size: 1.4em;; color:#d7933c;">coffee</span><span id="fadelogostretch" style="font-family:'Helvetica45File', sans-serif; font-size: 1.4em;;color:#d7933c;">break</span>
					you need not to compromise on being productive while feeding your caffeine-fix.
                </p>
				<p id = "wifiDescript">
					Avail to our Wifi now!
				</p>
			 </div>
			<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 col-lg-offset-1">
				<span class = "pull-right" style ="margin-top: 80px;">
					<a id = "buttonMain" href="https://coffeebreak.ph/portal/" style="vertical-align:middle" role="button"><span>Wifi Log-in </span></a>
				</span>
			</div>
		</div>
	 </div>
    </section>
		 
	<!--  Footer Section -->
		
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
	
	<!-- Swiper Plug-in -->
	<script src="js/swiper.min.js"></script>

  </body>

</html>

<script>
	
    
	$(document).ready(function(){
		$("#txtSearch").click(function(){
			this.value = '';
			 $( "#searchBar" ).click(function() {
			  var searchValue = $("#txtSearch").val().toLowerCase();
			  jQuery('#txtSearch').empty();
			  
				window.location.href='menu.php?search='+searchValue;
				 
				});

				$('#txtSearch').keypress(function(e){
				if(e.which == 13){//Enter key pressed
					$('#searchBar').click();//Trigger search button click event
				}
			});
		});
	});
	
	
	function appendAdvertContent(id, name, image, status)
	{
		var content1 = '<li data-target="#carouselAdvertisement" data-slide-to="' + id + '" class="active"></li>';
		
		var content2 = '<div id = "carouselID" class="carousel-item">'+
			'<a href = "#">'+
			'<img class="d-block w-100 img-fluid" src="img/advert/' + image + '" alt="' + name + '">'+
			'</a>'+
			'</div>';
		
		$("#advertIndicatorList").append(content1);
		$("#advertImageList").append(content2);
		
	}
	
	<?php
	  
		$sql_ADVERT = "SELECT advertisement.ID, advertisement.NAME, advertisement.IMAGE, advertisement.STATUS 

						FROM advertisement

						WHERE advertisement.STATUS = 1";

		$result_ADVERT = $db->connection->query($sql_ADVERT);
		$count_ADVERT = mysqli_num_rows($result_ADVERT);
		$counter = 0;
		while($row_ADVERT = $result_ADVERT->fetch_assoc())
		{
			$result_ID = htmlspecialchars($row_ADVERT['ID']);
			$result_NAME = htmlspecialchars($row_ADVERT['NAME']);
			$result_IMAGE = htmlspecialchars($row_ADVERT['IMAGE']);
			$result_STATUS = htmlspecialchars($row_ADVERT['STATUS']);
			
			if($counter == 1)
			{
				?>
				$("#carouselID").addClass("active");
				<?php
			}
			?>
	
			appendAdvertContent("<?php echo $result_ID ?>","<?php echo $result_NAME ?>","<?php echo $result_IMAGE ?>","<?php $result_STATUS ?>");
			
		<?php
			$counter++;
		}
	?>
	
</script>

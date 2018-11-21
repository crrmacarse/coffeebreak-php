<?php

	session_start();
	include('library/form/connection.php');
	$db = new db();

	$search = isset($_GET['search']) ? $_GET['search'] : '';
	$limit = 12;

	$total_sql = 'SELECT * FROM productitem WHERE PIStatus = 1 && PIName LIKE "%'.$search.'%"';
	$total_result = $db->connection->query($total_sql);
	$total_count = mysqli_num_rows($total_result);
	$total_page = ceil($total_count/$limit);

	$page = isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $total_page ? $_GET['page'] : '1';
	$offset = ($page * $limit) - $limit;
	

	if($page < 2) {
		$disable_previous = 'disabled';
		$disable_previous2 = 'pointer-events: none; color: #6c7585;';
	}
	else {
		$disable_previous = '';
		$disable_previous2 = '';
	}

	if($total_page == $page || $total_page < 1) {
		$disable_next = 'disabled';
		$disable_next2 = 'pointer-events: none; color: #6c7585;';
	}
	else {
		$disable_next = '';
		$disable_next2 = '';
	}

?>


<!DOCTYPE html>
<html lang="en">
	

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coffeebreak Caf&eacute; International Inc. | Menu</title>

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

	<!-- Menu Section -->
    <section id="menuMain" class="menuMain-section">
      <div class="container">
        <div class = "row">
		  <div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h4 id = "menuSectionTitle">Menu Offerings</h4>
		  </div>  
		  <div class = "col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<span id = "menuSearchBar" class="input-group pull-right">
				   <input id="menuSearch" type="text" class="form-control" placeholder="Search Menu..." />
					   <span class="input-group-btn">
						<button id = "searchBar" class="btn btn-primary" type="submit">
							<i class="fas fa-search"></i>
							</button>
					   </span>
			 </span> 
	 	 </div>
		</div>
		 <div class = "row row-adjust">
		  <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<span id = "menuFilter">
			  <a href = "#">All</a>	
				<span class = "pull-right">
						<a href = "#">Coffee</a>
						<a href = "#">Chocolate</a>
						<a href = "#">Tea</a>
						<a href = "#">Smoothies</a>
				</span>	
			</span>
		   </div>
		  </div>
		  <div class="row">
			 <?php 
                            $sql = 'SELECT idproductitem, PIName, PIDesc, PIStatus 
									
									FROM productitem 
									
									WHERE PIStatus = 1
									
									ORDER BY PINAME
									LIMIT ' .$limit.'
									OFFSET '.$offset;
                            $result = $db->connection->query($sql);
                            $count = mysqli_num_rows($result);
                            while($row = $result->fetch_assoc()){
                                ?>
			  				<div class="col-lg-3 col-md-4 mb-4">
            				 <div class="card h-100">
								<a href="#"><img class="card-img-top" src="img/menu/test6.png" alt=""></a>
								   <div class="card-body">
                 					 <h4 class="card-title">
										  <a id = "menuName" href="#"><?php echo $row['PIName']; ?></a>
									</h4>
									   <p class="card-text menuMainDescript"><?php echo $row['PIDesc']; ?></p>
									</div>
									<div class="card-footer">
										<span style = "color: #721c24;" class="pull-right">
										  <i class="fas fa-coffee"></i>
										</span>
									</div>
								  </div>
								</div>
				  			<?php      
								}
			  				?>
          </div>
		  <div class = "row">
		  	<div class = "col-lg-3 col-md-3 col-sm-3 col-xs-3 mx-auto">
			  <nav aria-label="...">
				  <ul class="pagination pagination-sm">
					
					 <li class="page-item">
					  <a class="page-link <?php echo $disable_previous; ?>" style="<?php echo $disable_previous2; ?>" href="menu.php?search=<?php echo $search; ?>&page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
					</li>
					<?php   	
					  	for($i = 1; $i <= $total_page; $i++)
						{
							?>
					  	<li id = "paginationActive<?php echo $i; ?>" class="page-item">
							<a class="page-link" href="menu.php?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
					    </li>
					  
					  <?php
						}
					  ?>
					
					<li class="page-item">
					  <a class = "page-link <?php echo $disable_next; ?>" style="<?php echo $disable_next2; ?>" href="menu.php?search=<?php echo $search; ?>&page=<?php echo $page + 1; ?>" >Next</a>
					</li>
				  </ul>
				</nav>
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
	
	$(document).ready(function(){
	  $("#paginationActive<?php echo $page ?>").addClass("active");
	  $("#menuSearch").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		
		  alert(value);
	  });
	});
	
	
</script>

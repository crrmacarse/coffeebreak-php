<?php

	session_start();
	include('library/form/connection.php');
	$db = new db();

	$search = isset($_GET['search']) ? '%'.$_GET['search'].'%' : '%'.''.'%';
	$limit = 12;
	$category = isset($_GET['category']) ? $_GET['category'] : '';

	$total_sql = 'SELECT * FROM product_item WHERE STATUS = 1 && NAME LIKE "%'.$search.'%"';
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
		  <div id = "menuList" class="row">
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
	
	  var PageComponent = {
        menu: document.getElementById('menuList')
    };
	
	$(document).ready(function(){
		$("#paginationActive<?php echo $page ?>").addClass("active");
		$("#menuSearch").val('<?php echo trim($search,'%') ?>');
		$("#menuSearch").click(function(){
			this.value = '';
			 $( "#searchBar" ).click(function() {
			  jQuery('#menuSearch').empty();
			  var searchValue = $("#menuSearch").val().toLowerCase(); 
				window.location.href='menu.php?search='+searchValue;
				 
				});

				$('#menuSearch').keypress(function(e){
				if(e.which == 13){//Enter key pressed
					$('#searchBar').click();//Trigger search button click event
				}
			});
		});
	});
	
	
	function AddMenu(id, name, descript, image, status, recommendation, groupname) {
        PageComponent.menu.innerHTML = PageComponent.menu.innerHTML +
            '<div class="col-lg-3 col-md-4 mb-4">' +
            '<div class="card h-100">'+
			'<a href="#"><img class="card-img-top" src="img/menu/' + image + '" alt=""></a>'+
			'<div class="card-body">'+
            '<h4 class="card-title"><a id = "menuName" href="#">' + name +'</a></h4>'+
            '<p class="card-text menuMainDescript">' + descript + '</p></div>'+
			'<div class="card-footer">' + recommendation + '<span style = "color: #721c24;" class="pull-right">' + groupname + '</span></div>'+
            '</div></div>';
    }
	
	<?php
		
		$sql_script = "SELECT product_item.ID, product_item.NAME, product_item.DESCRIPTION, product_item.RECOMMENDATION, product_item.IMAGE, product_item.STATUS, product_group.NAME AS GROUPNAME 

							FROM product_item 

							INNER JOIN product_group
							ON product_item.GROUPID = product_group.ID

							WHERE product_item.STATUS = 1

							&& product_item.NAME LIKE ?
							ORDER BY product_item.NAME 
							LIMIT ?
							OFFSET ?";
	
		$list_sql = $db->connection->prepare($sql_script);
		$list_sql->bind_param('sss', $search, $limit, $offset);
		$list_sql->execute();
		$list_sql->bind_result($id,$name,$description,$recommendation,$image,$status,$groupname);
		
		 	
		//$list_result = $list_sql->get_result();

		while($list_sql->fetch()){
				$result_ID = $id;
				$result_NAME = $name;
				$result_IMAGE = $image;
				$result_DESCRIPTION = $description;
				$result_STATUS = $status;
				$result_RECOMMENDATION = $recommendation;
				$result_GROUPNAME = $groupname;
		?>

		AddMenu("<?php echo $result_ID; ?>","<?php echo $result_NAME; ?>","<?php echo $result_DESCRIPTION; ?>","<?php echo $result_IMAGE ?>","<?php echo $result_STATUS; ?>","<?php echo $result_RECOMMENDATION ?>","<?php echo $result_GROUPNAME; ?>");

		<?php
			}
	?>




		
	
</script>

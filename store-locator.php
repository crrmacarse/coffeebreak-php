<?php

	session_start();
	include('library/form/connection.php');
	$db = new db();

?>

<!doctype html>
<html>
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
	
</head>

<body>
	
	<?php include('library/html/navbar.php'); ?>
	
	<section id="googleMap" class="googleMap-section content-section text-center">
     <div class="container">
		 <div class = "row">
			<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div id = "googleMapSearchBar" class="input-group">
				   <input type="text" class="form-control" placeholder="Store Locator.." id="branchSearch"/>
					   <div class="input-group-btn">
						<button id = "searchBar" class="btn btn-primary" type="submit">
							<i class="fas fa-search"></i>
							</button>
					   </div>
			 	</div> 
			
				
				<div class="card" style="width: 18rem;">
				  <ul id = "searchResult" class="list-group list-group-flush">
					
				  </ul>
				</div>

			 </div>
			<div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<h2 class = "pull-right"> Store Locator</h2>
				<div id = "map"></div>

			</div>
		</div>
      </div>
    </section>
	
	
	<?php include('library/html/footer.php'); ?>
	
	
</body>
 
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
	
	<!-- Google map -->
	<script async defer
		  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJbpjI8KS7fzlHYDjIBeOL8TkPfEhXUSk&callback=initMap">
	 </script>

</html>

<script>
	
	var map;
	
	  var branches = [
			<?php 
			
				$sql = "SELECT store.NAME, store.ADDRESS, coordinates.LAT, coordinates.LNG, coordinates.ZINDEX, store.CONTACT, store.ISWIFI, store.ISPARKING, store.HOUROPERATION, store.STATUS 
				
				FROM store 
				
				INNER JOIN coordinates 
				ON coordinates.ID = store.COORDINATES
				
				WHERE store.STATUS = 1";
			
				$result = $db->connection->query($sql);
			  	$count = mysqli_num_rows($result);
				
				while($row = $result->fetch_assoc())
				{
					?>
					 ['Coffeebreak <?php echo $row['NAME']; ?>', <?php echo $row['LAT']; ?>, <?php echo $row['LNG']; ?>, <?php echo $row['ZINDEX']; ?>],
				<?php
				}
			?>
      	];
		
	function initMap() {
      
         map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 10.707061, lng: 122.5473598}	
        });
		
		
		for(var i = 0; i < branches.length; i++)
			{
				var branch = branches[i];
				var marker = new google.maps.Marker({
					position: {lat: branch[1],lng: branch[2]},
					map: map,
					title: branch[0],
					zIndex:branch[3] 
				});
			}
   
      }
	
	$(document).ready(function(){
		$("#branchSearch").click(function(){
			this.value = '';
			 $( "#searchBar" ).click(function() {
			  var branchItem = $("#branchSearch").val().toLowerCase();
			  jQuery('#searchResult').empty();
			  var content = '';
					$.each(branches, function( index, value ) {
							if(value[0].toLowerCase().indexOf(branchItem) != -1)
							{

							  content += '<li class="list-group-item">'+ 
								'<a href = "#" id = "searchResultSingle" onclick="return mapFocus('+value[1]+','+value[2]+');">'+value[0]+'<br><small style = "color:'+ 'black"></small></a></li>';
							}		
					});
				  $("#searchResult").append(content);	

				});

				$('#branchSearch').keypress(function(e){
				if(e.which == 13){//Enter key pressed
					$('#searchBar').click();//Trigger search button click event
				}
			});
		});
	});
	
	function mapFocus(lat,lang)
	{
		var latLng = new google.maps.LatLng(lat, lang); //Makes a latlng
		map.setZoom(16);
      	map.panTo(latLng); //Make map global
	}

	

</script>


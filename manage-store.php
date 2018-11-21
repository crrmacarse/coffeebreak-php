<?php
	
	session_start();
	include('library/form/connection.php');
	$db = new db();
	
	if(isset($_SESSION['USER_USERNAME']) and isset($_SESSION['USER_GROUPID']))
	{
		if($_SESSION['USER_GROUPID'] !=  '1' AND $_SESSION['USER_GROUPID'] != '2')
		{
			
        echo '<html style="awidth: 100%; height: 100%; margin: 0px; padding: 0px;"> <head> <title>Page not Availble</title><link rel="icon" href="img/favicon.ico"></head> <body style="width: 100%; height: 100%; margin: 0px; padding: 0px; text-align: center; background-color: #454551; color: lightgray;"> <div style="width: 100%; height: 100%; margin: 0px; padding: 0px; vertical-align: middle; display: table;"> <div style="width: 100%; height: 100%; margin: 0px; padding: 0px; vertical-align: middle; display: table-cell;"> 

            <h1><a href = "https://www.google.com.ph/search?q=get+a+life&rlz=1C1GCEA_enPH782PH782&oq=get+a+life&aqs=chrome..69i57.1191j0j1&sourceid=chrome&ie=UTF-8" style = "font-size: 50px; color: lightgray; text-decoration:none;"> 403 Forbidden</a></h1> <h4> u got access denied boi</h4> </div> </div> </body> </html>';
        exit;
   
		}
	}
	else {
		echo '<html style="awidth: 100%; height: 100%; margin: 0px; padding: 0px;"> <head> <title>Page not Availble</title><link rel="icon" href="img/favicon.ico"></head> <body style="width: 100%; height: 100%; margin: 0px; padding: 0px; text-align: center; background-color: #454551; color: lightgray;"> <div style="width: 100%; height: 100%; margin: 0px; padding: 0px; vertical-align: middle; display: table;"> <div style="width: 100%; height: 100%; margin: 0px; padding: 0px; vertical-align: middle; display: table-cell;"> 

            <h1><a href = "https://www.google.com.ph/search?q=get+a+life&rlz=1C1GCEA_enPH782PH782&oq=get+a+life&aqs=chrome..69i57.1191j0j1&sourceid=chrome&ie=UTF-8" style = "font-size: 50px; color: lightgray; text-decoration:none;"> 403 Forbidden</a></h1> <h4>  u got access denied boi</h4> </div> </div> </body> </html>';
        exit;
	}

	$search = isset($_GET['search']) ? $_GET['search'] : '';
	$limit = 12;

	$total_sql = 'SELECT * FROM store WHERE NAME LIKE "%'.$search.'%"';
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

    <title>Coffeebreak Caf&eacute; International Inc. | Manage Stores</title>

    <!-- Bootstrap core CSS -->
    <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 
    <!-- Custom fonts for this template -->
    <link href="library/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css">

    <!-- Custom styles for this template -->
	
    <link href="css/grayscale.min.css" rel="stylesheet">
	<link href="css/mystyles.css" rel="stylesheet">
	<link href="css/map.css" rel="stylesheet">
	  
  </head>
	
	
	<!-- Add Store Modal -->
	 <div class="modal fade" id="addStoreForm_MODAL" role="dialog">
		<div class="modal-dialog">
			<form id="addStoreForm" method="post" action="library/form/addStoreForm.php">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
				<h5>Add Store</h5>
			</div>
			<div class="modal-body">
				<input type="hidden" id="addStoreForm_ID" name="ID" required />
				<input type="hidden" id="addStoreForm_LAT" name="LAT" required />
				<input type="hidden" id="addStoreForm_LNG" name="LNG" required />
				<input type="hidden" id="addStoreForm_ZINDEX" name="ZINDEX" required />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
							  </div>
							  <input id = "addStoreForm_NAME" name = "NAME" type="text" class="form-control" placeholder="Store Name" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Address</span>
							  </div>
							  <input id = "addStoreForm_ADDRESS" name = "ADDRESS" type="text" class="form-control" placeholder="Complete Address" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Contact</span>
							  </div>
							  <input id = "addStoreForm_CONTACT" name = "CONTACT" type="number" class="form-control" placeholder="Contact Number" aria-describedby="sizing-addon2" required>
						</div>
						<br />
							<div id = "addStoreForm_MAP">
								
							</div>
						</br>
						<div class = "input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Wifi Connected?</span>
							  </div>
							&nbsp;&nbsp;
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" class="form-control" name="ISWIFI" id="addStoreForm_ISWIFI" value="1" required checked>
							  <label class="form-check-label" for="addStoreForm_ISWIFI">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" class="form-control" name="ISWIFI" id="addStoreForm_ISWIFI" value="0">
							  <label class="form-check-label" for="addStoreForm_ISWIFI">No</label>
							</div>
						</div>
						<br />
						<div class = "input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">With Parking?</span>
							  </div>
							&nbsp;&nbsp;
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="ISPARKING" class="form-control" id="addStoreForm_ISPARKING" value="1" required checked>
							  <label class="form-check-label" for="addStoreForm_ISPARKING">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="ISPARKING" class="form-control" id="addStoreForm_ISPARKING" value="0">
							  <label class="form-check-label" for="addStoreForm_ISPARKING">No</label>
							</div>
						</div>
			  			<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Hour Operation</span>
							  </div>
							  <input id = "addStoreForm_HOUROPERATION" name = "HOUROPERATION" type="text" class="form-control" placeholder="XXam - XXpm" aria-describedby="sizing-addon2" required>
						</div>	
					</div>
					<div class="modal-footer">
						<button type="submit" id="addStoreForm_SUBMIT" class="btn btn-primary" data-loading-text="Adding..."> Add</button>
						 <button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
					</div>
			  </div>
			</form>
		</div>
  	</div>

 <!-- Update Store Modal -->
	 <div class="modal fade" id="updateStoreForm_MODAL" role="dialog">
		<div class="modal-dialog">
			<form id="updateStoreForm" method="post" action="library/form/updateStoreForm.php">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
				<h5>Update Store</h5>
			</div>
			<div class="modal-body">
				<input  id="updateStoreForm_ID" name="ID" required />
				<input  id="updateStoreForm_LAT" name="LAT" required />
				<input  id="updateStoreForm_LNG" name="LNG" required />
				<input  id="updateStoreForm_ZINDEX" name="ZINDEX" required />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
							  </div>
							  <input id = "updateStoreForm_NAME" name = "NAME" type="text" class="form-control" placeholder="Store Name" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Address</span>
							  </div>
							  <input id = "updateStoreForm_ADDRESS" name = "ADDRESS" type="text" class="form-control" placeholder="Complete Address" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Contact</span>
							  </div>
							  <input id = "updateStoreForm_CONTACT" name = "CONTACT" type="number" class="form-control" placeholder="Contact Number" aria-describedby="sizing-addon2" required>
						</div>
						<br />
							<div id = "updateStoreForm_MAP">
								
							</div>
						</br>
						<div class = "input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Wifi Connected?</span>
							  </div>
							&nbsp;&nbsp;
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" class="form-control" name="ISWIFI" id="updateStoreForm_ISWIFI" value="1" required checked>
							  <label class="form-check-label" for="updateStoreForm_ISWIFI">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" class="form-control" name="ISWIFI" id="updateStoreForm_ISWIFI" value="0">
							  <label class="form-check-label" for="updateStoreForm_ISWIFI">No</label>
							</div>
						</div>
						<br />
						<div class = "input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">With Parking?</span>
							  </div>
							&nbsp;&nbsp;
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="ISPARKING" class="form-control" id="updateStoreForm_ISPARKING" value="1" required checked>
							  <label class="form-check-label" for="updateStoreForm_ISPARKING">Yes</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="ISPARKING" class="form-control" id="updateStoreForm_ISPARKING" value="0">
							  <label class="form-check-label" for="updateStoreForm_ISPARKING">No</label>
							</div>
						</div>
			  			<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Hour Operation</span>
							  </div>
							  <input id = "updateStoreForm_HOUROPERATION" name = "HOUROPERATION" type="text" class="form-control" placeholder="XXam - XXpm" aria-describedby="sizing-addon2" required>
						</div>	
			  			<br />
			  			<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Added by</span>
							  </div>
							  <input id = "updateStoreForm_ADDEDBY" name = "ADDEDBY" type="text" class="form-control" placeholder="Added by" aria-describedby="sizing-addon2" disabled>
						</div>	
			  			<br />
							<div class="form-group">
								  <select class="form-control" name = "STATUS" id="updateStoreForm_STATUS">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								  </select>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="updateStoreForm_SUBMIT" class="btn btn-primary" data-loading-text="Updating..."> Update</button>
						 <button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
					</div>
			  </div>
			</form>
		</div>
  	</div>
	
	
	<!-- Location Modal -->
	 <div class="modal fade" id="locationModal" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
				<h5>Store Location</h5>
			</div>
			<div class="modal-body">		
						<div id = "map"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			  </div>
		</div>
  	</div>
	
	<!-- Delete Store Modal -->
	<div class = "modal fade" id = "deleteStoreForm_MODAL" tabindex = "-1" role = "dialog">
		<div class = "modal-dialog">
			 <div class="modal-content">
				<div class ="modal-header">
					<h5>Delete Store</h5>
				</div>
			<form id = "deleteStoreForm" method = "post" action = "library/form/deleteStoreForm.php">
				<div class = "modal-body">
					<div>
						<input type = "text" id ="deleteStoreForm_ID" name = "ID" style = "display: none;">
					</div>
				<p>Do you want to delete this record?:</p>
					<table class = "table">
						<thead>
						<tr>
							<td></td>
							<td><b>Store Details</b></td>
						</tr>
						</thead>
						<tbody>
						<tr>
								<td>Store Name: </td>
								<td id = "deleteStoreForm_NAME"></td>
						</tr>
						<tr>
								<td>Complete Address: </td>	
								<td id = "deleteStoreForm_ADDRESS"></td>
						</tr>
						<tr>
								<td>Latitude</td>
								<td id = "deleteStoreForm_LAT"></td>
						</tr>
						<tr>
								<td>Longitude</td>
								<td id = "deleteStoreForm_LNG"></td>
						</tr>
						<tr>
								<td>Z-Index</td>
								<td id = "deleteStoreForm_ZINDEX"></td>
						</tr>
						<tr>
								<td>isWifi</td>
								<td id = "deleteStoreForm_ISWIFI"></td>
						</tr>
						<tr>
								<td>Contact</td>
								<td id = "deleteStoreForm_CONTACT"></td>
						</tr>
						<tr>
								<td>isParking</td>
								<td id = "deleteStoreForm_ISPARKING"></td>
						</tr>
						<tr>
								<td>Hour Operation</td>
								<td id = "deleteStoreForm_HOUROPERATION"></td>
						</tr>
						<tr>
								<td>Added by</td>
								<td id = "deleteStoreForm_ACCOUNTNAME"></td>
					    </tr>
						<tr>
								<td>Status</td>
								<td id = "deleteStoreForm_STATUS"></td>
						</tr>
						
						</tbody>
					</table>
			  </div>
				<div class = "modal-footer">
					<button type = "submit" id = "deleteStoreForm_SUBMIT" class = "btn btn-danger" data-loading-text = "Deleting...">Delete</button>
					<button type = "button" class = "btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
			</div>
		</div>
	</div>	

  <body id="page-top">

    <!-- Navbar Section -->
    <?php include('library/html/navbar.php'); ?>  

	  
	<!--    Store Main Section -->
    <section id="store" class="aboutMain-section text-center">
      <div class = "container">
		  <div class = "row">
			<div class = "col-lg-6">
			  
			  
			  </div>
		  	<div class = "col-lg-6">
			  <header>
				  <a  class = "pull-right" id="manageButton" href="#" style="vertical-align:middle; margin-bottom: 35px;" role="button" data-toggle="modal" data-target="#addStoreForm_MODAL"><span>Add Store</span></a>	
				</header>
			  	<span id = "storeSearchBar" class="input-group pull-right searchBar">
					   <input id="storeSearch" type="text" class="form-control" placeholder="Search Store..." />
						   <span class="input-group-btn">
							<button id = "searchBar" class="btn btn-primary" type="submit">
								<i class="fas fa-search"></i>
								</button>
						   </span>
				</span>
			  </div>
		  
		  </div>
		<div class = "row">
		  <div class = "col-lg-12">
			
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>Name</th>
					<th>Complete Address</th>
					<th>Location</th>
					<th>Contact</th>
					<th>isWifi</th>
					<th>isParking</th>
					<th>Hour Operation</th>
					<th>Added By</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody id="storeList">
				</tbody>
			</table>	
			</div>
		  </div>
		  
		  <div class = "row">
		  	<div class = "col-lg-3 col-md-3 col-sm-3 col-xs-3 mx-auto">
			  <nav aria-label="...">
				  <ul class="pagination pagination-sm">
					
					 <li class="page-item">
					  <a class="page-link <?php echo $disable_previous; ?>" style="<?php echo $disable_previous2; ?>" href="manage-store.php?search=<?php echo $search; ?>&page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
					</li>
					<?php   	
					  	for($i = 1; $i <= $total_page; $i++)
						{
							?>
					  	<li id = "paginationActive<?php echo $i; ?>" class="page-item">
							<a class="page-link" href="manage-store.php?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
					    </li>
					  
					  <?php
						}
					  ?>
					
					<li class="page-item">
					  <a class = "page-link <?php echo $disable_next; ?>" style="<?php echo $disable_next2; ?>" href="manage-store.php?search=<?php echo $search; ?>&page=<?php echo $page + 1; ?>" >Next</a>
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
	<script src="js/jquery.form.min.js"></script>
	<script src="js/messagealert.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>
	<script src="js/mylibrary.js"></script>
	
	<!-- Font Awesome CDN for mini icons-->
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

	<!-- Google map -->
	<script async defer
		  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJbpjI8KS7fzlHYDjIBeOL8TkPfEhXUSk&callback=initMap">
	 </script>

  </body>

</html>

<script>

	
	//	Google Map Scripts
	
	var map;
	var marker;

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
		
	function initMap() 
	{
		var markerAddForm;
		var myLatlng = new google.maps.LatLng(10.70072853383871,122.5642401456214);
		var mapAddForm;
      
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
		
		
		// ADD MARKER MODAL
		
		 mapAddForm = new google.maps.Map(document.getElementById('addStoreForm_MAP'), {
          zoom: 14,
          center: myLatlng	
        
		 });
		
		  google.maps.event.addListenerOnce(mapAddForm, 'click', function(event) {
				markerAddForm = new google.maps.Marker({
				position: event.latLng,
				map: mapAddForm,
				draggable:true
			});
			  
			  document.getElementById('addStoreForm_LAT').value = event.latLng.lat();
			  document.getElementById('addStoreForm_LNG').value = event.latLng.lng();
			  document.getElementById('addStoreForm_ZINDEX').value = mapAddForm.getZoom();
			  markerAddForm.addListener('drag', handleEvent);
			  markerAddForm.addListener('dragend', handleEvent);
		  
		  	});
		
	
			function handleEvent(event) {
				document.getElementById('addStoreForm_LAT').value = event.latLng.lat();
				document.getElementById('addStoreForm_LNG').value = event.latLng.lng();
				document.getElementById('addStoreForm_ZINDEX').value = mapAddForm.getZoom();
			}
		
		
		// Map Update
		
		 mapUpdate = new google.maps.Map(document.getElementById('updateStoreForm_MAP'), {
          zoom: 14,
          center: {lat: 10.707061, lng: 122.5473598}	
        });
		
		
		// other map update code @ storeFill
		
		
		// end of InitMap()			
	}
	
	
		
		function mapFocus(id)
			{
				var focusLat = document.getElementById('store_LAT_' + id).innerHTML;
				var focusLng = document.getElementById('store_LNG_' + id).innerHTML;

				var latLng = new google.maps.LatLng(focusLat, focusLng); 

				map.setZoom(16);
				map.panTo(latLng);
			}
	
		


</script>

<script>

	
	var PageComponent = {
        storeList: document.getElementById('storeList')
    	};
	
	$(document).ready(function(){
		$("#paginationActive<?php echo $page ?>").addClass("active");
		$("#storeSearch").val('<?php echo $search; ?>');
		$("#storeSearch").click(function(){
			this.value = '';
			 $( "#searchBar" ).click(function() {
			  jQuery('#storeSearch').empty();
			  var searchValue = $("#storeSearch").val().toLowerCase(); 
				window.location.href='manage-store.php?search='+searchValue;
				 
				});

				$('#storeSearch').keypress(function(e){
				if(e.which == 13){//Enter key pressed
					$('#searchBar').click();//Trigger search button click event
				}
			});
		});
	});
	
	// Add Menu 
	
	var addStoreForm = {
        form: document.getElementById('addStoreForm'),
		modal: document.getElementById('addStoreForm_MODAL'),
        name: document.getElementById('addStoreForm_NAME'),
		address: document.getElementById('addStoreForm_ADDRESS'),
		lat: document.getElementById('addStoreForm_LAT'),
		lng: document.getElementById('addStoreForm_LNG'),
		zindex: document.getElementById('addStoreForm_ZINDEX'),
        contact: document.getElementById('addStoreForm_CONTACT'),
		iswifi: document.getElementById('addStoreForm_ISWIFI'),
		isparking: document.getElementById('addStoreForm_ISPARKING'),
		houroperation: document.getElementById('addStoreForm_HOUROPERATION'),
        submit: '#addStoreForm_SUBMIT'
    };
	
	
	addStoreForm.form.onsubmit = function (e)
	{
		e.preventDefault();
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				$(addStoreForm.submit).button('loading');
			},
			
			uploadProgress:function(event,position,total,percentComplete)
			{
				
			},
			success:function(data)
			{
				$(addStoreForm.submit).button('reset');
				var server_message = data.trim();
				if(!isWhitespace(GetSuccessMsg(server_message)))
					{
						$(addStoreForm.modal).modal('hide');
						alert('Added Succesfully');
						var ISWIFI = getISWIFI();
						var ISPARKING = getISPARKING();
						addStoreList(GetSuccessMsg(server_message), addStoreForm.name.value, addStoreForm.address.value, addStoreForm.lat.value, addStoreForm.lng.value, addStoreForm.zindex.value, addStoreForm.contact.value, ISWIFI, ISPARKING, addStoreForm.houroperation.value, '<?php echo $session_USER_FULLNAME ?>', 'Active');		
					}
				else if(!isWhitespace(GetWarningMsg(server_message)))
					{
						alert(GetWarningMsg(server_message));
					}
				else if(!isWhitespace(GetErrorMsg(server_message)))
					{
						alert(GetErrorMsg(server_message));
					}
				else if(!isWhitespace(GetServerMsg(server_message)))
					{
						alert('SERVER MESSAGE');
					}
				else
					{
						alert('Oh Snap! There is a problem with the server or your connection.');
					}
				}
			});
		};
	
	function getISWIFI(){
		
		if(document.getElementById('addStoreForm_ISWIFI').checked == true)
			{
				return 'Yes';
			}
		else
			{
				return 'No';
			}
	}
	
	function getISPARKING(){
		
		if(document.getElementById('addStoreForm_ISPARKING').checked == true)
			{
				return 'Yes';
			}
		else
			{
				return 'No';
			}
	}
	
	// Update Store
	
	var updateStoreForm =
		{
			form: document.getElementById('updateStoreForm'),
			modal: document.getElementById('updateStoreForm_MODAL'),
			id: document.getElementById('updateStoreForm_ID'),
			name: document.getElementById('updateStoreForm_NAME'),
			address: document.getElementById('updateStoreForm_ADDRESS'),
			lat: document.getElementById('updateStoreForm_LAT'),
			lng: document.getElementById('updateStoreForm_LNG'),
			zindex: document.getElementById('updateStoreForm_ZINDEX'),
			contact: document.getElementById('updateStoreForm_CONTACT'),
			iswifi: document.getElementById('updateStoreForm_ISWIFI'),
			isparking: document.getElementById('updateStoreForm_ISPARKING'),
			houroperation: document.getElementById('updateStoreForm_HOUROPERATION'),
			addedby: document.getElementById('updateStoreForm_ADDEDBY'),
			status: document.getElementById('updateStoreForm_STATUS'),
			submit: '#updateStoreForm_SUBMIT'
		}
	
	function storeFill(id)
	{
		var name = document.getElementById('store_NAME_'+id).innerHTML;
		var address = document.getElementById('store_ADDRESS_'+id).innerHTML;
		var lat = document.getElementById('store_LAT_'+id).innerHTML;
		var lng = document.getElementById('store_LNG_'+id).innerHTML;
		var zindex = document.getElementById('store_ZINDEX_'+id).innerHTML;
		var contact = document.getElementById('store_CONTACT_'+id).innerHTML;
		var iswifi = document.getElementById('store_ISWIFI_'+id).innerHTML;
		var isparking = document.getElementById('store_ISPARKING_'+id).innerHTML;
		var houroperation = document.getElementById('store_HOUROPERATION_'+id).innerHTML;
		var addedby = document.getElementById('store_ACCOUNTNAME_'+id).innerHTML;
		var status = document.getElementById('store_STATUS_'+id).innerHTML;
		
		updateStoreForm.id.value = id;
		updateStoreForm.name.value = name;
		updateStoreForm.address.value = address;
		updateStoreForm.lat.value = lat;
		updateStoreForm.lng.value = lng;
		updateStoreForm.zindex.value = zindex;
		updateStoreForm.contact.value = contact;
		// iswifi
		// get yes then check the id/name and its value if it is equivalent to YES/NO then add check event
		// isparking
		
		updateStoreForm.houroperation.value = houroperation;
		updateStoreForm.addedby.value = addedby;
		for(var i = 0; i < updateStoreForm.status.options.length; i++)
			{
				if(updateStoreForm.status.options[i].text == status)
					{
						updateStoreForm.status.selectedIndex = i;
					}
			}
		
		
		var focusLat = document.getElementById('store_LAT_' + id).innerHTML;
		var focusLng = document.getElementById('store_LNG_' + id).innerHTML;
	
		var latLng = new google.maps.LatLng(focusLat, focusLng); 
		
		var updateMarker = new google.maps.Marker({
			position: {lat: parseFloat(focusLat),lng: parseFloat(focusLng)},
			map: mapUpdate,
		    draggable:true
		});
		
		  updateMarker.addListener('drag', handleEvent);
		  updateMarker.addListener('dragend', handleEvent);
		
		function handleEvent(event) {
				document.getElementById('updateStoreForm_LAT').value = event.latLng.lat();
				document.getElementById('updateStoreForm_LNG').value = event.latLng.lng();
				document.getElementById('updateStoreForm_ZINDEX').value = mapUpdate.getZoom();
			}
	
	
		updateMarker.setMap(mapUpdate);

		mapUpdate.setZoom(16);
		mapUpdate.panTo(latLng);
		
		$(updateStoreForm.modal).modal('show');
		
	}
	
		updateStoreForm.form.onsubmit = function(e) {
		e.preventDefault();
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				
				$(updateStoreForm.submit).button('loading');
			},
			uploadProgress:function(event,position,total,percentCompelete)
			{
			
			},
			success:function(data)
			{
				$(updateStoreForm.submit).button('reset');
					
				var server_message = data.trim();
				if(!isWhitespace(GetSuccessMsg(server_message)))
				{
					$(updateStoreForm.modal).modal('hide');
					alert('Updated Succefully');
					var ISWIFI = getISWIFI();
					var ISPARKING = getISPARKING();
					updateStore(GetSuccessMsg(server_message),updateStoreForm.name.value, updateStoreForm.address.value, updateStoreForm.lat.value, updateStoreForm.lng.value, updateStoreForm.zindex.value, updateStoreForm.contact.value, updateStoreForm.houroperation.value, updateStoreForm.addedby.value, updateStoreForm.status.options[updateStoreForm.status.selectedIndex].text);
					
					// not sure with iswifi and isparking
				}
				else if(!isWhitespace(GetWarningMsg(server_message)))
				{	
						alert('sadasda');
				}
				else if(!isWhitespace(GetErrorMsg(server_message)))
				{
						alert(GetErrorMsg(server_message));
					
				}
				else if(!isWhitespace(GetServerMsg(server_message)))
				{
						
				}
				else
				{
					alert('Oh Snap! There is a problem with the server or your connection');
				
				}
			}
		});
	};
	
	
		function updateStore(id, name, address, lat, lng, zindex, contact, houroperation, accountname, status)
		{
		document.getElementById('store_NAME_'+id).innerHTML = name;
		document.getElementById('store_ADDRESS_'+id).innerHTML = address;
		document.getElementById('store_LAT_'+id).innerHTML = lat;
		document.getElementById('store_LNG_'+id).innerHTML = lng;
		document.getElementById('store_ZINDEX_'+id).innerHTML = zindex;
		document.getElementById('store_CONTACT_'+id).innerHTML = contact;
		document.getElementById('store_HOUROPERATION_'+id).innerHTML = houroperation;
		document.getElementById('store_ACCOUNTNAME_'+id).innerHTML = accountname;
		document.getElementById('store_STATUS_'+id).innerHTML = status;

			if(document.getElementById('updateStoreForm_ISWIFI').checked == true)
				{
					document.getElementById('store_ISWIFI_'+id).innerHTML = 'Yes';
				}
			else
				{
					document.getElementById('store_ISWIFI_'+id).innerHTML = 'No';
				}

			if(document.getElementById('updateStoreForm_ISPARKING').checked == true)
				{
					document.getElementById('store_ISPARKING_'+id).innerHTML = 'Yes';
				}
			else
				{
					document.getElementById('store_ISPARKING_'+id).innerHTML = 'No';
				}
		
		updateStoreForm.form.reset();
	}
	
	// Delete Store
	
	var deleteStoreForm =
		{
			form: document.getElementById('deleteStoreForm'),
			modal: document.getElementById('deleteStoreForm_MODAL'),
			id: document.getElementById('deleteStoreForm_ID'),
			name: document.getElementById('deleteStoreForm_NAME'),
			address: document.getElementById('deleteStoreForm_ADDRESS'),
			lat: document.getElementById('deleteStoreForm_LAT'),
			lng: document.getElementById('deleteStoreForm_LNG'),
			zindex: document.getElementById('deleteStoreForm_ZINDEX'),
			contact: document.getElementById('deleteStoreForm_CONTACT'),
			iswifi: document.getElementById('deleteStoreForm_ISWIFI'),
			isparking: document.getElementById('deleteStoreForm_ISPARKING'),
			houroperation: document.getElementById('deleteStoreForm_HOUROPERATION'),
			addedby: document.getElementById('deleteStoreForm_ACCOUNTNAME'),
			status: document.getElementById('deleteStoreForm_STATUS'),
			submit: '#deleteStoreForm_SUBMIT'
		}
	
	
	$(deleteStoreForm.form).on('submit', function (e) {
        var id = deleteStoreForm.id.value;

        e.preventDefault();
        $(this).ajaxSubmit({
            beforeSend:function()
            {
                $(deleteStoreForm.submit).button('loading');
            },
            uploadProgress:function(event,position,total,percentCompelete)
            {

            },
            success:function(data)
            {
                $(deleteStoreForm.submit).button('reset');
				deleteStore(id);
				deleteStoreForm.form.reset();
				$(deleteStoreForm.modal).modal('hide');
				alert('Succesfully Deleted');
            }
        });
    });
	
	function deleteStore(id) {
        $('#store_' + id).remove();
    }

    function openDeleteStoreModal(id) {
        deleteStoreForm.id.value = id;
		deleteStoreForm.name.innerHTML = document.getElementById('store_NAME_' + id).innerHTML;
		deleteStoreForm.address.innerHTML = document.getElementById('store_ADDRESS_' + id).innerHTML;
		deleteStoreForm.lat.innerHTML = document.getElementById('store_LAT_' + id).innerHTML;
		deleteStoreForm.lng.innerHTML = document.getElementById('store_LNG_' + id).innerHTML;
		deleteStoreForm.zindex.innerHTML = document.getElementById('store_ZINDEX_' + id).innerHTML;
        deleteStoreForm.contact.innerHTML = document.getElementById('store_CONTACT_' + id).innerHTML;
        deleteStoreForm.iswifi.innerHTML = document.getElementById('store_ISWIFI_' + id).innerHTML;
        deleteStoreForm.isparking.innerHTML = document.getElementById('store_ISPARKING_' + id).innerHTML;
        deleteStoreForm.houroperation.innerHTML = document.getElementById('store_HOUROPERATION_' + id).innerHTML;
		deleteStoreForm.addedby.innerHTML = document.getElementById('store_ACCOUNTNAME_' + id).innerHTML;
		deleteStoreForm.status.innerHTML = document.getElementById('store_STATUS_' + id).innerHTML;

        $(deleteStoreForm.modal).modal('show');
    }
	
	function addStoreList(id, name, address, lat, lng, zindex, contact, iswifi, isparking, houroperation, accountname, status)
	{
		PageComponent.storeList.innerHTML = PageComponent.storeList.innerHTML +
			'<tr>'+
			'<tr id = "store_' + id + '">'+
			'	<td id = "store_NAME_' + id + '">' + name + '</td>'+
			'	<td id = "store_ADDRESS_' + id + '">' + address + '</td>'+
			'	<td id = "store_LAT_' + id + '" style = "display: none">' + lat + '</td>'+
			'	<td id = "store_LNG_' + id + '" style = "display: none" >' + lng + '</td>'+
			'	<td id = "store_ZINDEX_' + id + '" style = "display: none">' + zindex + '</td>'+
			'	<td><button role = "button" data-target = "#locationModal" data-toggle = "modal" class = "btn btn-primary"  onclick="return mapFocus('+ id +');"><i class="fas fa-search"></i></button></td>'+
			'	<td id = "store_CONTACT_' + id + '">' + contact + '</td>'+
			'	<td id = "store_ISWIFI_' + id + '">' + iswifi + '</td>'+
			'	<td id = "store_ISPARKING_' + id + '">' + isparking + '</td>'+
			'	<td id = "store_HOUROPERATION_' + id + '">' + houroperation + '</td>'+
			'	<td id = "store_ACCOUNTNAME_' + id + '">' + accountname + '</td>'+
			'	<td id = "store_STATUS_' + id + '">' + status + '</td>'+
			'   <td><span><button id="menu_BTNUPDATE_' + id + '" value="' + id + '" class="btn btn-primary" onclick = storeFill(\'' + id + '\');><i class="fas fa-edit"></i></button><button id="menu_BTNDELETE_' + id + '" value="' + id + '" class="btn btn-warning" role = "button" onclick="openDeleteStoreModal(' + id + ')"><i class="fas fa-trash"></i></button></span></td>'+
            '<tr>';
	}
	
	<?php
		
					$list_sql = 'SELECT store.ID AS STOREID, store.NAME AS STORENAME, store.ADDRESS, coordinates.LAT, coordinates.LNG, coordinates.ZINDEX, store.CONTACT, store.ISWIFI, store.ISPARKING, store.HOUROPERATION, store.STATUS, CONCAT(account_user.FNAME, " ", account_user.MNAME, " ", account_user.LNAME) AS ACCOUNTNAME

					FROM coordinates
					INNER JOIN store
					ON coordinates.ID = store.COORDINATES
					INNER JOIN account_user
					ON account_user.ID = store.CREATEDBY
                    WHERE store.NAME LIKE "%' . $search . '%"
						
					LIMIT ' .$limit.'
					OFFSET '.$offset;
	
			$list_result = $db->connection->query($list_sql);
			$list_count = mysqli_num_rows($list_result);
	
			if($list_count < 1)
			{
				?>
	
				var content = '<tr>'+
					'<tr>'+
					'	<td id = "news_TITLE_">No Store Found</td>'+
					'<tr>';
				
				$("#storeList").append(content);
					
		
			<?php
				
			}
	else
	{
		while($list_row = $list_result->fetch_assoc())
		{
			$result_ID = htmlspecialchars($list_row['STOREID']);
			$result_NAME = htmlspecialchars($list_row['STORENAME']);
			$result_ADDRESS = htmlspecialchars($list_row['ADDRESS']);
			$result_LAT = htmlspecialchars($list_row['LAT']);
			$result_LNG = htmlspecialchars($list_row['LNG']);
			$result_ZINDEX = htmlspecialchars($list_row['ZINDEX']);
			$result_CONTACT = htmlspecialchars($list_row['CONTACT']);
			$result_ISWIFI = htmlspecialchars($list_row['ISWIFI']);
			$result_ISPARKING = htmlspecialchars($list_row['ISPARKING']);
			$result_HOUROPERATION = htmlspecialchars($list_row['HOUROPERATION']);
			$result_ACCOUNTNAME = htmlspecialchars($list_row['ACCOUNTNAME']);
			$result_STATUS = htmlspecialchars($list_row['STATUS']);

				// renames db 1/0
				if($result_STATUS == 1)
				{
					$result_STATUS = 'Active';
				}
				else
				{
					$result_STATUS = 'Inactive';
				}
				
				if($result_ISWIFI == 1)
				{
					$result_ISWIFI = 'Yes';
				}
				else
				{
					$result_ISWIFI = 'No';
				}
				
				if($result_ISPARKING)
				{
					$result_ISPARKING = 'Yes';
				}
				else
				{
					$result_ISPARKING = 'No';
				}
			?>
			
			addStoreList("<?php echo $result_ID;?>","<?php echo $result_NAME; ?>","<?php echo $result_ADDRESS ?>","<?php echo $result_LAT;?>","<?php echo $result_LNG; ?>", "<?php echo $result_ZINDEX?>", "<?php echo $result_CONTACT ?>", "<?php echo $result_ISWIFI ?>", "<?php echo $result_ISPARKING ?>", "<?php echo $result_HOUROPERATION ?>", "<?php echo $result_ACCOUNTNAME; ?>","<?php echo $result_STATUS ?>");
	
	<?php
		}
	}
	?>
	
</script>

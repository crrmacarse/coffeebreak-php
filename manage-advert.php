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

	$total_sql = 'SELECT * FROM advertisement WHERE NAME LIKE "%'.$search.'%"';
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

    <title>Coffeebreak Caf&eacute; International Inc. | Manage Advertisement</title>

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
	
	
	<!-- Add Advert Modal -->
	<div class="modal fade" id="addAdvertForm_MODAL" role="dialog">
		<div class="modal-dialog">
			<form id="addAdvertForm" method="post" action="library/form/addAdvertForm.php">
		  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
					<h5>Upload Advertisement</h5>
				</div>
					<div class="modal-body">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
							  </div>
							  <input id = "addAdvertForm_NAME" name = "NAME" type="text" class="form-control" placeholder="Name" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Description</span>
							  </div>
							  <textarea style = "padding-bottom: 150px;" maxlength="180" id = "addAdvertForm_DESCRIPTION" name = "DESCRIPTION"  type="text" class="form-control" placeholder="Description" aria-describedby="sizing-addon2"></textarea>
						</div>
						<br />
						  <input type = "image" class = "IMGDISPLAY" id = "addAdvertIMGDISPLAY" width="300"></input>	
						  <input id = "addAdvertForm_IMAGE" type = "file" accept="image/*"  name = "IMAGE" class = "form-control-file" value = ""></input>
						  <br />
						  <small>Dimension: Width: 1250 - 2100 | Height: 400 - 675 | Size: 500kb maximum</small>
					</div>
						<div class="modal-footer">
							<button type="submit" id="addAdvertForm_SUBMIT" class="btn btn-primary" data-loading-text="Adding..."> Add</button>
							 <button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
						</div>
				  </div>
			 </form>
		</div>
  	</div>

	<!-- Update Advert Modal -->
	<div class="modal fade" id="updateAdvertForm_MODAL" role="dialog">
		<div class="modal-dialog">
			<form id="updateAdvertForm" method="post" action="library/form/updateAdvertForm.php">
		  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
					<h5>Update Advertisement</h5>
				</div>
					<div class="modal-body">
						<input type = "text" id ="updateAdvertForm_ID" name = "ID" style = "display: none;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
							  </div>
							  <input id = "updateAdvertForm_NAME" name = "NAME" type="text" class="form-control" placeholder="Name" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Description</span>
							  </div>
							  <textarea style = "padding-bottom: 150px;" id = "updateAdvertForm_DESCRIPTION" name = "DESCRIPTION"  type="text" class="form-control" placeholder="Description" aria-describedby="sizing-addon2"></textarea>
						</div>
						<br />
						  <input class="img-fluid" type = "image" id = "updateAdvertForm_IMAGEVIEW" width="300"></input>	
				  		  <br />
				  		  <button id = "updateAdvertForm_BTNWANTUPDATE" type = "button" class = "btn btn-block">Want to Update the Photo?</button>

						<div id = "updateAdvertForm_UPDATEIMAGEDIV">
						  <input id = "updateAdvertForm_IMAGE" type = "file" accept="image/*"  name = "IMAGE" value = ""></input>
						  <br />
						   <small>Dimension: Width: 1250 - 2100 | Height: 400 - 675 | Size: 500kb maximum</small>
							<br />
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Added by</span>
							  </div>
							  <input id = "updateAdvertForm_POSTBY" type="text" class="form-control" placeholder="POSTBY by" aria-describedby="sizing-addon2" disabled>
						</div>
						<br/>
						<div class="form-group">
							  <select class="form-control" name = "STATUS" id="updateAdvertForm_STATUS">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							  </select>
						</div>
					</div>
						<div class="modal-footer">
							<button type="submit" id="updateAdvertForm_SUBMIT" class="btn btn-primary" data-loading-text="Updating..."> Update</button>
							 <button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
						</div>
				  </div>
			 </form>
		</div>
  	</div>

	
	<!-- Delete Advert -->
	<div class = "modal fade" id = "deleteAdvertForm_MODAL" tabindex = "-1" role = "dialog">
		<div class = "modal-dialog">
			 <div class="modal-content">
				<div class ="modal-header">
					<h5>Delete Advert</h5>
				</div>
			<form id = "deleteAdvertForm" method = "post" action = "library/form/deleteAdvertForm.php">
					<div class = "modal-body">
						<div>
							<input type = "text" id ="deleteAdvertForm_ID" name = "ID" style = "display: none;">
						</div>
					<p>Do you want to delete this record?:</p>
						<table class = "table">
							<thead>
							<tr>
								<td></td>
								<td><b>Advertisement Details</b></td>
							</tr>
							</thead>
							<tbody>
							<tr>
									<td>Advertisement Name: </td>
									<td id = "deleteAdvertForm_NAME"></td>
							</tr>
							<tr>
									<td>Description: </td>	
									<td id = "deleteAdvertForm_DESCRIPTION"></td>
							</tr>
							<tr>
									<td>Image: </td>
									<td><image class="img-fluid" id = "deleteAdvertForm_IMAGEVIEW"></image></td>
							</tr>	
							<tr>
									<td>IMG Path: </td>
									<td id = "deleteAdvertForm_IMAGE"></td>
							</tr>	
							<tr>
									<td>Date Posted: </td>
									<td id = "deleteAdvertForm_DATEADDED"></td>
							</tr>
							<tr>
									<td>Status: </td>
									<td id = "deleteAdvertForm_STATUS"></td>
							</tr>
							<tr>
									<td>Post by: </td>
									<td id = "deleteAdvertForm_POSTBY"></td>
							</tr>
							</tbody>
						</table>
				  </div>
				<div class = "modal-footer">
					<button type = "submit" id = "deleteAdvertForm_SUBMIT" class = "btn btn-danger" data-loading-text = "Deleting...">Delete</button>
					<button type = "button" class = "btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
			</div>
		</div>
	</div>	

	<!-- Image Display Modal -->
	 <div class="modal fade" id="displayModal_MODAL" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
				<h5>Image Display</h5>
			</div>
			<div class="modal-body">
				<img id = "displayModal_IMAGE" src = "" class="img-fluid">
				<br />
				<small id = "displayModal_IMAGESRC"></small>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			  </div>
		</div>
  	</div>


  <body id="page-top">

    <!-- Navbar Section -->
    <?php include('library/html/navbar.php'); ?>  

	  
	<!--  Manage Advert Section -->
    <section id="manageAdvert" class="manage-section text-center">
      <div class = "container">
		  <div class = "row">
			 <div class = "col-lg-6">
				 
			  </div>
		  	<div class = "col-lg-6">
			  <header>
				  <a  class = "pull-right" id="manageButton" href="#" style="vertical-align:middle; margin-bottom: 35px;" role="button" data-toggle="modal" data-target="#addAdvertForm_MODAL"><span>Upload Advertisement</span></a>	
					  <span id = "advertisementSearchBar" class="input-group pull-right searchBar" style ="margin-bottom: 20px;">
					   <input id="advertisementSearch" type="text" class="form-control" placeholder="Search Adverisement..." />
						   <span class="input-group-btn">
							<button id = "searchBar" class="btn btn-primary" type="submit">
								<i class="fas fa-search"></i>
								</button>
						   </span>
					  </span>
				</header>
			  </div>
		  </div>
		<div class = "row">
		  <div class = "col-lg-12">
			
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>IMG Path</th>
					<th>View Image</th>
					<th>Date Added</th>
					<th>Post By</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody id="advertList">
				</tbody>
			</table>	
			</div>
		  </div>
		  
		  <div class = "row">
		  	<div class = "col-lg-3 col-md-3 col-sm-3 col-xs-3 mx-auto">
			  <nav aria-label="...">
				  <ul class="pagination pagination-sm">
					
					 <li class="page-item">
					  <a class="page-link <?php echo $disable_previous; ?>" style="<?php echo $disable_previous2; ?>" href="manage-advert.php?search=<?php echo $search; ?>&page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
					</li>
					<?php   	
					  	for($i = 1; $i <= $total_page; $i++)
						{
							?>
					  	<li id = "paginationActive<?php echo $i; ?>" class="page-item">
							<a class="page-link" href="manage-advert.php?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
					    </li>
					  
					  <?php
						}
					  ?>
					
					<li class="page-item">
					  <a class = "page-link <?php echo $disable_next; ?>" style="<?php echo $disable_next2; ?>" href="manage-advert.php?search=<?php echo $search; ?>&page=<?php echo $page + 1; ?>" >Next</a>
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


  </body>

</html>

<script>
	
	var PageComponent = {
	advertList: document.getElementById('advertList')
	};
	
	var _URL = window.URL || window.webkitURL;
	
	$(document).ready(function() {
		$('#updateAdvertForm_UPDATEIMAGEDIV').hide();
		$('#updateAdvertForm_BTNWANTUPDATE').click( function()
		{
			$(this).hide();
			$( "#updateAdvertForm_IMAGE" ).click();
			$('#updateAdvertForm_UPDATEIMAGEDIV').show();
			
			updateAdvertForm.imageview.src = '';


		});
	});
	

	$('#addAdvertForm_IMAGE').change( function(event) {
		var file, img;
		if ((file = this.files[0])) {
			img = new Image();
			img.onload = function () {
				if(this.width < 1250 || this.width > 2100)
					{
						alert("Invalid Dimensions: Width is too big [Ideal Width: 1250 - 2100]");
						document.getElementById("addAdvertForm_IMAGE").value = "";
						$("#addAdvertIMGDISPLAY").css('display', 'none');
					}
				else if(this.height < 400 || this.height > 675)
					{
						alert("Invalid Dimensions: Height is too big [Ideal Height: 400 - 675]");
						document.getElementById("addAdvertForm_IMAGE").value = "";
						$("#addAdvertIMGDISPLAY").css('display', 'none');
					}
				else
					{
						$("#addAdvertIMGDISPLAY").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
					}
				
			};
			img.src = _URL.createObjectURL(file);
		}
		
	});
	
	$('#updateAdvertForm_IMAGE').change( function(event) {
		var file, img;
		if ((file = this.files[0])) {
			img = new Image();
			img.onload = function () {
				if(this.width < 1250 || this.width > 2100)
					{
						alert("Invalid Dimensions: Width is too big [Ideal Width: 1250 - 2100]");
						document.getElementById("updateAdvertForm_IMAGE").value = "";
						$("#updateAdvertForm_IMAGEVIEW").css('display', 'none');
					}
				else if(this.height < 400 || this.height > 675)
					{
						alert("Invalid Dimensions: Height is too big [Ideal Height: 400 - 675]");
						document.getElementById("updateAdvertForm_IMAGE").value = "";
						$("#updateAdvertForm_IMAGEVIEW").css('display', 'none');
					}
				else
					{
						$("#updateAdvertForm_IMAGEVIEW").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
					}
				
			};
			img.src = _URL.createObjectURL(file);
		}
		
	});
	
	$(document).ready(function(){
		$("#paginationActive<?php echo $page ?>").addClass("active");
		$("#advertisementSearch").val('<?php echo $search; ?>');
		$("#advertisementSearch").click(function(){
			this.value = '';
			 $( "#searchBar" ).click(function() {
			  jQuery('#advertisementSearch').empty();
			  var searchValue = $("#advertisementSearch").val().toLowerCase(); 
				window.location.href='manage-advert.php?search='+searchValue;
				 
				});

				$('#advertisementSearch').keypress(function(e){
				if(e.which == 13){//Enter key pressed
					$('#searchBar').click();//Trigger search button click event
				}
			});
		});
	});
	
	// Add Advertisement
	
	var addAdvertForm = {
		form: document.getElementById('addAdvertForm'),
		modal: document.getElementById('addAdvertForm_MODAL'),
		name: document.getElementById('addAdvertForm_NAME'),
		description: document.getElementById('addAdvertForm_DESCRIPTION'),
		imageview: document.getElementById('addAdvertIMGDISPLAY'),
		image: document.getElementById('addAdvertForm_IMAGE'),
		submit: '#addAdvertForm_SUBMIT'	
	}
	
	
	addAdvertForm.form.onsubmit = function (e)
	{
		e.preventDefault();
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				$(addAdvertForm.submit).button('loading');
			},
			
			uploadProgress:function(event,position,total,percentComplete)
			{
				
			},
			success:function(data)
			{
				$(addAdvertForm.submit).button('reset');
				var server_message = data.trim();
				if(!isWhitespace(GetSuccessMsg(server_message)))
					{
						var id;
						var imageurl;
						var message = GetSuccessMsg(server_message);
						
						for(var i = 0; i < message.length; i++)
							{
								if(message.charAt(i) == ',')
									{
										$(addAdvertForm.modal).modal('hide');
										alert('Added Succesfully');
										id = message.substring(0, i);
										imageurl = message.substring(i+1,message.length);
										
										addAdvertList(id, addAdvertForm.name.value,addAdvertForm.description.value,imageurl, new Date().toLocaleString(), '<?php echo $session_USER_FULLNAME; ?>', 'Active');
										
										addAdvertForm.form.reset();
										addAdvertForm.imageview.src = '';
									}
							}
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
						alert(GetServerMsg(server_message));
					}
				else
					{
						alert('Oh Snap! There is a problem with the server or your connection.');
					}
				}
			});
		};
	
	
	// Update Advertisement
	
	var updateAdvertForm = {
		form: document.getElementById('updateAdvertForm'),
		modal: document.getElementById('updateAdvertForm_MODAL'),
		id: document.getElementById('updateAdvertForm_ID'),
		name: document.getElementById('updateAdvertForm_NAME'),
		description: document.getElementById('updateAdvertForm_DESCRIPTION'),
		image: document.getElementById('updateAdvertForm_IMAGE'),
		imageview: document.getElementById('updateAdvertForm_IMAGEVIEW'),
		postby: document.getElementById('updateAdvertForm_POSTBY'),
		status: document.getElementById('updateAdvertForm_STATUS'),
		submit: '#updateAdvertForm_SUBMIT'
	}
	
	function updateAdvertFill(id) {
		var name = document.getElementById('advert_NAME_' + id).innerHTML;
		var description = document.getElementById('advert_DESCRIPTION_' + id).innerHTML;
		var image = document.getElementById('advert_IMAGE_'+id).innerHTML;
		var status = document.getElementById('advert_STATUS_'+id).innerHTML;
		var postby = document.getElementById('advert_POSTBY_'+id).innerHTML;
		
		for(var i = 0; i < updateAdvertForm.status.options.length; i++)
			{
				if(updateAdvertForm.status.options[i].text == status)
					{
						updateAdvertForm.status.selectedIndex = i;
					}
			}
	
		updateAdvertForm.id.value = id;
		updateAdvertForm.name.value = name;
		updateAdvertForm.description.value = description;
		updateAdvertForm.postby.value = postby;
		updateAdvertForm.imageview.src = "img/advert/"+image;
		// image component still missing
	}
	
	function updateAdvert(id, name, description, image, status)
	{
		document.getElementById('advert_NAME_'+id).innerHTML = name;
		document.getElementById('advert_DESCRIPTION_'+id).innerHTML = description;
		document.getElementById('advert_IMAGE_'+id).innerHTML = image;
		document.getElementById('advert_STATUS_'+id).innerHTML = status;
		// image value is not given upon refresh bcos i can't find a way to return it. i can use jquery to return back and just use form to get the id. (returning the form_IMAGE rather than ID).
		updateAdvertForm.form.reset();
	}
	
	updateAdvertForm.form.onsubmit = function(e) {
		e.preventDefault();
		
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				$(updateAdvertForm.submit).button('loading');
			},
			uploadProgress:function(event,position,total,percentCompelete)
			{

			},
			success:function(data)
			{
				$(updateAdvertForm.submit).button('reset');
				var server_message = data.trim();
				
				if(!isWhitespace(GetSuccessMsg(server_message)))
				{
					var id;
					var imageurl;
					var message = GetSuccessMsg(server_message);
					for(var i = 0; i < message.length; i++)
						{
							if(message.charAt(i) == ',')
								{
									$(updateAdvertForm.modal).modal('hide');
									alert('Succesfully Updated');
									id = message.substring(0, i);
									imageurl = message.substring(i+1,message.length);

									updateAdvert(id,updateAdvertForm.name.value, updateAdvertForm.description.value,imageurl, updateAdvertForm.status.options[updateAdvertForm.status.selectedIndex].text);
								}
						}
					
					// image updating problem
				}
				else if(!isWhitespace(GetWarningMsg(server_message)))
				{
					
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
	
	// Delete Advertisement
	
	var deleteAdvertForm =
		{
			form: document.getElementById('deleteAdvertForm'),
			modal: document.getElementById('deleteAdvertForm_MODAL'),
			id: document.getElementById('deleteAdvertForm_ID'),
			name: document.getElementById('deleteAdvertForm_NAME'),
			description: document.getElementById('deleteAdvertForm_DESCRIPTION'),
			imageview: document.getElementById('deleteAdvertForm_IMAGEVIEW'),
			image: document.getElementById('deleteAdvertForm_IMAGE'),
			dateadded: document.getElementById('deleteAdvertForm_DATEADDED'),
			postby: document.getElementById('deleteAdvertForm_POSTBY'),
			status: document.getElementById('deleteAdvertForm_STATUS'),
			submit: '#deleteAdvertForm_SUBMIT'
		}
	
	$(deleteAdvertForm.form).on('submit', function (e) {
        var id = deleteAdvertForm.id.value;

        e.preventDefault();
        $(this).ajaxSubmit({
            beforeSend:function()
            {
                $(deleteAdvertForm.submit).button('loading');
            },
            uploadProgress:function(event,position,total,percentCompelete)
            {

            },
            success:function(data)
            {
                $(deleteAdvertForm.submit).button('reset');
				alert('Succesfully Deleted');
				deleteAdvert(id);
				deleteAdvertForm.form.reset();
				$(deleteAdvertForm.modal).modal('hide');
            }
        });
    });
	
	function deleteAdvert(id) {
        $('#advert_' + id).remove();
    }
	
	
	 function openDeleteAdvertModal(id) {
		var imageLink = document.getElementById('advert_IMAGE_'+id).innerHTML;
		 
        deleteAdvertForm.id.value = id;
        deleteAdvertForm.name.innerHTML = document.getElementById('advert_NAME_' + id).innerHTML;
        deleteAdvertForm.description.innerHTML = document.getElementById('advert_DESCRIPTION_' + id).innerHTML;
        deleteAdvertForm.image.innerHTML = document.getElementById('advert_IMAGE_' + id).innerHTML;
        deleteAdvertForm.dateadded.innerHTML = document.getElementById('advert_DATEADDED_' + id).innerHTML;
        deleteAdvertForm.status.innerHTML = document.getElementById('advert_STATUS_' + id).innerHTML;
		deleteAdvertForm.postby.innerHTML = document.getElementById('advert_POSTBY_' + id).innerHTML;
		deleteAdvertForm.imageview.src = "img/advert/"+imageLink;
		 
        $(deleteAdvertForm.modal).modal('show');
    }
	
	
	function fillDisplayModal(id)
	{
		var image = document.getElementById('advert_IMAGE_'+id).innerHTML;
		
		document.getElementById('displayModal_IMAGESRC').innerHTML = "Image source: "+image;
		document.getElementById("displayModal_IMAGE").src = "img/advert/"+image;
		$("#displayModal_MODAL").modal('show');
	}
	
	
	function addAdvertList(id, name, description, image, dateadded, postby, status)
	{
		PageComponent.advertList.innerHTML = PageComponent.advertList.innerHTML +
			'<tr>'+
			'<tr id = "advert_' + id + '">'+
			'	<td id = "advert_NAME_' + id + '">' + name + '</td>'+
			'	<td id = "advert_DESCRIPTION_' + id + '">' + description + '</td>'+
			'	<td id = "advert_IMAGE_' + id + '">' + image + '</td>'+
			'<td><button role="button" class="btn btn-primary" onclick="fillDisplayModal(' + id + ')"><i class="fas fa-eye"></i></button></td>'+
			'	<td id = "advert_DATEADDED_' + id + '">' + dateadded + '</td>'+
			'	<td id = "advert_POSTBY_' + id + '">' + postby + '</td>'+
			'	<td id = "advert_STATUS_' + id + '">' + status + '</td>'+
			'   <td><span><button id="advert_BTNUPDATE_' + id + '" value="' + id + '" class="btn btn-primary" data-target = "#updateAdvertForm_MODAL" data-toggle = "modal" onclick = "updateAdvertFill(\'' + id + '\')"><i class="fas fa-edit"></i></button><button id="advert_BTNDELETE_' + id + '" value="' + id + '" class="btn btn-warning" role = "button" onclick="openDeleteAdvertModal(' + id + ')"><i class="fas fa-trash"></i></button></span></td>'+
            '<tr>';
	}
	
	<?php
		
					$list_sql = 'SELECT advertisement.ID AS ADVERTID, advertisement.NAME, advertisement.DESCRIPTION, advertisement.IMAGE, advertisement.DATEADDED, CONCAT(account_user.FNAME, " ", account_user.MNAME, " ", account_user.LNAME) AS ACCOUNTNAME, advertisement.STATUS
                    
                    FROM (SELECT * FROM advertisement WHERE advertisement.NAME LIKE "%'.$search.'%") AS advertisement
                    INNER JOIN account_user
                    ON advertisement.POSTBY = account_user.ID
					
					ORDER BY advertisement.NAME
					LIMIT ' .$limit.'
					OFFSET '.$offset;
	
			$list_result = $db->connection->query($list_sql);
			$list_count = mysqli_num_rows($list_result);
	
			if($list_count < 1)
			{
				?>
	
				var content = '<tr>'+
					'<tr id = "">'+
					'	<td id = "advert_NAME_">No Advertisement Found</td>'+
					'<tr>';
				
				$("#advertList").append(content);
					
		
			<?php
				
			}
	else
	{
		while($list_row = $list_result->fetch_assoc())
		{
			$result_ID = htmlspecialchars($list_row['ADVERTID']);
			$result_NAME = htmlspecialchars($list_row['NAME']);
			$result_DESCRIPTION = htmlspecialchars($list_row['DESCRIPTION']);
			$result_IMAGE = htmlspecialchars($list_row['IMAGE']);
			$result_DATEADDED = htmlspecialchars($list_row['DATEADDED']);
			$result_POSTBY = htmlspecialchars($list_row['ACCOUNTNAME']);
			$result_STATUS = htmlspecialchars($list_row{'STATUS'});
		
			if($result_STATUS == '1')
			{
				$result_STATUS = 'Active';
			}
			else
			{
				$result_STATUS = 'Inactive';
			}
			
			?>
			
			addAdvertList("<?php echo $result_ID; ?>","<?php echo $result_NAME; ?>","<?php echo $result_DESCRIPTION; ?>","<?php echo $result_IMAGE ?>","<?php echo $result_DATEADDED; ?>","<?php echo $result_POSTBY; ?>", "<?php echo $result_STATUS; ?>")
	
	<?php
		}
	}
	?>
	
</script>

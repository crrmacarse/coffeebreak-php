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

	$total_sql = 'SELECT * FROM product_item WHERE NAME LIKE "%'.$search.'%"';
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

    <title>Coffeebreak Caf&eacute; International Inc. | Manage Menu</title>

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
	
	
	<!-- Add Menu Modal -->
	 <div class="modal fade" id="addMenuForm_MODAL" role="dialog">
		<div class="modal-dialog">
			<form id="addMenuForm" method="post" action="library/form/addMenuForm.php">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
				<h5>Upload a Menu</h5>
			</div>
			<div class="modal-body">
				
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
							  </div>
							  <input id = "addMenuForm_NAME" name = "NAME" type="text" class="form-control" placeholder="NAME" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="form-group">
						  <select class="form-control" name = "GROUP" id = "addMenuForm_GROUP" >
							<option value="" disabled selected>Select a group</option>
							<?php 
							  
							  	$groupList_sql = "SELECT product_group.ID, product_group.NAME, 							product_group.STATUS 
												
												FROM product_group
												
												WHERE product_group.STATUS = 1";
							  
							  	$groupList_result = $db->connection->query($groupList_sql);
							  	$groupList_count = mysqli_num_rows($groupList_sql);
							  	
							  	while($groupList_row = $groupList_result->fetch_array())
								{
									?>
							  			<option value = "<?php echo $groupList_row['ID']; ?>"><?php echo $groupList_row['NAME']; ?></option>
							  <?php
								}
							  ?>
							
						  </select>
						</div>
						<div class="form-group">
						  <select class="form-control" name = "RECOMMENDATION" id="addMenuForm_RECOMMENDATION">
							<option value="" disabled selected>Select a Recommendation</option>
							<option value = "">None</option>
							<option value = "New">New</option>
							<option value = "Best Seller">Best Seller</option>
							<option value = "Recommended">Recommended</option>
						  </select>
						</div>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Description</span>
							  </div>
							  <textarea id = "addMenuForm_DESCRIPTION" maxlength = "180" name = "DESCRIPTION" style = "padding-bottom: 150px;" type="text" class="form-control" placeholder="Description.." aria-describedby="sizing-addon2" required></textarea>
						</div>
						<br />
						  <input type = "image" class = "IMGDISPLAY" id = "addMenuForm_IMAGEDISPLAY" width="300"></input>	
						  <input id = "addMenuForm_IMAGE" type = "file" accept="image/*"  name = "IMAGE" class = "form-control-file" value = ""></input>
						  <br />
						  <small>Dimension: Width: 400 - 500| Height: 400 - 500 | Size: 150kb maximum</small>
				</div>
					<div class="modal-footer">
						<button type="submit" id="addMenuForm_SUBMIT" class="btn btn-primary" data-loading-text="Adding..."> Add</button>
						 <button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
					</div>
			  </div>
			</form>
		</div>
  	</div>
	
	<!-- Update Menu Modal -->
	<div class="modal fade" id="updateMenuForm_MODAL" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Update Menu</h5>
				</div>

				<!-- Update Barangay Form -->
				<form id="updateMenuForm" method="post" action="library/form/updateMenuForm.php">
					<div class="modal-body">
						<input type="hidden" id="updateMenuForm_ID" name="ID" required />
						<!-- Infomation -->
						<div class="panel panel-default">
							<div class="panel-heading pull-right"><b>Information</b></div>
							<div class="panel-body">

								<!-- Name -->
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
									  </div>
									  <input id = "updateMenuForm_NAME" name = "NAME" type="text" class="form-control" placeholder="NAME" aria-describedby="sizing-addon2" required>
								</div>
								<br />
								<div class="form-group">
								  <select class="form-control" name = "GROUP" id = "updateMenuForm_GROUP" >
									<option value="" disabled selected>Select a group</option>
									<?php 

										$groupList_sql = "SELECT product_group.ID, product_group.NAME, 							product_group.STATUS 

														FROM product_group

														WHERE product_group.STATUS = 1";

										$groupList_result = $db->connection->query($groupList_sql);
										$groupList_count = mysqli_num_rows($groupList_sql);

										while($groupList_row = $groupList_result->fetch_array())
										{
											?>
												<option value = "<?php echo $groupList_row['ID']; ?>"><?php echo $groupList_row['NAME']; ?></option>
									  <?php
										}
									  ?>

								  </select>
								</div>
								<div class="form-group">
								  <select class="form-control" name = "RECOMMENDATION" id="updateMenuForm_RECOMMENDATION">
									<option value="" disabled selected>Select a Recommendation</option>
										<option value = "">None</option>
									  	<option value = "New">New</option>
										<option value = "Best Seller">Best Seller</option>
										<option value = "Recommended">Recommended</option>
								  </select>
								</div>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm">Description</span>
									  </div>
									  <textarea id = "updateMenuForm_DESCRIPTION" maxlength = "180" name = "DESCRIPTION" style = "padding-bottom: 150px;" type="text" class="form-control" placeholder="Description.." aria-describedby="sizing-addon2" required></textarea>
								</div>
								<br />
								  <input class="img-fluid" type = "image" id = "updateMenuForm_IMAGEVIEW" width="300"></input>	
								  <br />
								  <button id = "updateMenuForm_BTNWANTUPDATE" type = "button" class = "btn btn-block">Want to Update the Photo?</button>

								<div id = "updateMenuForm_UPDATEIMAGEDIV">
								  <input id = "updateMenuForm_IMAGE" type = "file" accept="image/*"  name = "IMAGE" value = ""></input>
								  <br />
								   <small>Dimension: Width: 400 - 500 | Height: 400 - 500 | Size: 150kb maximum</small>
									<br />
								</div>
								<br />
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm">Added by</span>
									  </div>
									  <input id = "updateMenuForm_ADDEDBY" name = "ADDEDBY" type="text" class="form-control" placeholder="Added by" aria-describedby="sizing-addon2" disabled>
								</div>
								<br />
								<div class="form-group">
								  <select class="form-control" name = "STATUS" id="updateMenuForm_STATUS">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								  </select>
								</div>
							</div>
						</div>
					</div>
					<!-- Submission -->
					<div class="modal-footer">
						<button type="submit" id="updateMenuForm_SUBMIT" class="btn btn-primary" data-loading-text="Updating..."> Update</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Delete Menu Modal -->
	<div class="modal fade" id="deleteMenuForm_MODAL" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
				<h5>Delete Menu</h5>
			</div>
            <form id="deleteMenuForm" method="post" action="library/form/deleteMenuForm.php">
                <div class="modal-body">
                    <div><input type="text" id="deleteMenuForm_ID" name="ID" style="display: none;"></div>
                    <p>Do you want to delete this record?:</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <td></td>
                            <td><b>Menu Details</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Menu Name: </td>
                            <td id="deleteMenuForm_NAME"></td>
                        </tr>
                        <tr>
                            <td>Group: </td>
                            <td id="deleteMenuForm_GROUP"></td>
                        </tr>
                        <tr>
                            <td>Recommendation: </td>
                            <td id="deleteMenuForm_RECOMMENDATION"></td>
                        </tr>
                        <tr>
                            <td>Description: </td>
                            <td id="deleteMenuForm_DESCRIPTION"></td>
                        </tr>
                       	<tr>
								<td>Image: </td>
								<td><image class="img-fluid" id = "deleteMenuForm_IMAGEVIEW"></image></td>
						</tr>	
						<tr>
								<td>IMG Path: </td>
								<td id = "deleteMenuForm_IMAGE"></td>
						</tr>	
						<tr>
                            <td>Added By: </td>
                            <td id="deleteMenuForm_ADDEDBY"></td>
                        </tr>	
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
					<button type="submit" id="deleteMenuForm_SUBMIT" class="btn btn-danger" data-loading-text="Deleting..."> Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
                   
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

	  
	<!--  Manage menu Section -->
    <section id="manageMenu" class="manage-section text-center">
      <div class = "container">
		  <div class = "row">
			<div class = "col-lg-6">
		
			</div>
		  	<div class = "col-lg-6">
			  <header>
				  <a  class = "pull-right" id="manageButton" href="#" style="vertical-align:middle; margin-bottom: 35px;" role="button" data-toggle="modal" data-target="#addMenuForm_MODAL"><span>Upload Menu</span></a>	
					<span id = "menuSearchBar" class="input-group pull-right searchBar">
					   <input id="menuSearch" type="text" class="form-control" placeholder="Search Menu..." />
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
					<th>Group</th>
					<th>Recommendation</th>
					<th>Description</th>
					<th>View Image</th>
					<th>Status</th>
					<th>Added By</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody id="menuList">
				</tbody>
			</table>	
			</div>
		  </div>
		  
		  <div class = "row">
		  	<div class = "col-lg-3 col-md-3 col-sm-3 col-xs-3 mx-auto">
			  <nav aria-label="...">
				  <ul class="pagination pagination-sm">
					
					 <li class="page-item">
					  <a class="page-link <?php echo $disable_previous; ?>" style="<?php echo $disable_previous2; ?>" href="manage-menu.php?search=<?php echo $search; ?>&page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
					</li>
					<?php   	
					  	for($i = 1; $i <= $total_page; $i++)
						{
							?>
					  	<li id = "paginationActive<?php echo $i; ?>" class="page-item">
							<a class="page-link" href="manage-menu.php?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
					    </li>
					  
					  <?php
						}
					  ?>
					
					<li class="page-item">
					  <a class = "page-link <?php echo $disable_next; ?>" style="<?php echo $disable_next2; ?>" href="manage-menu.php?search=<?php echo $search; ?>&page=<?php echo $page + 1; ?>" >Next</a>
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
        menuList: document.getElementById('menuList')
    };
	
	var _URL = window.URL || window.webkitURL;
	
	$(document).ready(function() {
		$('#updateMenuForm_UPDATEIMAGEDIV').hide();
		$('#updateMenuForm_BTNWANTUPDATE').click( function()
		{
			$(this).hide();
			$( "#updateMenuForm_IMAGE" ).click();
			$('#updateMenuForm_UPDATEIMAGEDIV').show();
			
			updateMenuForm.imageview.src = '';


		});
	});
	
	
	
	$('#addMenuForm_IMAGE').change( function(event) {
		var file, img;
		if ((file = this.files[0])) {
			img = new Image();
			img.onload = function () {
				if(this.width < 400 || this.width > 500)
					{
						alert("Please adjust the width to the desirable dimension [width: 400-500]");
						document.getElementById("addMenuForm_IMAGE").value = "";
						$("#addMenuForm_IMAGEDISPLAY").css('display', 'none');
					}
				else if(this.height < 400 || this.height > 500)
					{
						alert("Please adjust the height to the desirable dimension [height: 400-500]");
						document.getElementById("addMenuForm_IMAGE").value = "";
						$("#addMenuForm_IMAGEDISPLAY").css('display', 'none');
					}
				else
					{
						$("#addMenuForm_IMAGEDISPLAY").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
					}
				
			};
			img.src = _URL.createObjectURL(file);
		}
		
	});
	
	$('#updateMenuForm_IMAGE').change( function(event) {
		var file, img;
		if ((file = this.files[0])) {
			img = new Image();
			img.onload = function () {
				if(this.width < 400 || this.width > 500)
					{
						alert("Please adjust the width to the desirable dimension [width: 400-500]");
						document.getElementById("updateMenuForm_IMAGE").value = "";
						$("#updateMenuForm_IMAGEVIEW").css('display', 'none');
					}
				else if(this.height < 400 || this.height > 500)
					{
						alert("Please adjust the height to the desirable dimension [height: 400-500]");
						document.getElementById("updateMenuForm_IMAGE").value = "";
						$("#updateMenuForm_IMAGEVIEW").css('display', 'none');
					}
				else
					{
						$("#updateMenuForm_IMAGEVIEW").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
					}
				
			};
			img.src = _URL.createObjectURL(file);
		}
		
	});
	
	$(document).ready(function(){
		$("#paginationActive<?php echo $page ?>").addClass("active");
		$("#menuSearch").val('<?php echo $search; ?>');
		$("#menuSearch").click(function(){
			this.value = '';
			 $( "#searchBar" ).click(function() {
			  jQuery('#menuSearch').empty();
			  var searchValue = $("#menuSearch").val().toLowerCase(); 
				window.location.href='manage-menu.php?search='+searchValue;
				 
				});

				$('#menuSearch').keypress(function(e){
				if(e.which == 13){//Enter key pressed
					$('#searchBar').click();//Trigger search button click event
				}
			});
		});
	});
	
	
	function fillDisplayModal(id)
	{
		var image = document.getElementById('menu_IMAGE_'+id).innerHTML;
		
		document.getElementById('displayModal_IMAGESRC').innerHTML = "Image source: "+image;
		document.getElementById("displayModal_IMAGE").src = "img/menu/"+image;
		$("#displayModal_MODAL").modal('show');
	}
	
	
	// Add Menu 
	
	var addMenuForm = {
        form: document.getElementById('addMenuForm'),
		modal: document.getElementById('addMenuForm_MODAL'),
        name: document.getElementById('addMenuForm_NAME'),
		group: document.getElementById('addMenuForm_GROUP'),
		recommendation: document.getElementById('addMenuForm_RECOMMENDATION'),
		image: document.getElementById('addMenuForm_IMAGE'),
		imageview: document.getElementById('addMenuForm_IMAGEDISPLAY'),
		description: document.getElementById('addMenuForm_DESCRIPTION'),
        address: document.getElementById('AddEvacuationForm_ADDRESS'),
        submit: '#addMenuForm_SUBMIT',
        modal: '#addMenuForm_MODAL'
    };
	
	
	addMenuForm.form.onsubmit = function (e)
	{
		e.preventDefault();
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				$(addMenuForm.submit).button('loading');
			},
			
			uploadProgress:function(event,position,total,percentComplete)
			{
				
			},
			success:function(data)
			{
				$(addMenuForm.submit).button('reset');
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
										$(addMenuForm.modal).modal('hide');
										alert('Added Succesfully');
										id = message.substring(0, i);
										imageurl = message.substring(i+1,message.length);
										
										addMenuList(id, addMenuForm.name.value, addMenuForm.description.value, imageurl, 'Active', addMenuForm.group.options[addMenuForm.group.selectedIndex].text, "<?php echo $session_USER_FULLNAME; ?>", addMenuForm.recommendation.options[addMenuForm.recommendation.selectedIndex].text)
										
										addMenuForm.form.reset();
										addMenuForm.imageview.src = '';
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
	
	// Delete Menu
	
	 var deleteMenuForm = {
        form: document.getElementById('deleteMenuForm'),
        modal: document.getElementById('deleteMenuForm_MODAL'),
        id: document.getElementById('deleteMenuForm_ID'),
        name: document.getElementById('deleteMenuForm_NAME'),
        group: document.getElementById('deleteMenuForm_GROUP'),
        recommendation: document.getElementById('deleteMenuForm_RECOMMENDATION'),
        description: document.getElementById('deleteMenuForm_DESCRIPTION'),
        image: document.getElementById('deleteMenuForm_IMAGE'),
		imageview: document.getElementById('deleteMenuForm_IMAGEVIEW'),
        addedby: document.getElementById('deleteMenuForm_ADDEDBY'),
		msgbox: 'deleteMenuForm_msgbox',
        submit: document.getElementById('deleteMenuForm_SUBMIT')
    };
	
	
	
	$(deleteMenuForm.form).on('submit', function (e) {
        var id = deleteMenuForm.id.value;

        e.preventDefault();
        $(this).ajaxSubmit({
            beforeSend:function()
            {
                $(deleteMenuForm.submit).button('loading');
            },
            uploadProgress:function(event,position,total,percentCompelete)
            {

            },
            success:function(data)
            {
                $(deleteMenuForm.submit).button('reset');
				deleteMenu(id);
				deleteMenuForm.form.reset();
				$(deleteMenuForm.modal).modal('hide');
				alert('Succesfully Deleted');
            }
        });
    });
	
	function deleteMenu(id) {
        $('#menu_' + id).remove();
    }

    function openDeleteMenuModal(id) {
		var imageLink = document.getElementById('menu_IMAGE_'+id).innerHTML;
		 
        deleteMenuForm.id.value = id;
        deleteMenuForm.name.innerHTML = document.getElementById('menu_NAME_' + id).innerHTML;
        deleteMenuForm.group.innerHTML = document.getElementById('menu_GROUP_' + id).innerHTML;
        deleteMenuForm.recommendation.innerHTML = document.getElementById('menu_RECOMMENDATION_' + id).innerHTML;
        deleteMenuForm.description.innerHTML = document.getElementById('menu_DESCRIPTION_' + id).innerHTML;
        deleteMenuForm.image.innerHTML = document.getElementById('menu_IMAGE_' + id).innerHTML;
		deleteMenuForm.addedby.innerHTML = document.getElementById('menu_ACCOUNTNAME_' + id).innerHTML;
		deleteMenuForm.imageview.src = "img/menu/"+imageLink;

        $(deleteMenuForm.modal).modal('show');
    }
	
	
	// UPDATE MENU FORM
	
	var updateMenuForm = {
		form: document.getElementById('updateMenuForm'),
		modal: document.getElementById('updateMenuForm_MODAL'),
		id: document.getElementById('updateMenuForm_ID'),
		name: document.getElementById('updateMenuForm_NAME'),
		group: document.getElementById('updateMenuForm_GROUP'),
		recommendation: document.getElementById('updateMenuForm_RECOMMENDATION'),
		description: document.getElementById('updateMenuForm_DESCRIPTION'),
		image: document.getElementById('updateMenuForm_IMAGE'),
		imageview: document.getElementById('updateMenuForm_IMAGEVIEW'),
		status: document.getElementById('updateMenuForm_STATUS'),
		addedby: document.getElementById('updateMenuForm_ADDEDBY'),
		submit : '#updateMenuForm_SUBMIT'

	};
	
	function updateMenuFill(id) {
		// image fill
		var name = document.getElementById('menu_NAME_' + id).innerHTML;
		var group = document.getElementById('menu_GROUP_' + id).innerHTML;
		var recommendation = document.getElementById('menu_RECOMMENDATION_'+id).innerHTML;
		var description = document.getElementById('menu_DESCRIPTION_'+id).innerHTML;
		var image = document.getElementById('menu_IMAGE_'+id).innerHTML;
		var status = document.getElementById('menu_STATUS_'+id).innerHTML;
		var addedby = document.getElementById('menu_ACCOUNTNAME_'+id).innerHTML;
		
		for(var i = 0; i < updateMenuForm.group.options.length; i ++)
			{
				if(updateMenuForm.group.options[i].text == group)
					{
						updateMenuForm.group.selectedIndex = i;
					}
			}
		
		for(var i = 0; i < updateMenuForm.status.options.length; i++)
			{
				if(updateMenuForm.status.options[i].text == status)
					{
						updateMenuForm.status.selectedIndex = i;
					}
			}
		for(var i = 0; i < updateMenuForm.recommendation.options.length; i++)
			{
				if(updateMenuForm.recommendation.options[i].text == recommendation)
					{
						updateMenuForm.recommendation.selectedIndex = i;
					}
			}
		
		updateMenuForm.name.value = name;
		updateMenuForm.description.value = description;
		updateMenuForm.id.value = id;
		updateMenuForm.addedby.value = addedby;
		updateMenuForm.imageview.src = "img/menu/"+image;
	}
	
	function updateMenu(id, name, group, recommendation, image, description, status)
	{
		document.getElementById('menu_NAME_'+id).innerHTML = name;
		document.getElementById('menu_GROUP_'+id).innerHTML = group;
		document.getElementById('menu_RECOMMENDATION_'+id).innerHTML = recommendation;
		document.getElementById('menu_IMAGE_'+id).innerHTML = image;
		document.getElementById('menu_DESCRIPTION_'+id).innerHTML = description;
		document.getElementById('menu_STATUS_'+id).innerHTML = status;
		// image add here
		updateMenuForm.form.reset();
	}
	
	
	updateMenuForm.form.onsubmit = function(e) {
		e.preventDefault();
		
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				$(updateMenuForm.submit).button('loading');
			},
			uploadProgress:function(event,position,total,percentCompelete)
			{

			},
			success:function(data)
			{
				$(updateMenuForm.submit).button('reset');
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
									$(updateMenuForm.modal).modal('hide');
									alert('Succesfully Updated');
									id = message.substring(0, i);
									imageurl = message.substring(i+1,message.length);

									updateMenu(id,updateMenuForm.name.value, updateMenuForm.group.options[updateMenuForm.group.selectedIndex].text, updateMenuForm.recommendation.options[updateMenuForm.recommendation.selectedIndex].value, imageurl, updateMenuForm.description.value, updateMenuForm.status.options[updateMenuForm.status.selectedIndex].text);
								}
						}
					
					
					
				
					// add image here
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
	
	
	
	function addMenuList(id, name, descript, image, status, groupname, accountname, recommendation) {
        PageComponent.menuList.innerHTML = PageComponent.menuList.innerHTML +
			'<tr>' +
			'<tr id="menu_' + id + '">'+
            '   <td id="menu_NAME_' + id + '">' + name + '</td>'+
			'   <td id="menu_GROUP_' + id + '">' + groupname +'</td>'+
			'   <td id="menu_RECOMMENDATION_' + id + '">'+ recommendation +'</td>'+
			'   <td id="menu_DESCRIPTION_' + id + '">' + descript + '</td>'+
			'   <td id="menu_IMAGE_' + id + '" style = "display: none;">' + image + '</td>'+
			'<td><button role="button" class="btn btn-primary" onclick="fillDisplayModal(' + id + ')"><i class="fas fa-eye"></i></button></td>'+
			'   <td id="menu_STATUS_' + id + '">' + status + '</td>'+
			'   <td id="menu_ACCOUNTNAME_' + id + '">' + accountname +'</td>'+
			'   <td><span><button id="menu_BTNUPDATE_' + id + '" value="' + id + '" data-target = "#updateMenuForm_MODAL" data-toggle = "modal" onclick = "updateMenuFill(\'' + id + '\')"class="btn btn-primary"><i class="fas fa-edit"></i></button><button id="menu_BTNDELETE_' + id + '" value="' + id + '" class="btn btn-warning" role = "button" onclick="openDeleteMenuModal(' + id + ')"><i class="fas fa-trash"></i></button></span></td>'+
            '<tr>';
    }
	
	<?php
		
		$list_sql = 'SELECT product_item.ID AS MENUID, product_item.NAME, product_item.DESCRIPTION, product_item.IMAGE, product_item.STATUS as PRODUCTSTATUS, product_item.RECOMMENDATION AS RECOMMENDATIONNAME, product_group.ID, product_group.NAME AS GROUPNAME, product_group.STATUS, account_user.USERNAME, CONCAT(account_user.FNAME, " ", account_user.MNAME, " ", account_user.LNAME) AS ACCOUNTNAME
                                    
                                    
                                    FROM product_group
                                    INNER JOIN product_item
                                    ON product_item.GROUPID = product_group.ID
                                    INNER JOIN account_user
                                    ON product_item.ADDEDBY = account_user.ID
                                   	WHERE product_item.NAME LIKE "%'.$search.'%"
                                   
                                    ORDER BY product_item.NAME
									LIMIT ' .$limit.'
									OFFSET '.$offset;
		$list_result = $db->connection->query($list_sql);
		$list_count = mysqli_num_rows($list_result);

		if($list_count < 1) {
			?> 
				var content = '<tr>'+
					'<tr>'+
					'	<td id = "news_TITLE_">No Menu Found</td>'+
					'<tr>';
				
				$("#menuList").append(content);
			<?php
		}
		else {
			while ($list_row = $list_result->fetch_assoc()) {
				$result_ID = htmlspecialchars($list_row['MENUID']);
				$result_NAME = htmlspecialchars($list_row['NAME']);
				$result_DESCRIPTION = htmlspecialchars($list_row['DESCRIPTION']);
				$result_GROUPNAME = htmlspecialchars($list_row['GROUPNAME']);
				$result_ACCOUNTNAME = htmlspecialchars($list_row['ACCOUNTNAME']);
				$result_STATUS = htmlspecialchars($list_row['PRODUCTSTATUS']);
				$result_RECOMMENDATION = htmlspecialchars($list_row['RECOMMENDATIONNAME']);
				$result_IMAGE = htmlspecialchars($list_row['IMAGE']);
				
			if($result_STATUS == '1')
			{
				$result_STATUS = 'Active';
			}
			else
			{
				$result_STATUS = 'Inactive';
			}
		?>

		addMenuList("<?php echo $result_ID; ?>","<?php echo $result_NAME; ?>","<?php echo $result_DESCRIPTION; ?>","<?php echo $result_IMAGE; ?>","<?php echo $result_STATUS; ?>","<?php echo $result_GROUPNAME; ?>","<?php echo $result_ACCOUNTNAME; ?>","<?php echo $result_RECOMMENDATION; ?>");

		<?php
			}
		}
	?>
	
	
</script>

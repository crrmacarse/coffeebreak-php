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

	$total_sql = 'SELECT * FROM article WHERE TITLE LIKE "%'.$search.'%"';
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

    <title>Coffeebreak Caf&eacute; International Inc. | Manage News</title>

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
	
	
	<!-- Add News Modal -->
	 <div class="modal fade" id="addNewsForm_MODAL" role="dialog">
		<div class="modal-dialog">
			<form id="addNewsForm" method="post" action="library/form/addNewsForm.php">
		  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
					<h5>Upload News</h5>
				</div>
					<div class="modal-body">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
							  </div>
							  <input id = "addNewsForm_TITLE" name = "TITLE" type="text" class="form-control" placeholder="NAME" aria-describedby="sizing-addon2" required>
						</div>
						<br />
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroup-sizing-sm">Content</span>
							  </div>
							  <textarea style = "padding-bottom: 150px;"  maxlength="2500" id = "addNewsForm_CONTENT" name = "CONTENT"  type="text" class="form-control" placeholder="Content" aria-describedby="sizing-addon2"></textarea>
						</div>
						<br />
						  <input type = "image" class = "IMGDISPLAY" id = "addNewsIMGDISPLAY" width="300"></input>	
						  <input id = "addNewsForm_IMAGE" type = "file" accept="image/*"  name = "IMAGE" class = "form-control-file" value = ""></input>
						  <br />
						  <small>Dimension: 500 x 500 | Size: 200KB below</small>
					</div>
						<div class="modal-footer">
							<button type="submit" id="addNewsForm_SUBMIT" class="btn btn-primary" data-loading-text= "Adding..."> Add</button>
							 <button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
						</div>
				  </div>
			 </form>
		</div>
  	</div>

	<!-- Update News Modal -->
	 <div class="modal fade" id="updateNewsForm_MODAL" role="dialog">
			<div class="modal-dialog">
			<form id="updateNewsForm" method="post" action="library/form/updateNewsForm.php">
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
						<h5>Update News</h5>
					</div>
					<div class="modal-body">
					<input type="hidden" id="updateNewsForm_ID" name="ID" required />
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
									  </div>
									  <input id = "updateNewsForm_TITLE" name = "TITLE" type="text" class="form-control" placeholder="NAME" aria-describedby="sizing-addon2" required>
								</div>
								<br />
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm">Content</span>
									  </div>
									  <textarea style = "padding-bottom: 150px;" maxlength="2500" id = "updateNewsForm_CONTENT" name = "CONTENT"  type="text" class="form-control" placeholder="Content" aria-describedby="sizing-addon2"></textarea>
								</div>
								<br />
									  <input class="img-fluid" type = "image" id = "updateNewsForm_IMAGEVIEW" width="300"></input>	
									  <br />
									  <button id = "updateNewsForm_BTNWANTUPDATE" type = "button" class = "btn btn-block">Want to Update the Photo?</button>

									<div id = "updateNewsForm_UPDATEIMAGEDIV">
									  <input id = "updateNewsForm_IMAGE" type = "file" accept="image/*"  name = "IMAGE" value = ""></input>
									  <br />
									   <small>Dimension: Width: 1250 - 2100 | Height: 400 - 675 | Size: 500kb maximum</small>
										<br />
									</div>
<!--								   <input id = "updateNewsForm_IMAGE" type = "file" accept="image/*" class = "form-control-file" value = ""></input>-->
								<br />
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm">Added by</span>
									  </div>
									  <input id = "updateNewsForm_ADDEDBY" name = "ADDEDBY" type="text" class="form-control" placeholder="Added by" aria-describedby="sizing-addon2" disabled>
								</div>
								<br />
								<div class="form-group">
									  <select class="form-control" name = "STATUS" id="updateNewsForm_STATUS">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									  </select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" id="updateNewsForm_SUBMIT" class="btn btn-primary" data-loading-text="Updating..."> Update</button>
								<button type="button" class="btn btn-default" data-dismiss="modal"></span> Close</button>
							</div>
					</form>
				  </div>
			</div>
		</div>

	
	<!-- Delete Menu Modal -->
	<div class = "modal fade" id = "deleteNewsForm_MODAL" tabindex = "-1" role = "dialog">
		<div class = "modal-dialog">
			 <div class="modal-content">
				<div class ="modal-header">
					<h5>Delete News</h5>
				</div>
			<form id = "deleteNewsForm" method = "post" action = "library/form/deleteNewsForm.php">
					<div class = "modal-body">
						<div>
							<input type = "text" id ="deleteNewsForm_ID" name = "ID" style = "display: none;">
						</div>
					<p>Do you want to delete this record?:</p>
						<table class = "table">
							<thead>
							<tr>
								<td></td>
								<td><b>News Details</b></td>
							</tr>
							</thead>
							<tbody>
							<tr>
									<td>News Title: </td>
									<td id = "deleteNewsForm_TITLE"></td>
							</tr>
							<tr>
									<td>Content: </td>	
									<td id = "deleteNewsForm_CONTENT"></td>
							</tr>
							<tr>
									<td>Image: </td>
									<td><image class="img-fluid" id = "deleteNewsForm_IMAGEVIEW"></image></td>
							</tr>	
							<tr>
									<td>IMG Path: </td>
									<td id = "deleteNewsForm_IMAGE"></td>
							</tr>
							<tr>
									<td>Date Posted</td>
									<td id = "deleteNewsForm_DATEPOSTED"></td>
							</tr>
							<tr>
									<td>Status</td>
									<td id = "deleteNewsForm_STATUS"></td>
							</tr>
							<tr>
									<td>Post by</td>
									<td id = "deleteNewsForm_POSTBY"></td>
							</tr>
							</tbody>
						</table>
				  </div>
				<div class = "modal-footer">
					<button type = "submit" id = "deleteNewsForm_SUBMIT" class = "btn btn-danger" data-loading-text = "Deleting...">Delete</button>
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

	  
<!--     News Section -->
    <section id="about" class="aboutMain-section text-center">
      <div class = "container">
		  <div class = "row">
			 <div class = "col-lg-6">
			   
			  </div>
		  	<div class = "col-lg-6">
			  <header>
				  <a  class = "pull-right" id="manageButton" href="#" style="vertical-align:middle; margin-bottom: 35px;" role="button" data-toggle="modal" data-target="#addNewsForm_MODAL"><span>Upload News</span></a>	
					  <span id = "newsSearchBar" class="input-group pull-right searchBar" style ="margin-bottom: 20px;">
					   <input id="newsSearch" type="text" class="form-control" placeholder="Search News..." />
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
					<th>Title</th>
					<th>Content</th>
					<th>IMG Path</th>
					<th>View Image</th>
					<th>Date Posted</th>
					<th>Post By</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody id="newsList">
				</tbody>
			</table>	
			</div>
		  </div>
		  
		  <div class = "row">
		  	<div class = "col-lg-3 col-md-3 col-sm-3 col-xs-3 mx-auto">
			  <nav aria-label="...">
				  <ul class="pagination pagination-sm">
					
					 <li class="page-item">
					  <a class="page-link <?php echo $disable_previous; ?>" style="<?php echo $disable_previous2; ?>" href="manage-news.php?search=<?php echo $search; ?>&page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
					</li>
					<?php   	
					  	for($i = 1; $i <= $total_page; $i++)
						{
							?>
					  	<li id = "paginationActive<?php echo $i; ?>" class="page-item">
							<a class="page-link" href="manage-news.php?search=<?php echo $search; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
					    </li>
					  
					  <?php
						}
					  ?>
					
					<li class="page-item">
					  <a class = "page-link <?php echo $disable_next; ?>" style="<?php echo $disable_next2; ?>" href="manage-news.php?search=<?php echo $search; ?>&page=<?php echo $page + 1; ?>" >Next</a>
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
	newsList: document.getElementById('newsList')
	};
	
	var _URL = window.URL || window.webkitURL;
	
	
	$(document).ready(function() {
		$('#updateNewsForm_UPDATEIMAGEDIV').hide();
		$('#updateNewsForm_BTNWANTUPDATE').click( function()
		{
			$(this).hide();
			$( "#updateNewsForm_IMAGE" ).click();
			$('#updateNewsForm_UPDATEIMAGEDIV').show();
			
			updateNewsForm.imageview.src = '';

		});
	});
	

	$('#addNewsForm_IMAGE').change( function(event) {
		var file, img;
		if ((file = this.files[0])) {
			img = new Image();
			img.onload = function () {
				if(this.width < 1250 || this.width > 2100)
					{
						alert("Invalid Dimensions: Width is too big [Ideal Width: 1250 - 2100]");
						document.getElementById("addNewsForm_IMAGE").value = "";
						$("#addNewsIMGDISPLAY").css('display', 'none');
					}
				else if(this.height < 400 || this.height > 675)
					{
						alert("Invalid Dimensions: Height is too big [Ideal Height: 400 - 675]");
						document.getElementById("addNewsForm_IMAGE").value = "";
						$("#addNewsIMGDISPLAY").css('display', 'none');
					}
				else
					{
						$("#addNewsIMGDISPLAY").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
					}
				
			};
			img.src = _URL.createObjectURL(file);
		}
		
	});
	
	$('#updateNewsForm_IMAGE').change( function(event) {
		var file, img;
		if ((file = this.files[0])) {
			img = new Image();
			img.onload = function () {
				if(this.width < 1250 || this.width > 2100)
					{
						alert("Invalid Dimensions: Width is too big [Ideal Width: 1250 - 2100]");
						document.getElementById("updateNewsForm_IMAGE").value = "";
						$("#updateNewsForm_IMAGEVIEW").css('display', 'none');
					}
				else if(this.height < 400 || this.height > 675)
					{
						
						alert("Invalid Dimensions: Height is too big [Ideal Height: 400 - 675]");
						document.getElementById("updateNewsForm_IMAGE").value = "";
						$("#updateNewsForm_IMAGEVIEW").css('display', 'none');
					}
				else
					{
						$("#updateNewsForm_IMAGEVIEW").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
					}
				
			};
			img.src = _URL.createObjectURL(file);
		}
		
	});
	
	$(document).ready(function(){
		$("#paginationActive<?php echo $page ?>").addClass("active");
		$("#newsSearch").val('<?php echo $search; ?>');
		$("#newsSearch").click(function(){
			this.value = '';
			 $( "#searchBar" ).click(function() {
			  jQuery('#newsSearch').empty();
			  var searchValue = $("#newsSearch").val().toLowerCase(); 
				window.location.href='manage-news.php?search='+searchValue;
				 
				});

				$('#newsSearch').keypress(function(e){
				if(e.which == 13){//Enter key pressed
					$('#searchBar').click();//Trigger search button click event
				}
			});
		});
	});
	
	
	function fillDisplayModal(id)
	{
		var image = document.getElementById('news_IMAGE_'+id).innerHTML;
		
		document.getElementById('displayModal_IMAGESRC').innerHTML = "Image source: "+image;
		document.getElementById("displayModal_IMAGE").src = "img/news/"+image;
		$("#displayModal_MODAL").modal('show');
	}
	
	// Add news
	
	var addNewsForm = {
		form: document.getElementById('addNewsForm'),
		modal: document.getElementById('addNewsForm_MODAL'),
		title: document.getElementById('addNewsForm_TITLE'),
		content: document.getElementById('addNewsForm_CONTENT'),
		image: document.getElementById('addNewsForm_IMAGE'),
		imageview: document.getElementById('addNewsIMGDISPLAY'),
		submit: '#addNewsForm_SUBMIT'	
	}
	
	addNewsForm.form.onsubmit = function (e)
	{
		e.preventDefault();
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				$(addNewsForm.submit).button('loading');
			},
			
			uploadProgress:function(event,position,total,percentComplete)
			{
				
			},
			success:function(data)
			{
				$(addNewsForm.submit).button('reset');
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
										$(addNewsForm.modal).modal('hide');
										alert('Added Succesfully');
										id = message.substring(0, i);
										imageurl = message.substring(i+1,message.length);

										addNewsList(id, addNewsForm.title.value,addNewsForm.content.value, imageurl, '<?php echo $session_USER_FULLNAME; ?>', 'Active', Date.now());
										
										addNewsForm.form.reset();
										addNewsForm.imageview.src = '';
									}
							}
						
					}
				else if(!isWhitespace(GetWarningMsg(server_message)))
					{
						alert('warning');
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
	
	// UPDATE MENU FORM
	
	var updateNewsForm = {
		form: document.getElementById('updateNewsForm'),
		modal: document.getElementById('updateNewsForm_MODAL'),
		id: document.getElementById('updateNewsForm_ID'),
		title: document.getElementById('updateNewsForm_TITLE'),
		image: document.getElementById('updateNewsForm_IMAGE'),
		imageview: document.getElementById('updateNewsForm_IMAGEVIEW'),
		content: document.getElementById('updateNewsForm_CONTENT'),
		status: document.getElementById('updateNewsForm_STATUS'),
		addedby: document.getElementById('updateNewsForm_ADDEDBY'),
		submit : '#updateNewsForm_SUBMIT'
	};
	
	function updateNewsFill(id) {
		var title = document.getElementById('news_TITLE_' + id).innerHTML;
		var content = document.getElementById('news_CONTENT_' + id).innerHTML;
		var image = document.getElementById('news_IMAGE_'+id).innerHTML;
		var status = document.getElementById('news_STATUS_'+id).innerHTML;
		var addedby = document.getElementById('news_ACCOUNTNAME_'+id).innerHTML;
		
		for(var i = 0; i < updateNewsForm.status.options.length; i++)
			{
				if(updateNewsForm.status.options[i].text == status)
					{
						updateNewsForm.status.selectedIndex = i;
					}
			}
		
		updateNewsForm.title.value = title;
		updateNewsForm.content.value = content;
		updateNewsForm.id.value = id;
		updateNewsForm.addedby.value = addedby;
		updateNewsForm.imageview.src = "img/news/"+image;
	}
	
	
	function updateNews(id, title, content, image, status)
	{
		document.getElementById('news_TITLE_'+id).innerHTML = title;
		document.getElementById('news_CONTENT_'+id).innerHTML = content;
		document.getElementById('news_IMAGE_'+id).innerHTML = image;
		document.getElementById('news_STATUS_'+id).innerHTML = status;
		// image add here
		updateNewsForm.form.reset();
	}
	
	
	
	updateNewsForm.form.onsubmit = function(e) {
		e.preventDefault();
		
		$(this).ajaxSubmit({
			beforeSend:function()
			{
				$(updateNewsForm.submit).button('loading');
			},
			uploadProgress:function(event,position,total,percentCompelete)
			{

			},
			success:function(data)
			{
				$(updateNewsForm.submit).button('reset');
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
									$(updateNewsForm.modal).modal('hide');
									alert('Succesfully Updated');
									id = message.substring(0, i);
									imageurl = message.substring(i+1,message.length);

									updateNews(id,updateNewsForm.title.value,updateNewsForm.content.value, imageurl, updateNewsForm.status.options[updateNewsForm.status.selectedIndex].text);
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
	
	
	// delete News

	var deleteNewsForm =
		{
			form: document.getElementById('deleteNewsForm'),
			modal: document.getElementById('deleteNewsForm_MODAL'),
			id: document.getElementById('deleteNewsForm_ID'),
			title: document.getElementById('deleteNewsForm_TITLE'),
			content: document.getElementById('deleteNewsForm_CONTENT'),
			image: document.getElementById('deleteNewsForm_IMAGE'),
			imageview: document.getElementById('deleteNewsForm_IMAGEVIEW'),
			dateposted: document.getElementById('deleteNewsForm_DATEPOSTED'),
			postby: document.getElementById('deleteNewsForm_POSTBY'),
			status: document.getElementById('deleteNewsForm_STATUS'),
			submit: '#deleteNewsForm_SUBMIT'
		}
	
	$(deleteNewsForm.form).on('submit', function (e) {
        var id = deleteNewsForm.id.value;

        e.preventDefault();
        $(this).ajaxSubmit({
            beforeSend:function()
            {
                $(deleteNewsForm.submit).button('loading');
            },
            uploadProgress:function(event,position,total,percentCompelete)
            {

            },
            success:function(data)
            {
                $(deleteNewsForm.submit).button('reset');
				deleteNews(id);
				deleteNewsForm.form.reset();
				$(deleteNewsForm.modal).modal('hide');
				alert('Succesfully Deleted');
            }
        });
    });
	
	function deleteNews(id) {
        $('#news_' + id).remove();
    }

    function openDeleteNewsModal(id) {
		var imageLink = document.getElementById('news_IMAGE_'+id).innerHTML;
		
        deleteNewsForm.id.value = id;
        deleteNewsForm.title.innerHTML = document.getElementById('news_TITLE_' + id).innerHTML;
        deleteNewsForm.content.innerHTML = document.getElementById('news_CONTENT_' + id).innerHTML;
        deleteNewsForm.image.innerHTML = document.getElementById('news_IMAGE_' + id).innerHTML;
        deleteNewsForm.dateposted.innerHTML = document.getElementById('news_DATEPOSTED_' + id).innerHTML;
        deleteNewsForm.status.innerHTML = document.getElementById('news_STATUS_' + id).innerHTML;
		deleteNewsForm.postby.innerHTML = document.getElementById('news_ACCOUNTNAME_' + id).innerHTML;
		deleteNewsForm.imageview.src = "img/news/"+imageLink;
		 

        $(deleteNewsForm.modal).modal('show');
    }
	
	
	// Add News into Table
	
	function addNewsList(id, title, content, image, accountname, status, dateposted)
	{
		PageComponent.newsList.innerHTML = PageComponent.newsList.innerHTML +
			'<tr>'+
			'<tr id = "news_' + id + '">'+
			'	<td id = "news_TITLE_' + id + '">' + title + '</td>'+
			'	<td id = "news_CONTENT_' + id + '">' + content + '</td>'+
			'	<td id = "news_IMAGE_' + id + '">' + image + '</td>'+
			'<td><button role="button" class="btn btn-primary" onclick="fillDisplayModal(' + id + ')"><i class="fas fa-eye"></i></button></td>'+
			'	<td id = "news_DATEPOSTED_' + id + '">' + dateposted + '</td>'+
			'	<td id = "news_ACCOUNTNAME_' + id + '">' + accountname + '</td>'+
			'	<td id = "news_STATUS_' + id + '">' + status + '</td>'+
			'   <td><span><button id="menu_BTNUPDATE_' + id + '" value="' + id + '" class="btn btn-primary" data-target = "#updateNewsForm_MODAL" data-toggle = "modal" onclick = "updateNewsFill(\'' + id + '\')"><i class="fas fa-edit"></i></button><button id="menu_BTNDELETE_' + id + '" value="' + id + '" class="btn btn-warning" role = "button" onclick="openDeleteNewsModal(' + id + ')"><i class="fas fa-trash"></i></button></span></td>'+
            '<tr>';
	}
	
	<?php
		
					$list_sql = 'SELECT article.ID AS ARTICLEID, article.TITLE, article.IMAGE, article.CONTENT, article.DATEPOSTED, article.STATUS, CONCAT(account_user.FNAME, " ", account_user.MNAME, " ", account_user.LNAME) AS ACCOUNTNAME 
					
					FROM (SELECT * FROM article WHERE article.TITLE LIKE "%'.$search.'%") AS article
					LEFT JOIN account_user
					ON account_user.ID =  article.POSTBY 
					
					
					ORDER BY article.TITLE
					LIMIT ' .$limit.'
					OFFSET '.$offset;
	
			$list_result = $db->connection->query($list_sql);
			$list_count = mysqli_num_rows($list_result);
	
			if($list_count < 1)
			{
				?>
	
				var content = '<tr>'+
					'<tr id = "">'+
					'	<td id = "news_TITLE_">No Article Found</td>'+
					'<tr>';
				
				$("#newsList").append(content);
					
		
			<?php
				
			}
	else
	{
		while($list_row = $list_result->fetch_assoc())
		{
			$result_ID = htmlspecialchars($list_row['ARTICLEID']);
			$result_TITLE = htmlspecialchars($list_row['TITLE']);
			$result_CONTENT = htmlspecialchars($list_row['CONTENT']);
			$result_ACCOUNTNANE = htmlspecialchars($list_row['ACCOUNTNAME']);
			$result_STATUS = htmlspecialchars($list_row['STATUS']);
			$result_DATEPOSTED = htmlspecialchars($list_row['DATEPOSTED']);
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
			
			addNewsList("<?php echo $result_ID;?>","<?php echo $result_TITLE; ?>","<?php echo $result_CONTENT?>","<?php echo $result_IMAGE;?>","<?php echo $result_ACCOUNTNANE;?>","<?php echo $result_STATUS; ?>", "<?php echo $result_DATEPOSTED?>");
	
	<?php
		}
	}
	?>
	
	
</script>

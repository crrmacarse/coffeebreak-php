<?php

	session_start();
	include('library/form/connection.php');
	$db = new db();
	
	if(isset($_SESSION['USER_USERNAME']))
		{
			header('Location: index.php');
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

    <title>Coffeebreak Caf&eacute; International Inc. | Login</title>

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

	  
	<!--  Log-in Section -->
    <section id="loginMain" class="loginMain-section text-center">
      <div class="container">
        <div class="row">
			<div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12">
			
				<span style="font-family:'HelveticaBlkFile', sans-serif; font-size: 3.5em;; color:#d7933c;">coffee</span><span id="fadelogostretch" style="font-family:'Helvetica45File', sans-serif; font-size: 3.5em;;color:#d7933c;">break</span>
							<p>Content Management System</p>
			</div> 
			<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<form action = "library/form/loginForm.php" method="post" id="loginForm"> 
				<div id = "loginForm_msgbox" tabindex="0" style = "color: black"></div>
					<input type ="text" name = "USERNAME" id = "loginForm_USERNAME" class="form-control" placeholder="Username" required>
					<input type ="password" name = "PASSWORD" id = "loginForm_PASSWORD" class="form-control" placeholder="Password" required>
					<span class = "pull-right">
						<br>
						<input type="submit" id="loginForm_SUBMIT" data-loading-text="Logging in..." class="btn btn-primary" value="Login" />
					</span>
			</form>
			</div> 
        </div>
		  	<br>
		  	<small class = "pull-right" style = "text-align	: right">
				Forgot password? <br>Contact the MIS Department.
			</small>
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
	
	 var loginForm = {
        form: document.getElementById('loginForm'),
        username: document.getElementById('loginForm_USERNAME'),
        password: document.getElementById('loginForm_PASSWORD'),
		msgbox: 'loginForm_msgbox',
        submit: document.getElementById('loginForm_SUBMIT')
    };

	$(loginForm.form).on('submit', function (e) {
        var username = loginForm.password.value;
        e.preventDefault();
        $(this).ajaxSubmit({
            beforeSend:function()
            {
                $(loginForm.submit).button('loading');
            },
            uploadProgress:function(event,position,total,percentCompelete)
            {

            },
            success:function(data)
            {
				
				$(loginForm.submit).button('reset');
				var server_message = data.trim();
				if(!isWhitespace(GetSuccessMsg(server_message)))
				{
					loginForm.form.reset();
					validateAccess(GetSuccessMsg(server_message));
				}
				else if(!isWhitespace(GetErrorMsg(server_message)))
				{
					alert(GetErrorMsg(data));
					clearPassword();
				}
				else if(!isWhitespace(GetWarningMsg(server_message)))
				{
					alert(GetWarningMsg(data));
					clearPassword();
				}
				else if(!isWhitespace(GetServerMsg(server_message)))
				{
					alert(GetServerMsg(data));
					clearAllField();
				}
				else
				{
					alert('Oh Snap! There is a problem with the server or your connection.');
				}
            }
        });
    });	
	
	// textbox clear JS
	function clearAllField()
	{
		$("#loginForm_USERNAME").val('');
		$("#loginForm_PASSWORD").val('');
	}
	
	function clearPassword()
	{
		$("#loginForm_PASSWORD").val('');
	}
	
	// moves user to other page depending on group id
	function validateAccess(id)
	{
			switch (id)
				{
					case 'admin':
						window.location = 'cms.php';
						break;
					case 'marketing':
						window.location = 'cms.php';
						break;
					case 'dummy':
						window.location = 'index.php';
						break;	
					Default:
						window.location = 'index.php';
						break;
				}
	}
	
	
</script>

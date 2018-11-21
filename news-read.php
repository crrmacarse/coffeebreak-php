<?php
	
		session_start();
		include('library/form/connection.php');
		$db = new db();

		$newsID = isset($_GET['id']) ? $_GET['id'] : '';

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coffeebreak Caf&eacute; International Inc. | News</title>

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

  <body id="page-top">

    <!-- Navbar Section -->
    <?php include('library/html/navbar.php'); ?>  

	<!-- Menu Section -->
    <section id="newsMain" class="newsMain-section">
      <div class="container">

		<div class = "row">
	  
		<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">	
				<div id = "newsDisplay"></div>
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

	<!-- Swiper Plug-in -->
	<script src="js/swiper.min.js"></script>

  </body>

</html>

<script>
		
	 

	function addNewsDisplay(id,title, author, image, dateposted,content)
	{
			var content = '<p id = "newsDisplayTitle">' + title + '</p>'+
							'<small>'+
								 '<i class="far fa-clock"></i>&nbsp; ' + dateposted + '&nbsp;|&nbsp;'+
								 '<i class="fas fa-pencil-alt"></i>&nbsp; ' + author + '</small><br><br>'+
							'<image id = "newsDisplayIMAGE" style = "padding-bottom: 25px;" class = "img-fluid" src = "img/news/' + image + '"></image>'+
							'<div style = "text-indent: 60px;"><small>' + content + '</small></div>';
			
			$("#newsDisplay").append(content);
	}	
	
	
	<?php
		
			$list_sql = $db->connection->prepare("SELECT article.ID, article.TITLE, article.CONTENT, article.IMAGE, article.DATEPOSTED, article.STATUS, CONCAT(account_user.FNAME, ' ', account_user.MNAME, ' ', account_user.LNAME) AS ACCOUNTNAME
				
					FROM article
                	
					LEFT JOIN account_user
                    ON account_user.ID = article.POSTBY

						
					WHERE article.ID =?");
			
			$list_sql->bind_param("s", $newsID);
	 		$list_sql->execute();
			$list_sql->bind_result($id,$title,$content,$image,$dateposted,$status,$accountname);
		
			
			// $list_count = mysqli_num_rows($list_result);
			

			while($list_row = $list_sql ->fetch())
			{
					$result_ID = $id;
					$result_TITLE = $title;
					$result_IMAGE = $image;
					$result_DATEPOSTED = $dateposted;
					$result_POSTBY = $accountname;
					$result_CONTENT = $content;
			?>
				addNewsDisplay("<?php echo $result_ID; ?>","<?php echo $result_TITLE; ?>","<?php echo $result_POSTBY; ?>","<?php echo $result_IMAGE; ?>","<?php echo $result_DATEPOSTED; ?>","<?php echo $result_CONTENT; ?>");

			<?php
				}

			?>

	
	

	
</script>

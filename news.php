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
			<div id = "newsPicDisplay" class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php 
						
								$sql_IMGLOAD = "SELECT ID, IMAGE FROM article";
								$result_IMGLOAD = $db->connection->query($sql_IMGLOAD);
								$count_IMGLOAD = mysqli_num_rows($result_IMGLOAD);
								while($row_IMGLOAD = $result_IMGLOAD->fetch_assoc())
								{
									?>
								 <div class="swiper-slide">
								 <a href = "news-read.php?id=<?php echo $row_IMGLOAD['ID']; ?>" id = "newsReadHREF">
									<img class = "img-fluid" src = "img/news/<?php echo $row_IMGLOAD['IMAGE']; ?>">
								 </a>
								</div>
								<?php
								}
							?>
					
					
					</div>
					<!-- Add Pagination -->
					<div class="swiper-pagination"></div>
					<!-- Add Arrows -->
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
			  </div>
			</div>
          </div>
		<div class = "row">
			<div class = "col-lg-3 col-md-3 col-sm-3 col-xs-3">
				 <div class="card">
				  <h6 class="card-header">Latest News</h6>
					 <span id = "latestNews"></span>
				</div>
			</div>
	  
		<div class = "col-lg-9 col-md-9 col-sm-9 col-xs-9">
				<?php

						$sql = "SELECT ID, TITLE, CONTENT, IMAGE, DATEPOSTED, STATUS 
		
									FROM article
									
									ORDER BY DATEPOSTED
									LIMIT 1";
						$result = $db->connection->query($sql);
						$count = mysqli_num_rows($result);
						while($row = $result->fetch_assoc()){
							?>
						
						<p id = "newsDisplayTitle"><?php echo $row['TITLE']; ?></p>
							<small>
								 <i class="far fa-clock"></i>
								 <?php echo $row['DATEPOSTED']; ?>
								&nbsp;|&nbsp;
								 <i class="fas fa-pencil-alt"></i>
								 Juan Dela Cruz
							</small>
							<br><br>
							<image id = "newsDisplayIMAGE" style = "padding-bottom: 25px;" class = "img-fluid" src = "img/news/<?php echo $row['IMAGE']; ?>"></image>
							<br>
							<div style = "text-indent: 60px;">
							<small><?php echo $row['CONTENT']; ?></small>
							</div>
						<?php      
							}
						?>

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
		
	  var PageComponent = {
        latestNews: document.getElementById('latestNews')
    };
	
	
	 var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
	  speed: 2000,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
	  pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
	
	function addLatest(id, title, content, dateposted, status) {
        PageComponent.latestNews.innerHTML = PageComponent.latestNews.innerHTML +
            			'<div id = "latestNewsBox" class="card-block">'+
						'<a href="news-read.php?id=' + id + '"><h6 class="card-title">'+ title +'</h6></a>'+
						'<p id = "latestNewsText" class="card-text">'+ contentMinimize(content) +'...</p>'+
						'<a href="news-read.php?id=' + id + '"><b>Read more...</b></a>'+
						'<hr style = "border-top: 1px solid #dfdfdf"></div>';
    }
	
	$(document).ready(function()
	{
		$('#newsReadHREF').click(function()
		{
			
		})
		
	});
	
	function contentMinimize(content)
	{
		var output = content.slice(0,180);
		
		return output;
	}
	
	<?php
		
		$list_sql = 'SELECT ID, TITLE, CONTENT, DATEPOSTED, STATUS 
		
									FROM article
									
									ORDER BY DATEPOSTED
                                    DESC LIMIT 1,3';
		$list_result = $db->connection->query($list_sql);
		$list_count = mysqli_num_rows($list_result);

		while ($list_row = $list_result->fetch_assoc()) {
			
			$result_ID = htmlspecialchars($list_row['ID']);
			$result_TITLE = htmlspecialchars($list_row['TITLE']);
			$result_CONTENT = htmlspecialchars($list_row['CONTENT']);
			$result_DATEPOSTED = htmlspecialchars($list_row['DATEPOSTED']);
			$result_STATUS = htmlspecialchars($list_row['STATUS']);
		?>
	
		addLatest("<?php echo $result_ID; ?>","<?php echo $result_TITLE; ?>","<?php echo $result_CONTENT; ?>","<?php echo $result_DATEPOSTED; ?>","<?php echo $result_STATUS; ?>");

		<?php
			}
		
	?>
	
	

	
</script>

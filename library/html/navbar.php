<?php 

 $user = false;
 $username = '';
if(isset($_SESSION['USER_USERNAME']) and isset($_SESSION['USER_GROUPID']))
  {
    $user = true;
	$userID = $_SESSION['USER_ID'];
    $username = $_SESSION['USER_USERNAME'];
    $session_USER_FNAME = htmlspecialchars($_SESSION['USER_FNAME']);
    $session_USER_MNAME = htmlspecialchars($_SESSION['USER_MNAME']);
    $session_USER_LNAME = htmlspecialchars($_SESSION['USER_LNAME']);
	$session_USER_FULLNAME = $session_USER_FNAME . ' ' . $session_USER_MNAME . ' ' . $session_USER_LNAME;

    
    switch($_SESSION["USER_GROUPID"])
    {
      case '1':
			// restriction removed
			// include('../../html/library/form/adminOnly.php');
        break;
      case '2':
			// marketing restriction
        break;
	   case '3':
			// dummy restriction
        break;
       default:
       $user = false; 

    }
  }

?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger"
		   <?php 
		   if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false)
		   {
			   ?>
		  		href="#"
		   <?php
		   }
		   else
		   {
			   ?>
		   		href="index.php"
		   <?php
			   }
			?>
			><img src="img/coffeebreakLogo.png"></a>
		  	
		  <?php if($user)
                { 
                ?>
		  	<a href = "logout.php" class="navbar-toggler navbar-toggler-right" style = "border: none; color: #ffb24a; font-size: 1.5em;" ><i class="fas fa-sign-out-alt"></i></a>
		     <?php  
                }  
                else  
                {  
                ?>  
              
                <?php  
                }  
                ?>  
  	     
        <div class="collapse navbar-collapse" id="navbarResponsive">

          <ul class="navbar-nav ml-auto strokeOutline" id = "navbar-options">
				<?php if($user)
                { 
                ?>
                <li> 
				<div class="dropdown show">
				  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo $username ?>
				  </a>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a id = "AccountDropDownItem" class="dropdown-item" href="cms.php">CMS</a>
					 <div class="dropdown-divider"></div>  
					<a id = "AccountDropDownItem" class="dropdown-item" href="logout.php">Log-out</a>
				  </div>
				</div>
                 
                </li>
			  	
                <?php  
                }  
                else  
                {  
                ?>  
              
                <?php  
                }  
                ?>  
          </ul>
        </div>
      </div>
    </nav>
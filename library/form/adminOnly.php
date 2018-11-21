<?php

if(isset($_SESSION['USER_USERNAME']) and isset($_SESSION['USER_GROUPID']))
	{
		if($_SESSION['USER_GROUPID'] !=  '1')
		{
			header('Location: index.php');
			exit;
		}
	}
	else {
		header('Location: index.php');
		exit;
	}

?>
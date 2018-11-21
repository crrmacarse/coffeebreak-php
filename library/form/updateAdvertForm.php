<?php
/*
 * _____________________________________________________________________________________
 *
 * TITLE: 			The Update Advertisement Form
 * DESCRIPTION: 	Code for the updating of Advertisement
 * _____________________________________________________________________________________
 *
 * RETURN KEYWORDS:
 *
 * success: *updated ID*	-> 	If encoded successfully
 * error: *message for error* 	-> 	If encoded unsuccessfully
 *______________________________________________________________________________________
 *
 * VARIABLES:
 *
 *	$_SESSION['USER_ID'];
 *	$_POST['ID']
 *	$_POST['CONTENT']
 *	$_POST['STATUS']
 *	// Image here
 *	
 *
 *
 *__________________________________________________________________________________________________________
 *
 * Note: you can send a custom message by typing keywords 'msg:', 'success:', 'error:', and 'warning:' 
 *		 followed by your message. Just make sure that there are no printed or echoed before the keyword.
 *__________________________________________________________________________________________________________
 *
 */
 
session_start();
include('../form/connection.php');
$db = new db();

$form_UPLOADER = $_SESSION['USER_ID'];
$form_ID = $db->connection->real_escape_string($_POST['ID']);
$form_NAME = $db->connection->real_escape_string($_POST['NAME']);
$form_DESCRIPTION = $db->connection->real_escape_string($_POST['DESCRIPTION']);
$form_STATUS = $db->connection->real_escape_string($_POST['STATUS']);

	$sql_GETIMAGE = 'SELECT IMAGE FROM advertisement WHERE id = '.$form_ID;
	$result_GETIMAGE = $db->connection->query($sql_GETIMAGE);
	$count_GETIMAGE = mysqli_num_rows($result_GETIMAGE);
	$row_GETIMAGE = $result_GETIMAGE->fetch_assoc();
	
	$form_IMAGE = $row_GETIMAGE['IMAGE'];


function getextension($str) {
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}


if(isset($_FILES['IMAGE']['name'])){
		
		if(!$_FILES['IMAGE']['error'])
		{
				$new_file_name = stripslashes($_FILES['IMAGE']['name']);
				$extension = strtolower(getextension($new_file_name));

				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") ){
					die('error: Image file types only');
				}

				if($_FILES['IMAGE']['size'] > (200000)){
					$valid_file = false;
					echo('error: Your file\'s size is to large.');
				}else{
					$valid_file = true;
				}

				if($valid_file){
						$form_IMAGE =md5(date("ymdHis")).'.'.$extension;
						$path='../../img/advert/';
						$newname=$path.$form_IMAGE;

						move_uploaded_file($_FILES['IMAGE']['tmp_name'],$newname);
	
						$sql_ADVERTISEMENT = "UPDATE advertisement SET
						NAME = '$form_NAME',
						DESCRIPTION = '$form_DESCRIPTION',
						IMAGE = '$form_IMAGE',
						STATUS = $form_STATUS
						WHERE
						ID = $form_ID";
					

					if($db->connection->query($sql_ADVERTISEMENT))
					{
						echo 'success: ' . $form_ID . ',' . $form_IMAGE;	
					}
					else 
					{
						echo 'error: Error in updating Advertisement';

					}

				}

		}
		else
		{
			echo 'warning: There is an error in updating the image';

		}
	}
	else
	{
		
		$sql_withNOIMAGE = "UPDATE advertisement SET
						NAME = '$form_NAME',
						DESCRIPTION = '$form_DESCRIPTION',
						STATUS = $form_STATUS
						WHERE
						ID = $form_ID";
		
		if($db->connection->query($sql_withNOIMAGE))
					{
						echo 'success: ' . $form_ID . ',' . $form_IMAGE;	
					}
					else 
					{
						echo 'error: Error in updating Advertisement';

					}
		
	}
?>
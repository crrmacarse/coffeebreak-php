<?php
/*
 *__________________________________________________________________________________________________________
 *
 * TITLE: 			Menu Add
 * DESCRIPTION: 	Code for adding new menu
 *__________________________________________________________________________________________________________
 *
 * RETURN KEYWORDS:
 *
 * success: *message for success*	-> 	If encoded successfully
 * error: *message for error* 	-> 	If encoded unsuccessfully
 *__________________________________________________________________________________________________________
 *
 * VARIABLES:
 *
 * $_POST['NAME'];
 * $_POST['GROUP'];
 * $_POST['RECOMMENDATION'];
 * $_POST['DESCRIPTION'];
 * $_POST['IMAGE'];

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
$form_NAME = $db->connection->real_escape_string($_POST['NAME']);
$form_GROUP = $db->connection->real_escape_string($_POST['GROUP']);
$form_RECOMMENDATION = $db->connection->real_escape_string($_POST['RECOMMENDATION']);
$form_DESCRIPTION = $db->connection->real_escape_string($_POST['DESCRIPTION']);
$form_IMAGE = '';

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
					$path='../../img/menu/';
					$newname=$path.$form_IMAGE;

					move_uploaded_file($_FILES['IMAGE']['tmp_name'],$newname);

						$sql_MENU = "INSERT INTO product_item
						(GROUPID,NAME,DESCRIPTION,IMAGE,recommendation, STATUS, ADDEDBY)
						VALUES
						(
						$form_GROUP, 
						'$form_NAME', 
						'$form_DESCRIPTION',
						'$form_IMAGE',
						'$form_RECOMMENDATION',
						1,
						$form_UPLOADER
						)";

					if($db->connection->query($sql_MENU))
					{
						$sql_id = $db->connection->insert_id;
						echo 'success:  ' . $sql_id . ',' . $form_IMAGE;	
					}
					else 
					{
						echo 'error: Error in adding menu';

					}

				}

			}
			else
			{
				echo 'warning: There is an error in adding';

			}
		}
		else
		{
			echo 'msg: Image not found';
		}

	

?>
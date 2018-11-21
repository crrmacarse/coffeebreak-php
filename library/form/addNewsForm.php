<?php
/*
 *__________________________________________________________________________________________________________
 *
 * TITLE: 			News Add
 * DESCRIPTION: 	Code for adding new news
 *__________________________________________________________________________________________________________
 *
 * RETURN KEYWORDS:
 *
 * success: *message for success*	-> 	If encoded successfully
 * error: *message for error* 	-> 	If encoded unsuccessfully
 *
 *__________________________________________________________________________________________________________
 *
 * VARIABLES:
 *
 * $_POST['NAME'];
 * $_POST['ADDRESS'];
 * $_POST['LAT'];
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
$form_TITLE = $db->connection->real_escape_string($_POST['TITLE']);
$form_CONTENT = $db->connection->real_escape_string($_POST['CONTENT']);
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
				echo('error: Image file types only');
			}

			if($_FILES['IMAGE']['size'] > (200000)){
				$valid_file = false;
				die('error: Your file\'s size is to large.');
			}else{
				$valid_file = true;
			}

			if($valid_file){
				$form_IMAGE=md5(date("ymdHis")).'.'.$extension;
				$path='../../img/news/';
				$newname=$path.$form_IMAGE;

				move_uploaded_file($_FILES['IMAGE']['tmp_name'],$newname);

			$sql_NEWS = "INSERT INTO article(POSTBY, TITLE, CONTENT, IMAGE, STATUS)
			VALUES
			(
			$form_UPLOADER,
			'$form_TITLE',
			'$form_CONTENT',
			'$form_IMAGE',
			'1'
			)";

			if($db->connection->query($sql_NEWS))
			{
				$sql_id = $db->connection->insert_id;
				echo 'success: ' . $sql_id . ',' . $form_IMAGE;

			}
			else 
			{
				echo 'error: Error in adding news';

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
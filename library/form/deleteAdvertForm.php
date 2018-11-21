<?php
/*
 *__________________________________________________________________________________________________________
 *
 * TITLE: 			Advertisement Delete
 * DESCRIPTION: 	Code for deleting Advertisement;
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
 * $_POST['ID']
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


$form_ID = $_POST['ID'];
$form_IMAGE = $FILE_['IMAGE']['name'];
$path='../../img/advert/';

$sql = "DELETE FROM advertisement WHERE ID = $form_ID";

if($db->connection->query($sql)) {
	$finalpath = $path . $form_IMAGE;
	if(unlink($finalpath))
	{
		echo 'success:'. $finalpath;
	}
	else
	{
		echo 'error: There is an error trying to delete the image path';
	}
	
}
else {
	echo 'error: Deletion Failed.';
}
?>
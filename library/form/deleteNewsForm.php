<?php
/*
 *__________________________________________________________________________________________________________
 *
 * TITLE: 			News Delete
 * DESCRIPTION: 	Code for deleting News;
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

$sql = "DELETE FROM article WHERE ID = $form_ID";

if($db->connection->query($sql)) {
	echo 'success: Deletion Success!';
}
else {
	echo 'error: Deletion Failed.';
}
?>
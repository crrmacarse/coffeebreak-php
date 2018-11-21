<?php
/*
 *__________________________________________________________________________________________________________
 *
 * TITLE: 			Store Add
 * DESCRIPTION: 	Code for adding new store
 *__________________________________________________________________________________________________________
 *
 * RETURN KEYWORDS:
 *
 * success: *message for success*	-> 	If encoded successfully
 * error: *message for error* 	-> 	If encoded unsuccessfully
 * warning: *message for error* 	-> 	If encoded unsuccessfully
 *__________________________________________________________________________________________________________
 *
 * VARIABLES:
 *
 * $_POST['NAME'];
 * $_POST['ADDRESS'];
 * $_POST['LAT'];
 * $_POST['LNG'];
 * $_POST['ZINDEX'];
 * $_POST['CONTACT'];
 * $_POST['ISWIFI'];
 * $_POST['ISPARKING'];
 * $_POST['HOUROPERATION'];
 * $_POST['ADDEDBY'];
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
$form_NAME = $db->connection->real_escape_string($_POST['NAME']);
$form_ADDRESS = $db->connection->real_escape_string($_POST['ADDRESS']);
$form_CONTACT = $db->connection->real_escape_string($_POST['CONTACT']);
$form_LAT = $db->connection->real_escape_string($_POST['LAT']);
$form_LNG = $db->connection->real_escape_string($_POST['LNG']);
$form_ZINDEX = $db->connection->real_escape_string($_POST['ZINDEX']);
$form_ISWIFI = $db->connection->real_escape_string($_POST['ISWIFI']);
$form_ISPARKING = $db->connection->real_escape_string($_POST['ISPARKING']);
$form_HOUROPERATION = $db->connection->real_escape_string($_POST['HOUROPERATION']);

	
	$sql_COORDINATES = "INSERT INTO coordinates(LAT,LNG, ZINDEX)
						VALUES
						(
						$form_LAT,
						$form_LNG,
						$form_ZINDEX
						)";

	if($db->connection->query($sql_COORDINATES))
	{
		$sql_COORDINATES_ID = $db->connection->insert_id;
		$sql_STORE = "INSERT INTO store(NAME,ADDRESS,COORDINATES,CONTACT,ISWIFI,ISPARKING,HOUROPERATION, CREATEDBY, STATUS)
		VALUES
		(
		'$form_NAME', 
		'$form_ADDRESS',
		$sql_COORDINATES_ID,
		$form_CONTACT,
		$form_ISWIFI,
		$form_ISPARKING,
		'$form_HOUROPERATION',
		$form_UPLOADER,
		1
		)";


		if($db->connection->query($sql_STORE))
		{
			$sql_id = $db->connection->insert_id;
			echo 'success: ' . $sql_id;
			
		}
		else
		{
			echo 'error: Error adding Store';
			
		}

	}
	else {
		
		echo 'warning: Error in adding coordinates';
	
	}

	

?>
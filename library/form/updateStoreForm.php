<?php
/*
 * _____________________________________________________________________________________
 *
 * TITLE: 			The Update Store Form
 * DESCRIPTION: 	Code for the updating of Stores
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
 * $_POST['ID'];
 * $_POST['NAME'];
 * $_POST['ADDRESS'];
 * $_POST['LAT'];
 * $_POST['LNG'];
 * $_POST['ZINDEX'];
 * $_POST['CONTACT'];
 * $_POST['ISWIFI'];
 * $_POST['ISPARKING'];
 * $_POST['HOUROPERATION'];
 * $_POST['STATUS'];
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


$form_ID = $db->connection->real_escape_string($_POST['ID']);
$form_NAME = $db->connection->real_escape_string($_POST['NAME']);
$form_ADDRESS = $db->connection->real_escape_string($_POST['ADDRESS']);
$form_LAT = $db->connection->real_escape_string($_POST['LAT']);
$form_LNG = $db->connection->real_escape_string($_POST['LNG']);
$form_ZINDEX = $db->connection->real_escape_string($_POST['ZINDEX']);
$form_ISWIFI = $db->connection->real_escape_string($_POST['ISWIFI']);
$form_ISPARKING = $db->connection->real_escape_string($_POST['ISPARKING']);
$form_CONTACT = $db->connection->real_escape_string($_POST['CONTACT']);
$form_HOUROPERATION = $db->connection->real_escape_string($_POST['HOUROPERATION']);
$form_STATUS = $db->connection->real_escape_string($_POST['STATUS']);
		
		$sql_STORE = "UPDATE store SET

				NAME = '$form_NAME',
				ADDRESS = '$form_ADDRESS',
				ISWIFI = $form_ISWIFI,
				ISPARKING = $form_ISPARKING,
				CONTACT = $form_CONTACT,
				HOUROPERATION = '$form_HOUROPERATION',
				STATUS = $form_STATUS

				WHERE
				ID = $form_ID";

		if($db->connection->query($sql_STORE))
			{
				$sql_GET_COORDINATESID = "SELECT store.COORDINATES FROM store WHERE store.ID = $form_ID";
				
				$result_GET_COORDINATESID = $db->connection->query($sql_GET_COORDINATESID);
				$count_GET_COORDINATESID = mysqli_num_rows($result_GET_COORDINATESID);
				$row_GET_COORDINATESID = $result_GET_COORDINATESID->fetch_assoc();
				$result_GET_COORDINATESID = $row_GET_COORDINATESID['COORDINATES'];

				$sql_COORDINATES = "UPDATE coordinates SET

				LAT = $form_LAT,
				LNG = $form_LNG, 
				ZINDEX = $form_ZINDEX

				WHERE
				ID = $result_GET_COORDINATESID";
				
			
				if($db->connection->query($sql_COORDINATES)) {
					echo 'success:' . $form_ID;
				}
				else {
					echo 'error: Failure in updating store';
				}

			}
		else
		{
			echo 'warning: Failure in updating the coordinate of store';
		}
		
	

?>
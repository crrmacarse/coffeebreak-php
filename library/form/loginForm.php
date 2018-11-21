           <?php
/*
 * _____________________________________________________________________________________
 *
 * TITLE: 			The Login Form
 * DESCRIPTION: 	Code for the login of accounts.
 * _____________________________________________________________________________________
 *
 * RETURN KEYWORDS:
 *
 * admin 	-> 	If an admin account was logged in.
 * marketing 	-> 	If a marketing account was logged in.
 * ______________________________________________________________________________________
 *
 * VARIABLES:
 *
 * $_POST['USERNAME']	->	text
 * $_POST['PASSWORD']	->	text
 *______________________________________________________________________________________
 *
 * Note: you can send a custom error message by typing 'msg:' followed by your message.
 * 		 Just make sure that there are no printed or echoed before the 'msg:' keyword.
 *______________________________________________________________________________________
 *
 */
	session_start();

	//db initialization
	include('connection.php');
	$db = new db();

	//form variables

	// i setteled for md5 bcos hashing class

	$form_USERNAME = $db->connection->real_escape_string($_POST['USERNAME']);
	$form_PASSWORD = $db->connection->real_escape_string($_POST['PASSWORD']);
//	$hashed_password = md5($form_PASSWORD);
	$encryptedusername = md5($form_USERNAME);
	$encryptedpassword = md5($form_PASSWORD);
	
	$usernamecount = strlen($form_USERNAME);
	
	$salt = substr($encryptedusername,0,$usernamecount);
	
	$hash1 = substr($encryptedpassword,0,$usernamecount);
	$hash2 = substr($encryptedpassword,$usernamecount+1);

	$hashed_password = $hash1.$salt.$hash2;
	
	//sql
	$sql = "SELECT ID, USERNAME, PASSWORD, GROUPID, FNAME, MNAME, LNAME, STATUS FROM account_user WHERE USERNAME='" . $db->connection->real_escape_string($form_USERNAME) . "'";
	$result = $db->connection->query($sql);
	$count = mysqli_num_rows($result);
	$row = $result->fetch_assoc();


	//db variables
	$result_ID = $row['ID'];
	$result_USERNAME = $row['USERNAME'];
	$result_PASSWORD = $row['PASSWORD'];
	$result_GROUPID = $row['GROUPID'];
	$result_FNAME = $row['FNAME'];
	$result_MNAME = $row['MNAME'];
	$result_LNAME = $row['LNAME'];
	$result_STATUS = $row['STATUS'];
	
	//verification
	if($count > 0)
	{
		if($result_STATUS == '1')
		{
			if ($hashed_password == $result_PASSWORD) 
			{
				//determine account type
				switch ($result_GROUPID)
				{
					case '1':
						echo 'success: admin';
						break;
					case '2':
						echo 'success: marketing';
						break;
					case '3':
						echo 'success: dummy';
						break;	
					Default:
						echo 'error';
						exit;
						break;
				}

				//create session variables
				$_SESSION['USER_ID'] = $result_ID;
				$_SESSION['USER_USERNAME'] = $result_USERNAME;
				$_SESSION['USER_GROUPID'] = $result_GROUPID;
				$_SESSION['USER_FNAME'] = $result_FNAME;
				$_SESSION['USER_MNAME'] = $result_MNAME;
				$_SESSION['USER_LNAME'] = $result_LNAME;

			}
			else
			{
				echo 'error: Error! Wrong Password!' . $hashed_password;
			
			}
		}
		else
		{
			echo "warning: Account Deactivated";
		}
	}
	else
	{
		echo 'msg: No Account found!';
	}
?>
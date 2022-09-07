<?php
require '../init.php';
header('Content-type: application/json');

$response = array();

if(isset($_POST['account_fname']) && isset($_POST['account_lname']) && isset($_POST['account_email'])
	&& isset($_POST['account_username']) && isset($_POST['account_birthday']) && isset($_POST['account_gender'])) {
	// Data
	$first_name = $_POST['account_fname'];
	$last_name = $_POST['account_lname'];
	$email = $_POST['account_email'];
	$username = $_POST['account_username'];
	$birthday = $_POST['account_birthday'];		
	$gender = $_POST['account_gender'];

	if($userHndlr->updateUser($db,array($first_name,$last_name,$birthday,$gender,$email,$username,$_SESSION['id']))) {
		$response['status'] = 'success';
		$response['message'] = 'Great! Your account has been updated.';
		$_SESSION = $userHndlr->getUserDataById($db,array($_SESSION['id']));
	}
	else {
		$response['status'] = 'error';
		$response['message'] = 'Error.. Please try again later.';
	}
}

echo json_encode($response);
$db->disconnect();
?>
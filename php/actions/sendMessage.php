<?php	
require '../init.php';				
header('Content-type: application/json');

$response = array();

if(isset($_SESSION['id']) && isset($_GET['rid']) && isset($_POST['message']) && !empty($_POST['message'])) {
    $sender = $_SESSION['id'];
    $recevier = $_GET['rid'];
    $message =  $_POST['message'];
    
    if($messageHndlr->insertMessage($db,array($sender,$recevier,nl2br($message)))) {
		$response['status'] = 'success';
	}
	else {
		$response['status'] = 'error';
	}
}

echo json_encode($response);
$db->disconnect();
?>
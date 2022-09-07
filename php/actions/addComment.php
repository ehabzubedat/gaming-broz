<?php	
require '../init.php';				
header('Content-type: application/json');

$response = array();
	
if(isset($_GET['tid']) && isset($_POST['comment'])) {	
	$tid = $_GET['tid'];
	$user_id = $_SESSION['id'];
	$comment = $_POST['comment'];
	
	if($forumHndlr->insertComment($db,array($tid,$user_id,nl2br($comment)))) {
		$response['status'] = 'success';
		$response['message'] = 'Great! Article successfully posted.'; 
		$response['location'] = 'topic.php?tid='.$tid;
	}
	else {
		$response['status'] = 'error';
		$response['message'] = 'Ops! something went wrong!'; 
	}
}

echo json_encode($response);
$db->disconnect();
?>
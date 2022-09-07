<?php	
require '../init.php';				
header('Content-type: application/json');

$response = array();
	
if(isset($_POST['description'])) {	
	$description = $_POST['description'];
        
	if($postHndlr->insertPost($db,array($description))) {
		$response['status'] = 'success';
		$response['message'] = 'Great! Posted successfully.'; 
	}
	else {
		$response['status'] = 'error';
		$response['message'] = 'Ops! something went wrong!'; 
	}
}

echo json_encode($response);
$db->disconnect();
?>